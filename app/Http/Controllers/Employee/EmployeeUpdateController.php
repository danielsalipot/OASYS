<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\EmployeeDetail;
use App\Models\Learners;
use App\Models\UserDetail;
use Illuminate\Http\Request;

class EmployeeUpdateController extends Controller
{
    public function updateModule(Request $request){
        Learners::find($request->learner_id)
            ->update([
                'progress' => 1
            ]);

        return back();
    }

    public function updateCompleteModule(Request $request){
        $learner_ids = explode(';',$request->learner_ids);
        for ($i=0; $i < count($learner_ids) - 1; $i++) {
            Learners::find($learner_ids[$i])
            ->update([
                'progress' => 1,
                'completion_date' => date("Y-m-d"),
            ]);
        }

        return back();
    }

    public function employeeUpdateDetail(Request $request){
        $request->validate([
            'email'=>'required|email',
            'cnum'=>['required','regex:/^(09|\+639)\d{9}$/u'],
            'bday'=>'required',
            'educ'=>'required'
        ]);

        if(isset($request->resume)){
            $resumefilename =  session('user_id').".".$request->file('resume')->getClientOriginalExtension();
            $request->file('resume')->storeAs('resumes', $resumefilename,'public_uploads');
            EmployeeDetail::where('login_id',session('user_id'))->update([
                'resume' =>  "resumes/" . $resumefilename
            ]);
        }

        EmployeeDetail::where('login_id',session('user_id'))->update([
            'educ' => $request->educ
        ]);

        UserDetail::where('login_id',session('user_id'))->update([
            'bday' => $request->bday,
            'email' => $request->email,
            'cnum' => $request->cnum,
            'sex' => $request->sex
        ]);

        return back();
    }
}
