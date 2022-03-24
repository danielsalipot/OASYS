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
        return view('pages.applicants.signup');
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
