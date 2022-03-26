<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class LoginController extends Controller
{
    public function crudlogin(Request $request){
        $request->validate([
            'user'=>'required',
            'pass'=>'required'
        ]);

        //search if the username and password exist and match up
        $check = DB::select("select * from user_tbl where username ='{$request->input('user')}' and password = '{$request->input('pass')}'");
        if($check){
            // if login credentials is correct, create session
            $request->session()->put('user_id',$check[0]->id);
            $request->session()->put('username',$check[0]->username);
            $request->session()->put('password',$check[0]->password);
            $request->session()->put('user_type',$check[0]->user_type);

            //
            switch(session('user_type')){
                case 'applicant':
                    return redirect('/applicanthome');
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
