<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    function index(){
        return view('pages.index');
    }
    function signup(){
        return view('pages.applicants.signup');
    }
    function application(){
        return view('pages.applicants.application');
    }
}
