<?php

namespace App\Http\Controllers\Staff;
use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\EmployeeDetail;
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
        return view('pages.hr_staff.staffhome')
            ->with(['applicants'=>$applicants,
                'app_count'=>$app_count,
                'off_count'=>$off_count,
                'on_count'=>$on_count,
                'reg_count'=>$reg_count,
                'profile'=>$profile
            ]);
    }

    function onboarding(){
        $profile = UserDetail::where('login_id',session('user_id'))->first();

        $modals = [];
        $applicants = UserCredential::where('user_type','applicant')
            ->join('user_details','user_details.login_id','=','user_credentials.login_id')
            ->join('applicant_details','applicant_details.login_id','=','user_credentials.login_id')
            ->get();

        foreach ($applicants as $key => $applicant) {
            $modal = "<div class='modal' id='profile_modal".$applicant->login_id."'>
            <div class='modal-dialog modal-dialog-centered modal-lg'>
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
                            <div class='col-5'>
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
                        <div class='row mt-4'>
                            <div class='col text-center'>
                                <div class='m-2'>
                                    <h3>Choose Position</h3>
                                    <select name='cars' id='cars' class='h4 py-3 w-50 btn btn-outline-primary'>
                                        <option value='volvo'>Volvo</option>
                                        <option value='saab'>Saab</option>
                                        <option value='opel'>Opel</option>
                                        <option value='audi'>Audi</option>
                                    </select>
                                </div>

                                <div class='m-2'>
                                    <h3>Choose Department</h3>
                                    <select name='cars' id='cars' class='h4 py-3 w-50 btn btn-outline-success'>
                                        <option value='volvo'>Volvo</option>
                                        <option value='saab'>Saab</option>
                                        <option value='opel'>Opel</option>
                                        <option value='audi'>Audi</option>
                                    </select>
                                </div>
                            </div>

                            <div class='col'>
                                <div class='m-2'>
                                    <h3>Enter Employee Rate</h3>
                                    <input type='number' name='rate' class='form-control w-75'>
                                </div>
                                <div class='m-2'>
                                    <h3>Enter Employee Time Schedules</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class='modal-footer'>
                        <div class='row w-100 text-center'>
                            <div class='col'></div>
                            <div class='col'>
                                <button type='button' class='btn btn-primary p-2 w-100'>Onboard</button>
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
}
