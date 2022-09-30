<?php

namespace App\Http\Controllers\Staff\JSONControllers;

use App\Http\Controllers\Controller;
use App\Models\Audit;
use App\Models\Clearance;
use App\Models\EmployeeDetail;
use App\Models\Interview;
use App\Models\Resigned;
use App\Models\Retired;
use App\Models\Terminated;
use App\Models\UserCredential;
use DateTime;
use Illuminate\Http\Request;

class JsonController extends Controller
{
    public function applicantjson(){
        $applicants = UserCredential::where('user_type','applicant')
            ->join('user_details','user_details.login_id','=','user_credentials.login_id')
            ->join('applicant_details','applicant_details.login_id','=','user_credentials.login_id')
            ->get();

        return datatables()->of($applicants)
        ->addColumn('full_name',function($data){
            $full_name = $data->fname .' '. $data->mname . ' '. $data->lname ;

            return $full_name;
        })
        ->addColumn('img',function($data){
            $img = "<img src='/".$data->picture."' height='50px' width='50px' class='rounded-circle'>";
            return $img;
        })
        ->addColumn('onboard',function($data){
            $onboard ="<button class='btn btn-outline-primary px-3 py-3 w-50'
                data-toggle='modal' data-target='#profile_modal".$data->login_id."'>
                <i class='h4 bi bi-check2-circle'></i><br>
                Onboard
                </button>" ;
            return $onboard;
        })
        ->addColumn('delete',function($data){
            $onboard ="
            <form action='/staffDeleteApplicant' onsubmit='return confirm(\"Do you really want to delete application #". $data->applicant_id ."?\");' method='GET'>
                <input type='hidden' name='login_id' value='".$data->login_id."'>
                <button type='submit' class='btn btn-outline-danger px-3 py-3'>
                <i class='h4 bi bi-trash-fill'></i><br>
                Delete
                </button>
            </form>" ;
            return $onboard;
        })
        ->rawColumns(['full_name','img','onboard','delete'])
        ->make(true);
    }

    public function interviewjson(){
        $applicants = UserCredential::where('user_type','applicant')
            ->join('user_details','user_details.login_id','=','user_credentials.login_id')
            ->join('applicant_details','applicant_details.login_id','=','user_credentials.login_id')
            ->get();

        return datatables()->of($applicants)
        ->addColumn('full_name',function($data){
            $full_name = $data->fname .' '. $data->mname . ' '. $data->lname ;
            return $full_name;
        })
        ->addColumn('img',function($data){
            $img = "<img src='/".$data->picture."' height='80px' width='80px' class='rounded-circle'>";
            return $img;
        })
        ->addColumn('first',function($data){
            $first = $this->interview_status_controller($data,1);
            return $first;
        })
        ->addColumn('date',function($data){
            return date($data->created_at);
        })
        ->addColumn('second',function($data){
            $second = $this->interview_status_controller($data,2);
            return $second;
        })
        ->rawColumns(['full_name','img','first','second','date'])
        ->make(true);
    }

    public function schedulejson(){
        $employeelist = EmployeeDetail::with('UserDetail')->get();
        return datatables()->of($employeelist)
        ->addColumn('sched_days',function($data){
            $days = json_decode($data->schedule_days);
            $sched_days = "
            <form action='/updateScheduleDays' method='POST' id='schedule_form_". $data->employee_id."'>
            <input type='hidden' value='". $data->employee_id ."' name='emp_id' disabled>
            <div class='row m-2'>";

            if(in_array(1,$days)){
                $sched_days .= "
                <div class='col form-check'>
                    <input type='checkbox' class='form-check-input' id='monday' name='monday' value='1' checked disabled>
                    <label class='form-check-label' for='monday'>Monday</label><br>
                </div>";
            }else {
                $sched_days .= "
                <div class='col form-check'>
                    <input type='checkbox' class='form-check-input' id='monday' name='monday' value='1' disabled>
                    <label class='form-check-label' for='monday'>Monday</label><br>
                </div>";
            }

            if(in_array(2,$days)){
                $sched_days .= "
                <div class='col form-check'>
                    <input type='checkbox' class='form-check-input' id='tuesday' name='tuesday' value='2' checked disabled>
                    <label class='form-check-label' for='tuesday'>Tuesday</label><br>
                </div>";
            }else {
                $sched_days .= "
                <div class='col form-check'>
                    <input type='checkbox' class='form-check-input' id='tuesday' name='tuesday' value='2' disabled>
                    <label class='form-check-label' for='tuesday'>Tuesday</label><br>
                </div>";
            }

            if(in_array(3,$days)){
                $sched_days .= "
                <div class='col form-check'>
                    <input type='checkbox' class='form-check-input' id='wednesday' name='wednesday' value='3' checked disabled>
                    <label class='form-check-label' for='wednesday'>Wednesday</label><br>
                </div>";
            }else {
                $sched_days .= "
                <div class='col form-check'>
                    <input type='checkbox' class='form-check-input' id='wednesday' name='wednesday' value='3' disabled>
                    <label class='form-check-label' for='wednesday'>Wednesday</label><br>
                </div>";
            }

            if(in_array(4,$days)){
                $sched_days .= "
                <div class='col form-check'>
                    <input type='checkbox' class='form-check-input' id='thursday' name='thursday' value='4' checked disabled>
                    <label class='form-check-label' for='thursday'>Thursday</label><br>
                </div>";
            }else {
                $sched_days .= "
                <div class='col form-check'>
                    <input type='checkbox' class='form-check-input' id='thursday' name='thursday' value='4' disabled>
                    <label class='form-check-label' for='thursday'>Thursday</label><br>
                </div>";
            }

            if(in_array(5,$days)){
                $sched_days .= "
                <div class='col form-check'>
                    <input type='checkbox' class='form-check-input' id='friday' name='friday' value='5' checked disabled>
                    <label class='form-check-label' for='friday'>Friday</label><br>
                </div>";
            }else {
                $sched_days .= "
                <div class='col form-check'>
                    <input type='checkbox' class='form-check-input' id='friday' name='friday' value='5' disabled>
                    <label class='form-check-label' for='friday'>Friday</label><br>
                </div>";
            }

            if(in_array(6,$days)){
                $sched_days .= "
                <div class='col form-check'>
                    <input type='checkbox' class='form-check-input' id='saturday' name='saturday' value='6' checked disabled>
                    <label class='form-check-label' for='saturday'>Saturday</label><br>
                </div>";
            }else {
                $sched_days .= "
                <div class='col form-check'>
                    <input type='checkbox' class='form-check-input' id='saturday' name='saturday' value='6' disabled>
                    <label class='form-check-label' for='saturday'>Saturday</label><br>
                </div>";
            }

            if(in_array(0,$days)){
                $sched_days .= "
                    <div class='col form-check'>
                        <input type='checkbox' class='form-check-input' id='sunday' name='sunday' value='0' checked disabled>
                        <label class='form-check-label' for='sunday'>Sunday</label><br>
                    </div>
                </div>";
            }else {
                $sched_days .= "
                    <div class='col form-check'>
                        <input type='checkbox' class='form-check-input' id='sunday' name='sunday' value='0' disabled>
                        <label class='form-check-label' for='sunday'>Sunday</label><br>
                    </div>
                </div>";
            }

            $sched_days .= "
            <div class='row m-3'>
                <button type='button' class='btn btn-lg btn-outline-primary w-100 mx-auto' onclick='editScheduleDays(\"". $data->employee_id."\",this)'>Edit Schedule Days</button>
                <div class='row d-none p-0 mx-auto w-100 mt-2' id='days_submit_". $data->employee_id."'>
                    <div class='col'>
                        <button type='submit' class='btn btn-lg btn-success w-100 mx-auto' disabled>Submit new Schedule</button>
                    </div>
                    <div class='col'>
                        <button type='button' onclick='location.reload()'class='btn btn-lg btn-danger w-100 mx-auto' disabled>Cancel</button>
                    </div>
                </div>
            </div>
            </form>

            <script>
                function editScheduleDays(id,btn){
                    var controls = document.getElementById('days_submit_'+id)
                    var form = document.getElementById('schedule_form_'+id)
                    controls.classList.toggle('d-none')

                    var elements = form.elements;
                    for (var i = 0, len = elements.length; i < len; ++i) {
                        elements[i].disabled = !elements[i].disabled;
                    }

                    btn.disabled = false
                }
            </script>
            ";

            return $sched_days;
        })
        ->addColumn('timein',function($data){
            $timein = '<h5>Current Time in:</h5>
                '.$data->schedule_Timein.'<br>
                <button onclick="display_form(this,\'timein_form\','.$data->employee_id.')" class="btn btn-outline-primary">Edit Schedule</button>

            <form action="/UpdateSchedule"  id="timein_form'.$data->employee_id.'" class="d-none">
                <input type="hidden" name="sched_type" value="1">
                <input type="hidden" name="emp_id" value="'.$data->employee_id.'">
                <input type="text" name="sched" id="timein'.$data->employee_id.'" class="form-control w-100 my-2 datetime">
                <button type="submit" id="submit'.$data->employee_id.'" class="btn btn-primary w-100">Edit Schedule</button>
            </form>

            <script>
            $(function () {
                $(".datetime").datetimepicker({
                    format:"H:i",
                    mask:true,
                    datepicker:false,
                });
            })
            </script>';

            return $timein;
        })
        ->addColumn('timeout',function($data){
            $timeout = '<h5>Current Time out:</h5>
            '.$data->schedule_Timeout.'<br>
            <button onclick="display_form(this,\'timeout_form\','.$data->employee_id.')" class="btn btn-outline-primary">Edit Schedule</button>

            <form action="/UpdateSchedule" id="timeout_form'.$data->employee_id.'" class="d-none">
                <input type="hidden" name="sched_type" value="0">
                <input type="hidden" name="emp_id" value="'.$data->employee_id.'">
                <input type="text" name="sched" id="timein'.$data->employee_id.'" class="form-control w-100 my-2 datetime">
                <button type="submit" id="submit'.$data->employee_id.'" class="btn btn-primary w-100">Edit Schedule</button>
            </form>

            <script>
            $(function () {
                $(".datetime").datetimepicker({
                    format:"H:i",
                    mask:true,
                    datepicker:false,
                });
            })
            </script>';

        return $timeout;
        })
        ->rawColumns(['timein','timeout','sched_days'])
        ->make(true);
    }

    public function offboardingjson(){
        $offboardee = EmployeeDetail::with('UserDetail')->where('employment_status','Offboardee')->get();

        foreach ($offboardee as $key => $value) {
            $value->clearance = Clearance::where('employee_id',$value->employee_id)->get();
            $value->clearance_overall_status = count($value->clearance);

            foreach ($value->clearance as $key => $clearance_item) {
                $value->clearance_overall_status -= $clearance_item->clearance_status;
            }
        }

        return datatables()->of($offboardee)
        ->addColumn('full_name',function($data){
            $full_name = $data->userDetail->fname .' '. $data->userDetail->mname . ' '. $data->userDetail->lname;
            return $full_name;
        })
        ->addColumn('offboarding_status',function($data){
            if(Resigned::where('employee_id',$data->employee_id)->count()){
                $status = 'Resigned';
            }
            if(Terminated::where('employee_id',$data->employee_id)->count()){
                $status = 'Terminated';
            }
            if(Retired::where('employee_id',$data->employee_id)->count()){
                $status = 'Retired';
            }

            return $status;
        })
        ->addColumn('img',function($data){
            $img = "<img src='/".$data->userDetail->picture."' height='80px' width='80px' class='rounded-circle'>";
            return $img;
        })
        ->addColumn('clear',function($data){
            if($data->clearance_overall_status ){
                $clearance_list = "<div class='card shadow-sm p-4 bg-white'>
                <h5 class='alert-light p-2 text-center w-100'>Clearance List</h5>";
                    foreach ($data->clearance as $key => $value) {
                        $clearance_list .= "
                            <div class='row p-2 border-bottom text-start'>
                                <div class='col p-2'>
                                    <h5>". ($key + 1) .". ".$value->clearance_name."</h5>
                                </div>
                                <div class='col-3'>";

                        if(!$value->clearance_status){
                            $clearance_list .= '
                                <form action="/updateClearanceItem" onsubmit="return confirm(\'Do you really want to clear employee #'. $data->employee_id . ' on '.$value->clearance_name.'?\');" method="POST">
                                    <input type="hidden" name="employee_id" value="'. $data->employee_id .'">
                                    <input type="hidden" name="clearance_id" value="'. $value->id .'">
                                    <button type="submit" class="btn btn-outline-primary p-2 w-100">Mark as Accomplished</button>
                                </form>';
                        }else{
                            $clearance_list .= '<button class="btn btn-primary p-2 w-100" disabled>Accomplished<br>
                            '. $value->date_cleared .'</button>';
                        }


                        $clearance_list .= "
                                    </div>
                                </div>";
                    }
                    $clearance_list .= "</div>";

                return $clearance_list;
            }else{
                return '<h6 class="alert-success rounded shadow-sm w-50 mx-auto p-3 my-0">Cleared for Clearance</h6>';
            }
        })
        ->addColumn('delete',function($data){
            if(!$data->clearance_overall_status ){
                $clear_btn = "
                    <form action='/deleteEmployee' method='POST' class='p-0 m-0'>
                        <input type='hidden' name='id' value='". $data->employee_id ."'>
                        <button class='btn btn-danger p-3 w-50 m-0'>Delete</button>
                    </form>";
            }
            else{
                $clear_btn = "";
            }

            return $clear_btn;
        })
        ->rawColumns(['full_name','img','offboarding_status','clear','delete'])
        ->make(true);
    }

    public function terminationjson(){
        $employees = EmployeeDetail::with('UserDetail')
            ->where('employment_status','!=','Offboardee')
            ->get();

        foreach ($employees as $key => $value) {
            if(Resigned::where('employee_id',$value->employee_id)->first()){
                unset($employees[$key]);
            }
        }

        return datatables()->of($employees)
        ->addColumn('full_name',function($data){
            $full_name = $data->userDetail->fname .' '. $data->userDetail->mname . ' '. $data->userDetail->lname ;
            return $full_name;
        })
        ->addColumn('img',function($data){
            $img = "<img src='/".$data->userDetail->picture."' height='80px' width='80px' class='rounded-circle'>";
            return $img;
        })
        ->addColumn('employed_for',function($data){
            $date1 = date_create($data->start_date);
            $date2 = date_create('2022-05-19');

            $employed_for = date_diff($date1, $date2);

            return $employed_for->format('%y years <br> %m months <br> %d days');
        })
        ->addColumn('terminate',function($data){
            $full_name = $data->userDetail->fname .' '. $data->userDetail->mname . ' '. $data->userDetail->lname ;
            $terminate = '<button onclick="offboarding(\'Termination\',\''.$data->employee_id.'\',\'/'.$data->userDetail->picture.'\',\''.$full_name.'\',\''.$data->department.'\',\''.$data->position.'\',\''.$data->userDetail->cnum.'\',\''.$data->userDetail->email.'\')" class="btn btn-outline-danger w-25 py-4" data-toggle="modal" data-target="#edit_modal">Terminate</button>';
            return $terminate;
        })
        ->addColumn('retire',function($data){
            $full_name = $data->userDetail->fname .' '. $data->userDetail->mname . ' '. $data->userDetail->lname ;
            $retire = '<button onclick="offboarding(\'Retirement\',\''.$data->employee_id.'\',\'/'.$data->userDetail->picture.'\',\''.$full_name.'\',\''.$data->department.'\',\''.$data->position.'\',\''.$data->userDetail->cnum.'\',\''.$data->userDetail->email.'\')"  class="btn btn-outline-info w-25 py-4" data-toggle="modal" data-target="#edit_modal">Retire</button>';
            return $retire;
        })
        ->rawColumns(['full_name','img','employed_for','terminate','retire'])
        ->make(true);
    }

    function interview_status_controller($data,$int_details){
        $interview = Interview::where('applicant_id',$data->applicant_id)
            ->where('interview_detail',$int_details)
            ->first();

        if(isset($interview)){
            if($interview->response_status == null){
                return $str= "
                <h4>Scheduled On</h4>
                <h6>$interview->interview_schedule</h6>
                <div class='row text-center'>
                    <div class='col-4'>
                        <button onclick=\"modal_update(
                            '/".$data->picture."',
                            '".$interview->id."',
                            '".$data->fname ." ". $data->mname ." ". $data->lname."',
                            '".$interview->interview_schedule ."'
                        )\" class='w-100 h-100 btn btn-outline-success' data-toggle='modal' data-target='#edit_modal'><i class='h1 bi bi-telephone'></i><br>Responded</button>
                    </div>
                    <div class='col-4'>
                        <form action='/NoResponseInterview' method='GET'>
                        <input type='hidden' name='interview_id' value=".$interview->id.">
                        <button type='submit' class='w-100 h-100 btn btn-outline-danger text-wrap'>
                            <i class='h1 bi bi-telephone-x-fill'></i><br>
                            Not Responded
                            </button>
                        </form>
                    </div>
                    <div class='col'>
                        <form action='/deleteInterviewSchedule' method='POST'>
                            <input type='hidden' name='interview_id' value=".$interview->id.">
                            <button type='submit' class='btn btn-outline-warning w-100 h-100'><i class='bi bi-calendar-fill h1'></i><br>Reschedule</button>
                        </form>
                    </div>
                </div>";
            }
            else{
                if($interview->response_status){
                    $str='';
                    if($interview->score == "Passed"){
                        $str="text-success border-bottom pb-1'>".$interview->score."<i class='bi bi-check h4'></i>";
                    }
                    else{
                        $str="text-danger border-bottom pb-1'>".$interview->score."<i class='bi bi-x'></i>";
                    }
                    return "<button class='btn alert alert-light w-100 h-100 text-center mx-auto'
                        onclick=\"modal_view('/".$data->picture."', '".$data->fname ." ". $data->mname ." ". $data->lname."','".$interview->interview_schedule."','".$interview->score."','".addslashes($interview->feedback)."')\"
                        data-toggle='modal' data-target='#view_model'>
                        <h5 class='".$str."</h5>
                        <h5>".$interview->interview_schedule."</h5>
                        Responded
                    </button>";
                }
                else{
                    return "<div class='alert alert-danger w-50 h-100 mx-auto'>
                        <h5>".$interview->interview_schedule."</h5>
                        No Response
                    </div>";
                }
            }

        }else{
            return $str = "
            <h5>Add Interview Schedule</h5>
            <form action='/InsertInterview' method='GET'>
                <input type='hidden' name='int_status' value='".$int_details."'>
                <input type='hidden' name='emp_id' value=".$data->applicant_id.">
                <input type='text' name='sched' id='sched".$data->login_id."' class='form-control w-75 my-2 datetime'>
                <button type='submit' class='btn btn-primary w-75'>Add Schedule</button>
            </form>

            <script>
            $(function () {
                $('.datetime').datetimepicker({
                    format:'Y-m-d H:i',
                    mask:true,
                });
            })
            </script>
            ";
        }
    }

    public function getAuditJson(Request $request){
        $audit = Audit::with('payroll_manager')
        ->whereBetween('created_at',[$request->from_date,new DateTime($request->to_date ." ". "23:59")])
        ->where('activity_type','staff')
            ->get();

        return datatables()->of($audit)
        ->addColumn('date',function($data){
            $date = date($data->created_at);

            return $date;
        })
        ->addColumn('payroll',function($data){
            $payroll = '<h5>'. $data->payroll_manager->fname . ' ' . $data->payroll_manager->mname . ' '. $data->payroll_manager->lname .'</h5>';

            return $payroll;
        })
        ->addColumn('employee_detail',function($data){
            if(isset($data->employee)){
                $payroll = '<h5>'. $data->employee .'</h5>';

                return $payroll;
            }
            else{
                return ' - ';
            }
        })
        ->rawColumns(['payroll','employee_detail','date'])
        ->make(true);
    }
}
