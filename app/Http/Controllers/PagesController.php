<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    function index(){
        return view('pages.index');
    }
    function login(){
        return view('pages.login');
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
        return view('pages.applicants.applicanthome');
    }
}
