<?php

namespace App\Http\Controllers\Staff;
use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\EmployeeDetail;
use App\Models\Interview;
use App\Models\Offboardee;
use App\Models\Onboardee;
use App\Models\Position;
use App\Models\Regular;
use App\Models\UserCredential;
use App\Models\UserDetail;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    //HR Staff Functions
    function staffhome(){
        $applicants = UserCredential::where('user_type','applicant')
            ->join('user_details','user_details.login_id','=','user_credentials.login_id')
            ->join('applicant_details','applicant_details.login_id','=','user_credentials.login_id')
            ->paginate(5);

        $app_count = UserCredential::where('user_type','applicant')->count();
        $off_count = Offboardee::all()->count();
        $on_count = Onboardee::all()->count();
        $reg_count = Regular::all()->count();

        $profile = UserDetail::where('login_id',session('user_id'))->first();

        $interviews = Interview::join('applicant_details','applicant_details.applicant_id','=','interviews.applicant_id')
            ->join('user_details','user_details.information_id','=','applicant_details.information_id')
            ->where('interviews.interview_schedule','like',date("Y-m-d")."%")
            ->get();

        return view('pages.hr_staff.staffhome')
            ->with(['applicants'=>$applicants,
                'app_count'=>$app_count,
                'off_count'=>$off_count,
                'on_count'=>$on_count,
                'reg_count'=>$reg_count,
                'profile'=>$profile,
                'interviews'=>$interviews
            ]);
    }

    function onboarding(){
        $profile = UserDetail::where('login_id',session('user_id'))->first();
        $departments = Department::all();
        $position = Position::all();

        $pos ='';
        foreach ($position as $key => $value) {
            $pos .= "<option value='".$value->position_title."'>".$value->position_title."</option>";
        }

        $dep ='';
        foreach ($departments as $key => $value) {
            $dep .= "<option value='".$value->department_name."'>".$value->department_name."</option>";
        }

        $modals = [];
        $applicants = UserCredential::where('user_type','applicant')
            ->join('user_details','user_details.login_id','=','user_credentials.login_id')
            ->join('applicant_details','applicant_details.login_id','=','user_credentials.login_id')
            ->get();

        foreach ($applicants as $key => $applicant) {
            $first_int= $this->modal_interview_controller($applicant,1);
            $second_int= $this->modal_interview_controller($applicant,2);

            $modal = "
            <div class='modal' id='profile_modal".$applicant->login_id."'>
            <div class='modal-dialog modal-dialog-centered modal-lg w-100'>
                <div class='modal-content'>

                    <!-- Modal Header -->
                    <div class='modal-header'>
                        <h4 class='modal-title w-100'>Applicant Details</h4>
                        <button type='button' class='close' data-dismiss='modal'>&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class='modal-body row'>
                        <div class='row'>
                            <div class='col-3'>
                            <img src='/".$applicant->picture."' class='rounded-circle w-100 h-100'>
                            </div>
                            <div class='col-4'>
                                <div class='row m-2'>
                                    <h6 class='text-secondary'>Full Name</h6>
                                    <h2>".$applicant->fname." " .$applicant->mname." ".$applicant->lname."</h2>
                                </div>
                                <div class='row m-2'>
                                    <div class='col'>
                                        <h6 class='text-secondary'>Sex</h6>
                                        <h2>".$applicant->sex."</h2>
                                    </div>
                                    <div class='col'>
                                        <h6 class='text-secondary'>Age</h6>
                                        <h2>".$applicant->age."</h2>
                                    </div>
                                </div>
                                <div class='row m-2'>
                                    <h6 class='text-secondary'>Educational Attainment</h6>
                                    <h2>".$applicant->educ."</h2>
                                </div>
                            </div>
                            <div class='col'>
                                <div class='row m-2'>
                                    <h6 class='text-secondary'>Contact Number</h6>
                                    <h3>".$applicant->cnum."</h3>
                                </div>
                                <div class='row m-2'>
                                    <h6 class='text-secondary'>Email Address</h6>
                                    <h3>".$applicant->email."</h3>
                                </div>
                                <div class='row m-2'>
                                    <h6 class='text-secondary'>Applying for</h6>
                                    <h3>".$applicant->Applyingfor."</h3>
                                </div>
                                <div class='row'>
                                <form action='/display_resume'method='GET' target='_blank'>
                                    <input type='hidden' name='path' value='".$applicant->resume."'>
                                    <button type='submit' class='btn btn-outline-primary w-50 p-2 m-auto'>View Resume</button>
                                </form>
                                </div>
                            </div>
                        </div>
                        <div class='row text-center my-3'>
                            <h3>Interview Details</h3>
                            <div class='col'>
                                <h5>First Interview</h5>
                                ".$first_int."
                            </div>
                            <div class='col'>
                                <h5>Second Interview</h5>
                                ".$second_int."
                            </div>
                        </div>

                        <form action='/InsertOnboardee' method='GET'>
                        <input type='hidden' name='app_id' value='".$applicant->applicant_id."'>
                        <div class='row mt-1'>
                            <div class='col text-center'>
                                <div class='m-2'>
                                    <h3>Choose Position</h3>
                                    <select name='position' id='position' class='h4 py-3 w-50 btn btn-outline-primary'>
                                        ".$pos."
                                    </select>
                                </div>

                                <div class='m-2'>
                                    <h3>Choose Department</h3>
                                    <select name='department' id='department' class='h4 py-3 w-50 btn btn-outline-success'>
                                        ".$dep."
                                    </select>
                                </div>
                            </div>

                            <div class='col'>
                                <div class='m-2 text-center'>
                                    <h3>Enter Employee Rate</h3>
                                    <input type='number' name='rate' class='form-control mx-auto w-75 text-center' step='.01'>
                                </div>
                                <div class='m-2 text-center'>
                                    <h3>Enter Employee Time Schedules</h3>
                                    <div class='row w-100 text-center'>
                                        <div class='col'>
                                            <h5>Time in Schedule</h5>
                                            <input type='text' name='timein' id='timein".$applicant->applicant_id."' class='text-center form-control w-75 m-auto my-2 datetime'>
                                        </div>
                                        <div class='col'>
                                            <h5>Time out Schedule</h5>
                                            <input type='text' name='timeout' id='timeout".$applicant->applicant_id."' class='text-center form-control w-75 m-auto my-2 datetime'>
                                        </div>
                                    </div>

                                <script>
                                $(function () {
                                    $('.datetime').datetimepicker({
                                        format:'H:i',
                                        step: 30,
                                        mask:true,
                                        datepicker:false
                                    });
                                })
                                </script>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class='modal-footer'>
                        <div class='row w-100 text-center'>
                            <div class='col'></div>
                            <div class='col'>
                                <button type='submit' class='btn btn-primary p-2 w-100'>Onboard</button>
                                </form>
                            </div>
                            <div class='col'>
                                <button type='button' class='btn btn-danger w-100 p-2 ' data-dismiss='modal'>Close</button>
                            </div>
                            <div class='col'></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>";
            array_push($modals,$modal);
        }
        return view('pages.hr_staff.onboarding')->with(['profile'=>$profile,'modals'=>$modals]);
    }

    function termination(){
        $profile = UserDetail::where('login_id',session('user_id'))->first();
        return view('pages.hr_staff.termination')->with(['profile'=>$profile]);
    }
    function offboarding(){
        $profile = UserDetail::where('login_id',session('user_id'))->first();
        return view('pages.hr_staff.offboarding')->with(['profile'=>$profile]);
    }
    function schedules(){
        $profile = UserDetail::where('login_id',session('user_id'))->first();
        return view('pages.hr_staff.schedules')->with(['profile'=>$profile]);
    }
    function interview(){
        $profile = UserDetail::where('login_id',session('user_id'))->first();
        return view('pages.hr_staff.interview')->with(['profile'=>$profile]);
    }
    function department(){
        $profile = UserDetail::where('login_id',session('user_id'))->first();
        $departments = Department::all();
        foreach ($departments as $key => $department) {
            $department->emp_count = EmployeeDetail::where('department',$department->department_name)->count();
        }
        return view('pages.hr_staff.department')->with(['profile'=>$profile,'departments'=>$departments]);
    }
    function position(){
        $profile = UserDetail::where('login_id',session('user_id'))->first();
        $positions = Position::all();
        foreach ($positions as $key => $position) {
            $position->employee = EmployeeDetail::where('position',$position->position_title)->get();
        }
        return view('pages.hr_staff.position')->with(['profile'=>$profile, 'positions'=>$positions]);
    }

    function staffmessage(){
        return view('pages.hr_staff.staffmessage');
    }
    function staffnotification(){
        return view('pages.hr_staff.staffnotification');
    }

    function modal_interview_controller($applicant,$detail){
        $int_data = Interview::where('applicant_id',$applicant->applicant_id)->where('interview_detail',$detail)->first();
        if(isset($int_data)){
            if($int_data->score == 'Passed'){
                $color = 'success';
                return "
                <h4>Score: <b class='text-".$color."'>".$int_data->score."</b></h4>
                <textarea readonly class='alert alert-".$color." w-100' rows='6'>".$int_data->feedback."</textarea>
                ";
            }
            elseif($int_data->score == 'Failed'){
                $color = 'danger';
                return "
                <h4>Score: <b class='text-".$color."'>".$int_data->score."</b></h4>
                <textarea readonly class='alert alert-".$color." w-100' rows='6'>".$int_data->feedback."</textarea>
            ";
            }
            else{
                return "<div class='text-danger p-5 border border-danger w-100 h4 rounded mt-5'>Did not Responded</div>";
            }
        }
        else{
            return 'No interview results';
        }
    }
}
