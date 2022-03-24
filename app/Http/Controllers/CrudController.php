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

        $query = DB::table('user_tbl')->insert([
            //check if the username is unique
            'username'=>$request->input('user'),
            'password'=>$request->input('pass'),
            'user_type'=>'applicant',
        ]);

        if($query){
            return back()->with('success','Data has been inserted successfuly');
        }else{
            return back()->with('fail','Something went wrong');
        }
    }
}
