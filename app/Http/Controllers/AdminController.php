<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
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

}
