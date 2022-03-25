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
        return view('pages.applicants.applying');
    }
    function applicanthome(){
        return view('pages.applicants.applicanthome');
    }
}
