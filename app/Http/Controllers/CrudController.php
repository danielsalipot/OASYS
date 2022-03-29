<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CrudController extends Controller
{
    function crudsignup(Request $request){
        $request->validate([
            'user'=>'required',
            'pass'=>'required',
            'repass'=>'required',
        ]);

        // Check if username is already taken
        $usernames = DB::table('login_tbl')
            ->where('username',$request->input('user'))
            ->get('username');
        
        // if $username is empty then username is not taken
        if(!empty($usernames)){
            if($request->input('pass') == $request->input('repass')){
                $query = DB::table('login_tbl')->insert([
                    //check if the username is unique         
                    'username'=>$request->input('user'),
                    'password'=>$request->input('pass'),
                    'user_type'=>'applicant',
                ]);
                // if insert is Okay go to /introduce   
                if($query){
                    //get user id of newly created user account
                    $user_id = DB::table('login_tbl')
                        ->where('username',$request->input('user'))
                        ->first();
                    // make session using data
                    $request->session()->put('user_id',$user_id->login_id);
                    $request->session()->put('user_type',$user_id->user_type);
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
            'bday'=>'required',
            'educ'=>'required'
        ]);

        // Store in put session to pass to the next page
        $request->session()->put('fname',$request->input('fname'));
        $request->session()->put('mname', $request->input('mname'));
        $request->session()->put('lname', $request->input('lname'));
        $request->session()->put('sex', $request->input('sex'));
        $request->session()->put('age', $request->input('age'));
        $request->session()->put('email', $request->input('email'));
        $request->session()->put('cnum', $request->input('cnum'));
        $request->session()->put('educ', $request->input('educ'));
        $request->session()->put('bday', $request->input('bday'));

        return redirect('/applying');
    }

    function crudapply(Request $request){

        //FILE NAMES user id + file extension
        $picfilename =  session('user_id').".".$request->file('picinput')->getClientOriginalExtension();
        $resumefilename =  session('user_id').".".$request->file('resume')->getClientOriginalExtension();

        // saves the picture into storage/public
        $request->file('picinput')->storeAs('pictures', $picfilename,'public_uploads');
        $request->file('resume')->storeAs('resumes', $resumefilename,'public_uploads');

        //file path plus name for saving in the database
        $picfilepath= "pictures/" . $picfilename;
        $resumefilepath= "resume/" . $resumefilename;

        //SQL query for information table
        $query = DB::table('information_tbl')->insert([
            'login_id' => session('user_id'), 
            'fname' => session('fname'), 
            'mname' => session('mname'), 
            'lname' => session('lname'), 
            'sex' =>  session('sex'), 
            'age' => session('age'),
            'bday' => session('bday'),  
            'educ' => session('educ'),  
            'cnum' => session('cnum'), 
            'email' => session('email'), 
        ]);

        // SQL insert record to applicants_tbl
        $info_id = DB::table('information_tbl')
            ->where('login_id',session('user_id'))
            ->get('information_id')
            ->first();
            
        $query = DB::table('applicants_tbl')->insert([
            'login_id' => session('user_id'), 
            'information_id' =>$info_id->information_id,
            'Applyingfor' => $request->input('position'),
            'picture' => $picfilepath,  
            'resume' => $resumefilepath
        ]);

        if($query){      
            // Redirect to applicant dashboard
            return redirect('/applicanthome')->with('success', 'Data has been inserted successfuly');
        }else{
            return back()->with('fail','something went wrong');
        }
    }

    public function deleteApplication(){
        $id = (int) session('user_id');

        DB::table('login_tbl')->where('login-id', $id)->delete();
        DB::table('information_tbl')->where('login_id', $id)->delete();
        DB::table('applicants_tbl')->where('login_id', $id)->detele();

        return redirect('/logout');
    }

    public function test(){
        $faker = Faker::create();
        return $faker->FirstName;
    }
}
