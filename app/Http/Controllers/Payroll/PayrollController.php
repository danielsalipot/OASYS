<?php

namespace App\Http\Controllers\Payroll;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Contributions;
use App\Models\Holiday;

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
            return view('pages.payroll_manager.contributions',compact('sss'));
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
}
