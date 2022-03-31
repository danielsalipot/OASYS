<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\UserCredential;
use App\Models\UserDetail;
use App\Models\ApplicantDetail;
use App\Models\Notification;

class PagesController extends Controller
{
    function index(){
        return view('pages.index');
    }
    function login(){
        // check if a user is logged in, redirect them accourdingly
        if(session()->has('user_id') && session('user_type') == 'applicant'){
            return redirect('/applicanthome');
        }
        return view('pages.login');
    }
    
    //Payroll Manager Functions
    function payroll(){
        return view('pages.payroll_manager.payroll');
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
    function deductiontype(){
        return view('pages.payroll_manager.deductiontype');
    }
    function message(){
        return view('pages.payroll_manager.message');
    }
    function notification(){
        return view('pages.payroll_manager.notification');
    }

    //HR Admin Functions
    function adminhome(){
        return view('pages.hr_admin.adminhome');
    }
    function attendance(){
        return view('pages.hr_admin.attendance');
    }
    function performance(){
        return view('pages.hr_admin.performance');
    }
    function peopleorientation(){
        return view('pages.hr_admin.peopleorientation');
    }
    function moduleorientation(){
        return view('pages.hr_admin.moduleorientation');
    }
    function peoplecorrection(){
        return view('pages.hr_admin.peoplecorrection');
    }
    function modulecorrection(){
        return view('pages.hr_admin.modulecorrection');
    }
    function peopletraining(){
        return view('pages.hr_admin.peopletraining');
    }
    function moduletraining(){
        return view('pages.hr_admin.moduletraining');
    }
    function adminmessage(){
        return view('pages.hr_admin.adminmessage');
    }
    function adminnotification(){
        return view('pages.hr_admin.adminnotification');
    }

    //HR Staff Functions
    function staffhome(){
        return view('pages.hr_staff.staffhome');
    }
    function onboarding(){
        return view('pages.hr_staff.onboarding');
    }
    function termination(){
        return view('pages.hr_staff.termination');
    }
    function offboarding(){
        return view('pages.hr_staff.offboarding');
    }
    function schedules(){
        return view('pages.hr_staff.schedules');
    }
    function interview(){
        return view('pages.hr_staff.interview');
    }
    function department(){
        return view('pages.hr_staff.department');
    }
    function position(){
        return view('pages.hr_staff.position');
    }
    function staffmessage(){
        return view('pages.hr_staff.staffmessage');
    }
    function staffnotification(){
        return view('pages.hr_staff.staffnotification');
    }

    //Employee Functions
    function employeehome(){
        return view('pages.employee.employeehome');
    }
    function employeeorientation(){
        return view('pages.employee.employeeorientation');
    }
    function employeetraining(){
        return view('pages.employee.employeetraining');
    }
    function employeecorrection(){
        return view('pages.employee.employeecorrection');
    }
    function employeemessage(){
        return view('pages.employee.employeemessage');
    }
    function employeeprofile(){
        return view('pages.employee.employeeprofile');
    }


    //Applicants Functions
    function signup(){
        if(session()->has('user_id')){
            return redirect('introduce');
        }
        return view('pages.applicants.signup');
    }

    function logout(Request $request){
        $request->session()->flush();
        return redirect('/');
    }

    function application(){
        return view('pages.applicants.application');
    }

    function introduce(){
        return view('pages.applicants.introduce');
    }
    function applying(){
        return view('pages.applicants.applying');
    }
    function applicanthome(){
        // check if their is a logged in user
        if(session()->has('user_id') && session('user_type') == 'applicant'){
            //SQL query the data of the logged user for the dashboard
            $user = UserDetail::join('applicant_details','user_details.login_id','=','applicant_details.login_id')
                    ->get(['user_details.*','applicant_details.*'])
                    ->where('login_id',session('user_id'))
                    ->first();
                    
            //Search for notifications 
            $notif = Notification::where('receiver_id',session('user_id'))->get();
            return view('pages.applicants.applicanthome',['user'=>$user,'notif'=>$notif]);
        }
        return redirect('/');
    }

}
