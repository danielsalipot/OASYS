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
use App\Models\Resigned;
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
            ->orderBy('applicant_details.created_at',"ASC")
            ->get();

        $app_count = UserCredential::where('user_type','applicant')->count();
        $off_count = Offboardee::all()->count();
        $on_count = Onboardee::all()->count();
        $reg_count = Regular::all()->count();

        $profile = UserDetail::where('login_id',session('user_id'))->first();

        $date = date("Y-m-d H:i:s");
        $interviews = Interview::join('applicant_details','applicant_details.applicant_id','=','interviews.applicant_id')
            ->join('user_details','user_details.information_id','=','applicant_details.information_id')
            ->where('interviews.interview_schedule','like', date("Y-m-d", strtotime($date))."%")
            ->get();

        return view('pages.HR_Staff.staffhome')
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
                            <div class='row mb-3'>
                                <div class='col-3'>
                                <img src='/".$applicant->picture."' class='rounded-circle w-100 h-100 shadow-sm'>
                                </div>
                                <div class='col-5'>
                                    <div class='row m-2'>
                                        <h6 class='text-secondary'>Full Name</h6>
                                        <h2>".$applicant->fname." " .$applicant->mname." ".$applicant->lname."</h2>
                                    </div>
                                    <div class='row m-2'>
                                        <div class='col'>
                                            <h6 class='text-secondary'>Gender</h6>
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
                                <div class='col text-center'>
                                    <div class='row m-2'>
                                        <h6 class='text-secondary'>Contact Number</h6>
                                        <h3>".$applicant->cnum."</h3>
                                    </div>
                                    <div class='row m-2'>
                                        <h6 class='text-secondary'>Email Address</h6>
                                        <h6>".$applicant->email."</h6>
                                    </div>
                                    <div class='row m-2'>
                                        <h6 class='text-secondary'>Applying for</h6>
                                        <h3>".$applicant->Applyingfor."</h3>
                                    </div>
                                    <div class='row'>
                                    <form action='/display_resume'method='GET' target='_blank'>
                                        <input type='hidden' name='path' value='".$applicant->resume."'>
                                        <button type='submit' class='btn btn-outline-primary border-0 w-50 p-2 m-auto'>View Resume</button>
                                    </form>
                                    </div>
                                </div>
                            </div>
                            <div class='row text-center alert-secondary mx-auto p-4'>
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

                            <form action='/InsertOnboardee' method='GET' class='m-0 p-0'>
                            <input type='hidden' name='app_id' value='".$applicant->applicant_id."'>
                            <div class='row w-100 alert-primary p-3 mx-auto'>
                                <div class='col-5 text-left'>
                                    <div class='m-2'>
                                        <h6>Choose Position</h6>
                                        <select name='position' id='position' class='h4 py-3 w-100 btn btn-outline-primary bg-white text-primary'>
                                            ".$pos."
                                        </select>
                                    </div>

                                    <div class='m-2'>
                                        <h6>Choose Department</h6>
                                        <select name='department' id='department' class='h4 py-3 w-100 btn btn-outline-success bg-white text-success'>
                                            ".$dep."
                                        </select>
                                    </div>

                                    <div class='m-2'>
                                        <h6>Enter Employee Rate</h6>
                                        <input type='number' name='rate' class='form-control w-100 text-center' step='.01' placeholder='000.00'>
                                    </div>
                                </div>

                                <div class='col border-start border-primary'>
                                    <div class='m-2 text-center mt-4'>
                                    <h6>Schedule Days</h6>
                                        <div class='row'>
                                            <div class='col'>
                                                <input type='checkbox' id='sunday' name='sunday' value='0'>
                                                <label for='sunday'>Sunday</label><br>
                                            </div>
                                            <div class='col'>
                                                <input type='checkbox' id='monday' name='monday' value='1'>
                                                <label for='monday'>Monday</label><br>
                                            </div>
                                            <div class='col'>
                                                <input type='checkbox' id='tuesday' name='tuesday' value='2'>
                                                <label for='tuesday'>Tuesday</label><br>
                                            </div>
                                            <div class='col'>
                                                <input type='checkbox' id='wednesday' name='wednesday' value='3'>
                                                <label for='wednesday'>Wednesday</label><br>
                                            </div>
                                            <div class='col'>
                                                <input type='checkbox' id='thursday' name='thursday' value='4'>
                                                <label for='thursday'>Thursday</label><br>
                                            </div>
                                            <div class='col'>
                                                <input type='checkbox' id='friday' name='friday' value='5'><br>
                                                <label for='friday'>Friday</label><br>
                                            </div>
                                            <div class='col'>
                                                <input type='checkbox' id='saturday' name='saturday' value='6'>
                                                <label for='saturday'>Saturday</label><br>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class='mx-3'>
                                    <div class='m-2 text-center'>
                                        <h5>Enter Employee Time Schedules</h5>

                                        <div class='row w-100 text-center'>
                                            <div class='col'>
                                                <h6>Time in Schedule</h6>
                                                <input type='text' name='timein' id='timein".$applicant->applicant_id."' class='text-center form-control w-75 m-auto my-2 datetime'>
                                            </div>
                                            <div class='col'>
                                                <h6>Time out Schedule</h6>
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
                                <div class='col-9'>
                                    <button type='submit' class='btn btn-outline-primary p-3 w-100'>Onboard</button>
                                    </form>
                                </div>
                                <div class='col'>
                                    <button type='button' class='btn btn-outline-danger w-100 p-3 ' data-dismiss='modal'>Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>";
            array_push($modals,$modal);
        }
        return view('pages.HR_Staff.onboarding')->with(['profile'=>$profile,'modals'=>$modals]);
    }

    function termination(){
        $profile = UserDetail::where('login_id',session('user_id'))->first();

        $resigneds = Resigned::where('status',null)->get();
        foreach ($resigneds as $key => $value) {
            $value->employee = EmployeeDetail::with('UserDetail')->where('employee_id',$value->employee_id)->first();
        }

        return view('pages.HR_Staff.termination')->with([
            'profile' => $profile,
            'resigneds' => $resigneds
        ]);
    }

    function offboarding(){
        $profile = UserDetail::where('login_id',session('user_id'))->first();
        return view('pages.HR_Staff.offboarding')->with(['profile'=>$profile]);
    }

    function schedules(){
        $profile = UserDetail::where('login_id',session('user_id'))->first();
        return view('pages.HR_Staff.schedules')->with(['profile'=>$profile]);
    }

    function interview(){
        $profile = UserDetail::where('login_id',session('user_id'))->first();
        return view('pages.HR_Staff.interview')->with(['profile'=>$profile]);
    }

    function department(){
        $profile = UserDetail::where('login_id',session('user_id'))->first();

        $all_dept = Department::all();
        foreach ($all_dept as $key => $dept) {
            $dept->emp_count = EmployeeDetail::where('department',$dept->department_name)->count();
        }

        $departments = Department::paginate(5);
        foreach ($departments as $key => $department) {
            $department->emp_count = EmployeeDetail::where('department',$department->department_name)->count();
            $department->delete_btn = "
            <button type='submit' class='btn btn-outline-danger px-3 py-3'>
            <i class='h4 bi bi-trash-fill'></i><br>
            Delete
            </button>";
        }
        return view('pages.HR_Staff.department')->with(['profile'=>$profile,'departments'=>$departments,'all_dept'=>$all_dept]);
    }


    function position(){
        $profile = UserDetail::where('login_id',session('user_id'))->first();
        $positions = Position::all();
        foreach ($positions as $key => $position) {
            $position->employee = EmployeeDetail::where('position',$position->position_title)->get();
            $position->delete_btn = "
            <button type='submit' class='btn btn-outline-danger px-3 py-3'>
            <i class='h4 bi bi-trash-fill'></i><br>
            Delete
            </button>";
        }
        return view('pages.HR_Staff.position')->with(['profile'=>$profile, 'positions'=>$positions]);
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

        $files_arr['files'] = array_reverse($files_arr['files']);

        return view('pages.HR_Staff.audittrail')->with([
            'profile' => $profile,
            'files_arr' => $files_arr
        ]);
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
                return "<div class='text-warning p-5 border border-warning w-100 h4 rounded mt-5'>No Response</div>";
            }
        }
        else{
            return 'No interview results';
        }
    }

    function modal_generator($modal_id,$head,$body,$foot){
        $modal = "
            <div class='modal' id='".$modal_id."'>
                <div class='modal-dialog modal-dialog-centered modal-lg w-100'>
                    <div class='modal-content'>

                        <!-- Modal Header -->
                        <div class='modal-header'>
                            ".$head."
                        </div>

                        <!-- Modal body -->
                        <div class='modal-body row'>
                            ".$body."
                        </div>

                        <!-- Modal footer -->
                        <div class='modal-footer'>
                            ".$foot."
                        </div>
                    </div>
                </div>
            </div>";
    }

    public function staffManual(){
        $profile = UserDetail::where('login_id',session('user_id'))->first();
        return view('pages.HR_Staff.manual')->with([
            'profile' => $profile
        ]);
    }
}
