<?php

namespace App\Http\Controllers;

use App\Models\ApplicantDetail;
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
                ->where('password',md5(md5($request->input('pass'))))
                ->first();

        if($check || session('remember_me')){
            // if login credentials is correct, create session
            $request->session()->put('user_id', $check->login_id);
            $request->session()->put('username',$check->username);
            $request->session()->put('password',$check->password);
            $request->session()->put('user_type',$check->user_type);

            if(isset($request->remem)){
                $request->session()->put('remember_me',1);
            }

            switch($check->user_type){
                case 'applicant':
                    if(ApplicantDetail::where('login_id', $check->login_id)->first()){
                        return redirect('/applicant/home');
                    }else{
                        return redirect('/applicant/introduce');
                    }

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
