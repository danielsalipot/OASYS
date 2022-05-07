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
use App\Models\payroll_audit;
use App\Models\payroll_approval;
use App\Models\Payroll;

class PayrollController extends Controller
{
        function payroll(Request $request){
            if(!session()->has('progress')){
                session()->put('progress', 0);
                session()->put('progress_btn', '');
            }

            return view('pages.payroll_manager.payroll');
        }

        function history(){
            // PAYROLL HTML
            $payroll_dir = 'payrolls';
            $payroll_files = array_diff(scandir($payroll_dir), array('.', '..'));
            $btn_arr_pr =[];
            $file_arr_pr =[];

            foreach ($payroll_files as $key => $value) {
                array_push($btn_arr_pr,"<button id=\"".$key."\" class='w-100 p-4 btn btn-light m-2 text-wrap' onclick=\"display(this,'".$key."','".$value."')\">" . $value . "</button>");
                array_push($file_arr_pr,"<iframe id=\""."file".$key ."\" src=\"/" . $payroll_dir . "/" . $value ."\" width=\"100%\" style=\"display:none;height:100%\"></iframe>");
            }

            // PAYSLIP HTML
            $payslip_dir = 'payslips'; // Main dir
            $payslip_folders = array_diff(scandir($payslip_dir), array('.', '..')); // Lahat ng folder

            $sub_btn_arr_ps =[];
            foreach ($payslip_folders as $key => $value) {
                $key -= 2;
                $btn = '<button id="ps_folder" onclick="folder(this,'. $key .')" class="btn btn-light w-100 p-3">'.$value.'</button>';
                array_push($sub_btn_arr_ps,$btn);
            }

            $payslip_files = []; //Lahat ng files
            foreach ($payslip_folders as $key => $value) {
                array_push($payslip_files, array_diff(scandir($payslip_dir."/".$value), array('.', '..')));
            }

            $options = [];
            foreach ($payslip_files as $key1 => $files_arr) {
                $str = '<div id="folder'.$key1.'" class="row d-none m-auto w-100">';
                    foreach ($files_arr as $key2 => $file_name) {
                        $str .= '
                            <form action="/payroll/history/payslip" target="_blank" method="GET">
                            <input type="hidden" id="path" name="path" value="/'.$payslip_dir.'/'.$payslip_folders[$key1 + 2].'/'.  $file_name .'">
                            <button type="submit" class="btn btn-outline-light w-100 m-0">'.$file_name.'</button>
                            </form>';
                    }
                $str .= '</div>';
                array_push($options,$str);
            }

            return view('pages.payroll_manager.pr_history')->with(['btn_arr_pr' => $btn_arr_pr, 'file_arr_pr' => $file_arr_pr, 'sub_btn_arr_ps'=>$sub_btn_arr_ps,'options'=>$options]);
        }

        function display_payslip(Request $request){
            echo '<iframe src="'.$request->path.'" width="100%" style="height:100%"></iframe>';
        }

        function employeelist(){
            return view('pages.payroll_manager.employeelist');
        }

        function deduction(){
            return view('pages.payroll_manager.deduction');
        }

        function overtime(){
            return view('pages.payroll_manager.overtime');
        }

        function cashadvance(){
            return view('pages.payroll_manager.cashadvance');
        }

        function contributions(){
            $sss = Contributions::first();
            $pagibig = Pagibig::first();
            $philhealth = philhealth::first();

            return view('pages.payroll_manager.contributions',compact(['sss','pagibig','philhealth']));
        }

        function bonus(){
            return view('pages.payroll_manager.bonus');
        }

        function doublepay(){
            return view('pages.payroll_manager.doublepay');
        }

        function message(){
            return view('pages.message');
        }

        function notification(){
            return view('pages.notification');
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
            return view('pages.payroll_manager.holidays',compact('holidays'));
        }

        function leave(){
            return view('pages.payroll_manager.leave');
        }

        function audittrail(){

            return view('pages.payroll_manager.audittrail');
        }

        function approval(){
            // PAYROLL HTML
            $payroll_dir = 'payrolls';
            $payroll_files = array_diff(scandir($payroll_dir), array('.', '..'));
            usort($payroll_files, function($x, $y) {
                return filectime("payrolls/".$x) > filectime("payrolls/".$y);
            });

            $btn_arr_pr =[];
            $file_arr_pr =[];

            $payrolls = Payroll::all();
            $count = UserCredential::where('user_type','payroll')->count();
            $progress_bar = [];

            foreach ($payrolls as $key => $payroll) {
                $payroll->approvals = payroll_approval::join('user_details','user_details.login_id','=','payroll_approvals.payroll_sign')
                    ->where('payroll_id',$payroll->id)
                    ->get();

                    $payroll->progress = (count($payroll->approvals) / $count) * 100;
                    $progress = (count($payroll->approvals) / $count) * 100;

                $str = "<div class='d-none' id='progress_bar". ($key) ."'>
                    <div class='progress'>
                    <div class='progress-bar' role='progressbar' style='width:". $progress . "%;' aria-valuenow='25' aria-valuemin='0' aria-valuemax='100'>".$progress."%</div>
                    </div>
                    <div class='w-100 text-center card shadow-lg my-4 p-5'>
                        <h2 class='p-3'>Approved By: </h2>
                        <div class='d-flex flex-row flex-wrap justify-content-center'>";

                foreach ($payroll->approvals as $key => $approval) {
                    if($approval->login_id == session('user_id')){
                        $str .= "<div class='col-3 p-2 m-1 card shadow-sm'>
                    <div class='row'>
                            <div class='col-3'>
                                <img src='/pictures/1.png' height='60px' width='60px' class='rounded me-4'>
                            </div>
                            <div class='col mt-3'>
                                <h4> Me </h4>
                                <h6>Payroll Manager ID: ".$approval->login_id."</h6>
                            </div>
                        </div>
                    </div>";
                    }else{
                        $str .= "<div class='col-3 p-2 m-1 card shadow-sm'>
                    <div class='row'>
                            <div class='col-3'>
                                <img src='/pictures/1.png' height='60px' width='60px' class='rounded me-4'>
                            </div>
                            <div class='col mt-3'>
                                <h4>". $approval->fname ." " . $approval->mname . " " .$approval->lname."</h4>
                                <h6>Payroll Manager ID: ".$approval->login_id."</h6>
                            </div>
                        </div>
                    </div>";
                    }
                }

                $str .= "</div></div></div>";

                array_push($progress_bar, $str);
            }


            foreach ($payroll_files as $key => $value) {
                array_push($btn_arr_pr,"<button id=\"".($key)."\" class='w-100 p-4 btn btn-light m-2 text-wrap' onclick=\"display(this,'".($key)."','".$value."','".$payrolls[$key]->from_date."','".$payrolls[$key]->from_date."','". $payrolls[$key]->progress ."')\">" . $value . "</button>");
                array_push($file_arr_pr,"<iframe id=\""."file".($key)."\" src=\"/" . $payroll_dir . "/" . $value ."\" width=\"100%\" style=\"display:none;height:100%\"></iframe>");
            }

            return view('pages.payroll_manager.approval')->with(['btn_arr_pr' => $btn_arr_pr, 'file_arr_pr' => $file_arr_pr, 'progress_bar' =>$progress_bar, ]) ;
        }
}
