<?php

namespace App\Http\Controllers\Applicant;

use App\Http\Controllers\Controller;
use App\Models\notification_acknowledgements;
use Illuminate\Http\Request;

use App\Models\UserDetail;
use App\Models\notification_message;
use App\Models\notification_receiver;
use App\Models\Position;

class ApplicantController extends Controller
{
    //Applicants Functions
    function signup(){
        if(session()->has('user_id')){
            return redirect('/applicant/introduce');
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
        $positions = Position::all();
        return view('pages.applicants.applying')->with(['positions'=>$positions]);
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
            $notif = notification_receiver::with('message')
                ->where('receiver_id',session('user_id'))
                ->get();

            foreach ($notif as $key => $value) {
                $value->sender = UserDetail::where('login_id',$value->message->sender_id)->first();
            }


            foreach ($notif as $key => $value) {
                $value->acknowledgements = notification_acknowledgements::where('notification_receiver_id',$value->id)->count();
            }

            return view('pages.applicants.applicanthome',['user'=>$user,'notif'=>$notif]);
        }
        return redirect('/');
    }
}
