<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller
{
    function index(){
        return view('pages.index');
    }
    function login(){
        // check if a user is logged in, redirect them accourdingly
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
    function hradminhome(){
        return view('pages.hr_admin.hradminhome');
    }
    function hradminattendance(){
        return view('pages.hr_admin.hradminattendance');
    }
    function hradminperformance(){
        return view('pages.hr_admin.hradminperformance');
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
        if(session()->has('fname')){
            return redirect('applying');
        }
        return view('pages.applicants.introduce');
    }
    function applying(){
        // // if user id in session is already in the applicant database redirect to login
        // // to prevent duplicate entries
        // $checkuser = DB::select('select user_id from applicants_tbl where user_id = ' . session('user_id'));
        // if($checkuser){
        //     return view('pages.login');
        // }
        return view('pages.applicants.applying');
    }
    function applicanthome(){
        // check if their is a logged in user
        if(session()->has('user_id') && session('user_type') == 'applicant'){
            //SQL query the data of the logged user for the dashboard
            $info = DB::select('select * from information_tbl where login_id = ' . session('user_id'));
            $applicants = DB::select('select Applyingfor,picture,resume from applicants_tbl where login_id = ' . session('user_id'));
            $user = (object)array_merge((Array)$info[0],(Array)$applicants[0]);

            //Search for notifications 
            $notif = DB::select('select * from notif_tbl where receiver_id = ' . session('user_id'));
            return view('pages.applicants.applicanthome',['user'=>$user,'notif'=>$notif]);
        }
        return redirect('/');
    }

}
