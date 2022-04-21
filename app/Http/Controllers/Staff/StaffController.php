<?php

namespace App\Http\Controllers\Staff;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StaffController extends Controller
{
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
}
