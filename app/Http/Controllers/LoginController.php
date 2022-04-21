<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\UserCredential;
use App\Models\UserDetail;

class LoginController extends Controller
{
    public function crudlogin(Request $request){
        $request->validate([
            'user'=>'required',
            'pass'=>'required'
        ]);

        //search if the username and password exist and match up
        $check = UserCredential::where('username',$request->input('user'))
                ->where('password',$request->input('pass'))
                ->first();

        if($check){
            // if login credentials is correct, create session
            $request->session()->put('user_id', $check->login_id);
            $request->session()->put('username',$check->username);
            $request->session()->put('password',$check->password);
            $request->session()->put('user_type',$check->user_type);

            //
            switch(session('user_type')){
                case 'applicant':
                    return redirect('/applicant/home');
                    break;
                case 'employee':
                    return redirect('/employee/home');
                    break;
                case 'payroll':
                    return redirect('/payroll/home');
                    break;
                case 'admin':
                    return redirect('/admin/home');
                    break;
                case 'staff':
                    return redirect('/staff/home');
                    break;
                // add more cases for other user type
                default:
                    return redirect('/logout');
            }
        }else{
            return back()->with('fail','incorrect login credentials');
        }
    }

}
