<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\UserCredential;
use App\Models\UserDetail;
use App\Models\ApplicantDetail;
use Fpdf\Fpdf;

class CrudController extends Controller
{
    function crudsignup(Request $request){
        $request->validate([
            'user'=>'required',
            'pass'=>'required',
            'repass'=>'required',
        ]);

        // if the query fails then username is unique so insert new record
        $usernames = UserCredential::where('username',$request->input('user'))->first();
        if(empty($usernames)){
            if($request->input('pass') == $request->input('repass')){
                UserCredential::create([     
                    'username'=>$request->input('user'),
                    'password'=>$request->input('pass'),
                    'user_type'=>'applicant',
                ]);

                
                //get user id of newly created user account
                $user_id = UserCredential::where('username',$request->input('user'))
                            ->first();
                // make session using data
                $request->session()->put('user_id',$user_id->login_id);
                $request->session()->put('user_type',$user_id->user_type);

                // before redirecting, create session to login the newly created user        
                return redirect('/introduce')->with('success', 'Data has been inserted successfuly');
            }else{
                return back()->with('taken','Username is already taken');
            }
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
        $query1 = UserDetail::create([
            'login_id' => session('user_id'), 
            'fname' => session('fname'), 
            'mname' => session('mname'), 
            'lname' => session('lname'), 
            'sex' =>  session('sex'), 
            'age' => session('age'),
            'bday' => session('bday'),  
            'cnum' => session('cnum'), 
            'email' => session('email'),
            'picture' => $picfilepath,   
        ]);

        // SQL insert record to applicants_tbl
        $info_id = UserDetail::where('login_id',session('user_id'))
            ->get('information_id')
            ->first();
            
        $query2 = ApplicantDetail::create([
            'login_id' => session('user_id'), 
            'information_id' =>$info_id->information_id,
            'educ' => session('educ'),  
            'Applyingfor' => $request->input('position'),
            'resume' => $resumefilepath
        ]);

        if($query1 && $query2){      
            // Redirect to applicant dashboard
            return redirect('/applicanthome')->with('success', 'Data has been inserted successfuly');
        }else{
            return back()->with('fail','something went wrong');
        }
    }

    public function deleteApplication(){
        $id = (int) session('user_id');

        UserCredential::where('login_id', $id)->delete();
        UserDetail::where('login_id', $id)->delete();
        ApplicantDetail::where('login_id', $id)->delete();

        return redirect('/logout');
    }

    public function test(){
        $pdf = new FPDF();
  
//Add a new page
$pdf->AddPage();

// Set the font for the text
$pdf->SetFont('Arial', 'B', 18);
  
// Prints a cell with given text 
$pdf->Cell(60,20,'Hello GeeksforGeeks!');
$pdf->Cell(60,20,'Hello GeeksforGeeks!');
  
// return the generated output
$pdf->Output();
  exit;
    }
}
