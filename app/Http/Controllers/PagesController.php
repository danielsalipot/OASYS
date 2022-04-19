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
    function about(){
        return view('pages.about');
    }
    function features(){
        return view('pages.features');
    }

    function datatable(){
        return view('test');
    }

    function login(){
        // check if a user is logged in, redirect them accourdingly
        if(session()->has('user_id') && session('user_type') == 'applicant'){
            return redirect('/applicanthome');
        }
        if(session()->has('user_id') && session('user_type') == 'payroll'){
            return redirect('/payroll');
        }
        return view('pages.login');
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
        if(session->has('user_id')){
            return redirect('introduce');
        }
        return view('pages.applicants.signup');
    }

    function logout(Request $request){
        session()->flush();
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
