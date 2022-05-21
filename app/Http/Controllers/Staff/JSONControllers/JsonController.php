<?php

namespace App\Http\Controllers\Staff\JSONControllers;

use App\Http\Controllers\Controller;
use App\Models\Clearance;
use App\Models\EmployeeDetail;
use App\Models\Interview;
use App\Models\Resigned;
use App\Models\Retired;
use App\Models\Terminated;
use App\Models\UserCredential;
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
            <form action='/staffDeleteApplicant' method='GET'>
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
        ->rawColumns(['timein','timeout'])
        ->make(true);
    }

    public function offboardingjson(){
        $offboardee = EmployeeDetail::with('UserDetail')->where('employment_status','offboardee')->get();

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
            if(Clearance::where('employee_id',$data->employee_id)->count()){
                $clear_btn = "<button type='submit' disabled class='btn btn-primary p-3 w-50 m-0'>Cleared</button>";
            }
            else{
                $clear_btn = "
                <form action='/InsertClearance' method='GET'>
                    <input type='hidden' name='employee_id' value='".$data->employee_id."'>
                    <button type='submit' class='btn btn-outline-light p-3 w-50 m-0'>Clear for Clearance</button>
                </form>";
            }

            return $clear_btn;
        })
        ->addColumn('delete',function($data){
            if(Clearance::where('employee_id',$data->employee_id)->count()){
                $clear_btn = "<button class='btn btn-danger p-3 w-50'>Delete</button>";
            }
            else{
                $clear_btn = "<button disabled class='btn btn-danger p-3 w-50'>Delete</button>";
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
            $retire = '<button onclick="offboarding(\'Retirement\',\''.$data->employee_id.'\',\'/'.$data->userDetail->picture.'\',\''.$full_name.'\',\''.$data->department.'\',\''.$data->position.'\',\''.$data->userDetail->cnum.'\',\''.$data->userDetail->email.'\')"  class="btn btn-outline-light w-25 py-4" data-toggle="modal" data-target="#edit_modal">Retire</button>';
            return $retire;
        })
        ->addColumn('resign',function($data){
            $full_name = $data->userDetail->fname .' '. $data->userDetail->mname . ' '. $data->userDetail->lname ;
            $resign = '<button onclick="offboarding(\'Resignation\',\''.$data->employee_id.'\',\'/'.$data->userDetail->picture.'\',\''.$full_name.'\',\''.$data->department.'\',\''.$data->position.'\',\''.$data->userDetail->cnum.'\',\''.$data->userDetail->email.'\')"  class="btn btn-outline-warning w-25 py-4" data-toggle="modal" data-target="#edit_modal">Resign</button>';
            return $resign;
        })
        ->rawColumns(['full_name','img','employed_for','terminate','retire','resign'])
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
                    <div class='col'></div>
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
                    <div class='col'></div>
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
}
