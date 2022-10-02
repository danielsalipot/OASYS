<?php

namespace App\Http\Controllers;

use App\Models\coe;
use App\Models\EmployeeDetail;
use App\Models\UserCredential;
use App\Models\UserDetail;
use Illuminate\Http\Request;

class RequestCertificate extends Controller
{
    function requestCOE(){
        return view('pages.certificate.employment');
    }

    function sendRequestCOE(Request $request){
        if(isset($request->username)){
            $coe = coe::where('fname',$request->fname)
                ->where('lname',$request->lname)
                ->where('username',$request->username)
                ->first();

            if(!isset($coe)){
                return back()->with(['user_err'=>'Incorrect credentials was submitted']);
            }

            app('App\Http\Controllers\EmailSendingController')->sendCOE( env('APP_URL').'/certificate/employment/'.$coe->employee_id, $coe->email, $coe->fname,$coe->lname);
            return back()->with(['success'=>'Email has been sent to the email address of the employee account']);
        }
        elseif(isset($request->email)){
            $coe = coe::where('fname',$request->fname)
                ->where('lname',$request->lname)
                ->where('email',$request->email)
                ->first();

            if(!isset($coe)){
                return back()->with(['email_err'=>'Incorrect credentials was submitted']);
            }

            app('App\Http\Controllers\EmailSendingController')->sendCOE( env('APP_URL').'/certificate/employment/'.$coe->employee_id, $coe->email, $coe->fname,$coe->lname);
            return back()->with(['success'=>'Email has been sent to the email address of the employee account']);
        }
        else{
            return back();
        }
    }
}
