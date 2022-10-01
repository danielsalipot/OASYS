<?php

namespace App\Http\Controllers\Payroll;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Contributions;
use App\Models\Holiday;
use App\Models\Pagibig;
use App\Models\philhealth;
use App\Models\EmployeeDetail;
use App\Models\UserCredential;
use App\Models\Audit;
use App\Models\Deduction;
use App\Models\employee_activity;
use App\Models\leave_approval;
use App\Models\payroll_approval;
use App\Models\Payroll;
use App\Models\UserDetail;
use App\Models\Payslips;
use App\Models\Position;

class PayrollController extends Controller
{
        function payroll(Request $request){
            if(!session()->has('progress')){
                session()->put('progress', 0);
                session()->put('progress_btn', '');
            }

            $profile = UserDetail::where('login_id',session('user_id'))->first();

            return view('pages.payroll_manager.payroll')->with(['profile'=>$profile]);
        }

        function history(){
            $profile = UserDetail::where('login_id',session('user_id'))->first();

            // PAYROLL HTML
            $payroll_dir = 'payrolls';
            $payroll_files = array_diff(scandir($payroll_dir), array('.', '..'));
            array_splice($payroll_files,0,1);

            $btn_arr_pr =[];
            $file_arr_pr =[];

            foreach ($payroll_files as $key => $value) {
                if($value == '.gitkeep'){
                    continue;
                }
                array_push($btn_arr_pr,"<button id=\"".$key."\" class='w-100 p-4 btn btn-light m-2 text-wrap' onclick=\"display(this,'".$key."','".$value."')\">" . $value . "</button>");
                array_push($file_arr_pr,"<iframe id=\""."file".$key ."\" src=\"/" . $payroll_dir . "/" . $value ."\" width=\"100%\" style=\"display:none;height:100%\"></iframe>");
            }

            // PAYSLIP HTML
            $payslip_dir = 'payslips'; // Main dir
            $payslip_folders = array_diff(scandir($payslip_dir), array('.', '..')); // Lahat ng folder

            $sub_btn_arr_ps =[];
            foreach ($payslip_folders as $key => $value) {
                if($value == '.gitkeep'){
                    continue;
                }
                $key -= 3;
                $btn = '<button id="ps_folder" onclick="folder(this,'. $key .')" class="btn btn-light w-100 p-3">'.$value.'</button>';
                array_push($sub_btn_arr_ps,$btn);
            }

            $payslip_files = []; //Lahat ng files
            foreach ($payslip_folders as $key => $value) {
                try {
                    array_push($payslip_files, array_diff(scandir($payslip_dir."/".$value), array('.', '..')));
                } catch (\Throwable $th) {
                    continue;
                }
            }


            $options = [];
            foreach ($payslip_files as $key1 => $files_arr) {
                $str = '<div id="folder'.$key1.'" class="row d-none m-auto w-100">';
                    foreach ($files_arr as $key2 => $file_name) {
                        $str .= '
                            <form action="/payroll/history/payslip" target="_blank" method="GET">
                            <input type="hidden" id="path" name="path" value="/'.$payslip_dir.'/'.$payslip_folders[$key1 + 3].'/'.  $file_name .'">
                            <button type="submit" class="btn btn-outline-light w-100 m-0">'.$file_name.'</button>
                            </form>';
                    }
                $str .= '</div>';
                array_push($options,$str);
            }



            return view('pages.payroll_manager.pr_history')->with(['profile'=>$profile, 'btn_arr_pr' => $btn_arr_pr, 'file_arr_pr' => $file_arr_pr, 'sub_btn_arr_ps'=>$sub_btn_arr_ps,'options'=>$options]);
        }

        function display_payslip(Request $request){

            if(session('user_type') == 'employee'){
                $employee = EmployeeDetail::where('login_id',session('user_id'))->first();
                employee_activity::create([
                    'employee_id' => $employee->employee_id,
                    'description' => 'Employee viewed their payslip (' . $request->path . ')',
                    'activity_date' => date('Y-m-d h:i:s')
                ]);
            }

            echo '<iframe src="'.$request->path.'" width="100%" style="height:100%"></iframe>';
        }

        function employeelist(){
            $profile = UserDetail::where('login_id',session('user_id'))->first();
            $positions = Position::all();
            foreach ($positions as $key => $position) {
                $position->employee = EmployeeDetail::with('UserDetail')->where('position',$position->position_title)->orderBy('rate','DESC')->get();
                $position->average_salary = 0;
                if(count($position->employee)){
                    foreach ($position->employee as $key => $employee) {
                        $position->average_salary += $employee->rate;
                    }

                    $position->average_salary = $position->average_salary / count($position->employee);
                }
            }

            return view('pages.payroll_manager.employeelist')->with([
                'profile' => $profile,
                'positions' => $positions
            ]);
        }

        function deduction(){
            $profile = UserDetail::where('login_id',session('user_id'))->first();
            $deduction_names = Deduction::groupBy('deduction_name')->get('deduction_name');
            return view('pages.payroll_manager.deduction')->with([
                'profile'=>$profile,
                'deduction_names' => $deduction_names
            ]);
        }

        function overtime(){
            $profile = UserDetail::where('login_id',session('user_id'))->first();
            return view('pages.payroll_manager.overtime')->with(['profile'=>$profile]);
        }

        function cashadvance(){
            $profile = UserDetail::where('login_id',session('user_id'))->first();
            return view('pages.payroll_manager.cashadvance')->with(['profile'=>$profile]);
        }

        function contributions(){
            $sss = Contributions::first();
            $pagibig = Pagibig::first();
            $philhealth = philhealth::first();

            $profile = UserDetail::where('login_id',session('user_id'))->first();
            return view('pages.payroll_manager.contributions',compact(['sss','pagibig','philhealth']))->with(['profile'=>$profile]);
        }

        function bonus(){
            $profile = UserDetail::where('login_id',session('user_id'))->first();
            return view('pages.payroll_manager.bonus')->with(['profile'=>$profile]);
        }

        function doublepay(){
            $profile = UserDetail::where('login_id',session('user_id'))->first();
            return view('pages.payroll_manager.doublepay')->with(['profile'=>$profile]);
        }

        function progress($btn){
            $done = session()->get('progress_btn');
            $done .= $btn;
            session()->put('progress_btn', $done);

            $progress = session()->get('progress');
            $progress += 14.5;
            if($progress > 100){
                session()->put('progress', 100);
            }else{
                session()->put('progress', $progress);
            }
            return redirect('/payroll/home');
        }

        function holidays(){
            $holidays = Holiday::all();

            $profile = UserDetail::where('login_id',session('user_id'))->first();
            return view('pages.payroll_manager.holidays',compact('holidays'))->with(['profile'=>$profile]);
        }

        function leave(){
            $applications = leave_approval::where('status',null)->orderBy('created_at','DESC')->get();
            foreach ($applications as $key => $value) {
                $value->employee = EmployeeDetail::with('UserDetail')->where('employee_id',$value->employee_id)->first();
            }
            $updated = leave_approval::where('status','!=',null)->orderBy('created_at','DESC')->get();

            foreach ($updated as $key => $value) {
                $value->manager = UserDetail::where('login_id',$value->approver_id)->first();
                $value->employee = EmployeeDetail::with('UserDetail')->where('employee_id',$value->employee_id)->first();
            }

            $profile = UserDetail::where('login_id',session('user_id'))->first();
            return view('pages.payroll_manager.leave')->with([
                'profile'=>$profile,
                'applications' => $applications,
                'updatedApplications' => $updated
            ]);
        }

        function audittrail(){
            $profile = UserDetail::where('login_id',session('user_id'))->first();
            $files_arr = ["files" =>[]];
            foreach ($files_arr as $key => $value) {
                if ($handle = opendir("audits/".session('user_type')."/")) {
                    while (false !== ($entry = readdir($handle))) {
                        if ($entry != "." && $entry != ".." && $entry != 'upload' && $entry != '.gitkeep') {
                            array_push($files_arr["files"],["name" => "$entry","path"=> "audits/".session('user_type')."/" . $entry]);
                        }
                    }
                    closedir($handle);
                }
            }

            return view('pages.payroll_manager.audittrail')->with([
                'profile' => $profile,
                'files_arr' => $files_arr
            ]);
        }

        function approval(){
            $profile = UserDetail::where('login_id',session('user_id'))->first();
            $payslip_generated = [];

            // PAYROLL HTML
            $payroll_dir = 'payrolls';
            $payroll_files = array_diff(scandir($payroll_dir), array('.', '..'));
            array_splice($payroll_files, 0, 1);

            usort($payroll_files, function($x, $y) {
                return filectime("payrolls/".$x) > filectime("payrolls/".$y);
            });

            $btn_arr_pr =[];
            $file_arr_pr =[];

            $payrolls = Payroll::join('user_details','user_details.login_id','=','payrolls.payroll_manager_id')->get();
            $count = UserCredential::where('user_type','payroll')
                ->count();
            $count -= 1;
            $progress_bar = [];

            foreach ($payrolls as $key1 => $payroll) {
                $payroll->approvals = payroll_approval::join('user_details','user_details.login_id','=','payroll_approvals.payroll_sign')
                    ->where('payroll_id',$payroll->id)
                    ->get();

                $payroll->progress = (count($payroll->approvals) / $count) * 100;
                $progress = (count($payroll->approvals) / $count) * 100;

                array_push($payslip_generated, Payslips::where('payroll_id',$payroll->id)->count());

                $str = "<div class='d-none' id='progress_bar". ($key1) ."'>
                <h5 class='w-100 text-center'>Payroll Approval Progress</h5>
                    <div class='progress'>
                    <div class='progress-bar' role='progressbar' style='width:". $progress . "%;' aria-valuenow='25' aria-valuemin='0' aria-valuemax='100'>".$progress."%</div>
                    </div>
                    <div class='w-100 text-center card shadow-lg my-4 p-5'>

                    <h2 class='p-3'>Prepared By: </h2>
                        <div class='col-3 p-2 m-1 card shadow-sm m-auto alert alert-primary'>
                            <div class='row'>
                                <div class='col-3'>
                                    <img src='/".$payroll->picture."' height='70px' width='70px' class='rounded-circle mt-3 me-4'>
                                </div>
                                <div class='col mt-3'>
                                    <h4>". $payroll->fname ." " . $payroll->mname . " " .$payroll->lname."</h4>
                                    <h6>Payroll Manager ID: ".$payroll->login_id."</h6>
                                    <h6>Approval date:</h6>
                                    <p>". date_format($payroll->created_at,"Y-m-d H:i:s") ."</p>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <h2 class='p-3'>Approved By: </h2>
                        <div class='d-flex flex-row flex-wrap justify-content-center'>";

                $payroll->done = 0;
                foreach ($payroll->approvals as $key2 => $approval) {
                    if($approval->login_id == session('user_id')){
                        $payroll->done = 1;
                        if($approval->status == 1){
                            $status = "alert alert-primary";
                            $status_str = "Approved";
                        }
                        elseif($approval->status == 2){
                            $status = "alert alert-success";
                            $status_str = "Noted";
                        }
                        else{
                            $status = "alert alert-danger";
                            $status_str = "Disapproved";
                        }

                        $str .= "<div class='col-3 p-2 m-1 card shadow-sm ".$status."'>
                    <div class='row'>
                            <div class='col-3'>
                                <img src='/".$approval->picture."' height='70px' width='70px' class='rounded-circle mt-3 me-4'>
                            </div>
                            <div class='col mt-3'>
                                <h4> Me </h4>
                                <h6>Payroll Manager ID: ".$approval->login_id."</h6>
                                <h6>".$status_str."</h6>
                                <p>". date_format($approval->created_at,"Y-m-d H:i:s") ."</p>
                            </div>
                        </div>
                    </div>";
                    }else{
                        if($approval->status == 1){
                            $status = "alert alert-success";
                            $status_str = "Approved";
                        }
                        elseif($approval->status == 2){
                            $status = "alert alert-success";
                            $status_str = "Noted";
                        }
                        else{
                            $status = "alert alert-danger";
                            $status_str = "Disapproved";
                        }

                        $str .= "<div class='col-3 p-2 m-1 card shadow-sm ".$status."'>
                    <div class='row'>
                            <div class='col-3'>
                                <img src='/".$approval->picture."' height='70px' width='70px' class='rounded-circle mt-3 me-4'>
                            </div>
                            <div class='col mt-3'>
                                <h4>". $approval->fname ." " . $approval->mname . " " .$approval->lname."</h4>
                                <h6>Payroll Manager ID: ".$approval->login_id."</h6>
                                <h6>".$status_str."</h6>
                                <p>". date_format($approval->created_at,"Y-m-d H:i:s") ."</p>
                            </div>
                        </div>
                    </div>";
                    }
                }

                $str .= "</div></div></div>";

                array_push($progress_bar, $str);
            }

            foreach ($payroll_files as $key => $value) {
                if(isset($payrolls[$key])){
                    array_push($btn_arr_pr,
                    "<button id=\"".($key)."\" class='w-100 p-3 btn btn-light m-2 text-wrap' onclick=\"display(
                        this,
                        '".($key)."',
                        '".$value. "<progress class=\'w-100\' id=\'progress_".$key."\' value=\'". $payrolls[$key]->progress."\' max=\'100\'> ".$payrolls[$key]->progress ."% </progress>" . "',
                        '".$payrolls[$key]->from_date."',
                        '".$payrolls[$key]->to_date."',
                        '". $payrolls[$key]->progress ."',
                        ". $payslip_generated[$key] . ",
                        ".$payrolls[$key]->done.",
                        ".$payrolls[$key]->payroll_manager_id.")\">" . $value . "
                        <progress class=' w-100' id='progress_".$key."' value='". $payrolls[$key]->progress."' max='100'> ".$payrolls[$key]->progress ."% </progress></button>");
                    array_push($file_arr_pr,"<iframe id=\""."file".($key)."\" src=\"/" . $payroll_dir . "/" . $value ."\" width=\"100%\" style=\"display:none;height:100%\"></iframe>");
                }
            }


            return view('pages.payroll_manager.approval')->with([
                'profile' => $profile,
                'btn_arr_pr' => $btn_arr_pr,
                'file_arr_pr' => $file_arr_pr,
                'progress_bar' =>$progress_bar,
            ]);
        }

        public function payslip_land(){
            if(session('payslip_request_col2_flash')){
                return view('pages.payslip_land');
            }
        }
}
