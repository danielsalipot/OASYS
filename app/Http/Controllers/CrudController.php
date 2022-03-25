<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CrudController extends Controller
{
    function crudsignup(Request $request){
        $request->validate([
           'user'=>'required',
           'pass'=>'required',
           'repass'=>'required',
        ]);

        $usernames = DB::select('select username from user_tbl');
        // push usernames into an array
        $unArr = Array();
        foreach ($usernames as $item) {
            array_push($unArr,$item->username);    
        }

        if(!in_array($request->input('user'),$unArr)){
            if($request->input('pass') == $request->input('repass')){
                $query = DB::table('user_tbl')->insert([
                    //check if the username is unique         
                    'username'=>$request->input('user'),
                    'password'=>$request->input('pass'),
                    'user_type'=>'applicant',
                ]);
                // if insert is Okay go to /introduce   
                if($query){
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
                return back()->with('pass','Password did not match');
            }
        }else{
            // return to user creation if username is already taken
            return back()->with('taken','Username is already taken');
        }


    }

    function crudintroduce(Request $request){
        $request->validate([
            'fname'=>'required',
            'mname'=>'required',
            'lname'=>'required',
            'sex'=>'required',
            'age'=>'required',
            'email'=>'required',
            'cnum'=>'required',
            'pic'=>'required',
            'educ'=>'required'
         ]);

         // Store in put session to pass to the next page
         $request->session()->put('fname', $request->input('fname'));
         $request->session()->put('mname', $request->input('mname'));
         $request->session()->put('lname', $request->input('lname'));
         $request->session()->put('sex', $request->input('sex'));
         $request->session()->put('age', $request->input('age'));
         $request->session()->put('email', $request->input('email'));
         $request->session()->put('cnum', $request->input('cnum'));
         $request->session()->put('pic', $request->input('pic'));
         $request->session()->put('educ', $request->input('educ'));

         return redirect('/applying');
    }

    function crudapply(Request $request){
        $query = DB::table('applicants_tbl')->insert([
            'user_id' => session('user_id'), 
            'fname' => session('fname'), 
            'mname' => session('mname'), 
            'lname' => session('lname'), 
            'sex' =>  session('sex'), 
            'age' => session('age'), 
            'educ' => session('educ'),  
            'cnum' => session('cnum'), 
            'email' => session('email'), 
            'Applyingfor' => $request->input('position'),
            'picture' => session('pic'),  
            'resume' => $request->input('resume')
        ]);

        if($query){      
            // Redirect to applicant dashboard
            return redirect('/')->with('success', 'Data has been inserted successfuly');
        }else{
            return back()->with('fail','something went wrong');
        }
    }
}
