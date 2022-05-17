<?php

namespace App\Http\Controllers\Staff\JSONControllers;

use App\Http\Controllers\Controller;
use App\Models\EmployeeDetail;
use App\Models\Interview;
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
            $onboard ="<button class='btn btn-outline-primary px-3 py-3'
                data-toggle='modal' data-target='#profile_modal".$data->login_id."'>
                <i class='h4 bi bi-check2-circle'></i><br>
                Onboard
                </button>" ;
            return $onboard;
        })
        ->addColumn('delete',function($data){
            $onboard ="<button class='btn btn-outline-danger px-3 py-3'>
                <i class='h4 bi bi-trash-fill'></i><br>
                Delete
                </button>" ;
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
            </script>
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
                            '".$interview->interview_schedule."'
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
                        onclick=\"modal_view('/".$data->picture."', '".$data->fname ." ". $data->mname ." ". $data->lname."','".$interview->interview_schedule."','".$interview->score."','".$interview->feedback."')\"
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
