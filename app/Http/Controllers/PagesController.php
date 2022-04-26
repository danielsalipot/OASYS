<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\UserCredential;
use App\Models\UserDetail;
use App\Models\ApplicantDetail;
use App\Models\Notification;

class PagesController extends Controller
{
    function index(){
        return view('pages.index');
    }
    function about(){
        return view('pages.about');
    }
    function features(){
        return view('pages.features');
    }

    function login(){
        // check if a user is logged in, redirect them accourdingly
        if(session()->has('user_id') && session('user_type') == 'applicant'){
            return redirect('/applicant/home');
        }
        if(session()->has('user_id') && session('user_type') == 'payroll'){
            return redirect('/payroll/home');
        }
        return view('pages.login');
    }

    function logout(Request $request){
        session()->flush();
        return redirect('/');
    }

    ////////////////////////////////////////////////////
    // OKAY NA TO GOODS NA PANG DISPLAY LOGIC NA LANG //
    ////////////////////////////////////////////////////

    function test(){
        // Store the file name into variable
        $mydir = 'payslips';
        $myfolder = array_diff(scandir($mydir), array('.', '..'));
        echo $myfolder[2];

        $mysubdir = $mydir."/". $myfolder[2];
        $myfiles = array_diff(scandir($mysubdir), array('.', '..'));
        foreach ($myfiles as $key => $value) {
            echo $value;
        }

        echo "<iframe src=\"/payrolls/payroll(2022-4-16 - 2022-4-30).pdf\" width=\"100%\" style=\"height:100%\"></iframe>";
    }
}
