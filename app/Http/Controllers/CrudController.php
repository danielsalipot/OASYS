<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CrudController extends Controller
{
    function index(){
        return view('pages.applicants.signup');
    }
    function add(Request $request){
        $request->validate([
           'user'=>'required',
           'pass'=>'required',
           'repass'=>'required'
        ]);

        $usernames = DB::select('select username from user_tbl');
        // push usernames into an array
        $unArr = Array();
        foreach ($usernames as $item) {
            array_push($unArr,$item->username);    
        }

        if(!in_array($request->input('user'),$unArr)){
            $query = DB::table('user_tbl')->insert([
                //check if the username is unique         
                'username'=>$request->input('user'),
                'password'=>$request->input('pass'),
                'user_type'=>'applicant',
            ]);
            // if insert is Okay go to /introduce   
            if(true){
                //get user id of newly created user account
                    $user_id = DB::select("select * from user_tbl where username = '{$request->input('user')}'");
                // make session using data
                    $request->session()->put('user_id',$user_id[0]->id);
                    $request->session()->put('user_type',$user_id[0]->user_type);
                // before redirecting, create session to login the newly created user        
                return redirect('/introduce')->with('success', 'Data has been inserted successfuly');
            }else{
                return back()->with('fail','something went wrong');
            }
        }else{
            // return to user creation if username is already taken
            return back()->with('taken','Username is already taken');
        }


    }
}
