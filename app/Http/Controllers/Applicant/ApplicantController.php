<?php

namespace App\Http\Controllers\Applicant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\UserDetail;
use App\Models\Notification;

class ApplicantController extends Controller
{
    //Applicants Functions
    function signup(){
        if(session()->has('user_id')){
            return redirect('introduce');
        }
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
