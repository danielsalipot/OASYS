<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\employee_activity;
use App\Models\EmployeeDetail;
use App\Models\Learners;
use App\Models\UserDetail;
use Illuminate\Http\Request;

class EmployeeUpdateController extends Controller
{
    public function updateModule(Request $request){
        $module = Learners::find($request->learner_id)->first();

        $employee = EmployeeDetail::where('login_id',session('user_id'))->first();
        employee_activity::create([
            'employee_id' => $employee->employee_id,
            'description' => 'Finished a lesson on ' . $module->module . ' module',
            'activity_date' => date('Y-m-d h:i:s')
        ]);

        Learners::find($request->learner_id)->update([
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

        $module = Learners::find($learner_ids[0])->first();
        $employee = EmployeeDetail::where('login_id',session('user_id'))->first();
        employee_activity::create([
            'employee_id' => $employee->employee_id,
            'description' => 'Completed ' . $module->module . ' module',
            'activity_date' => date('Y-m-d h:i:s')
        ]);

        return back();
    }

    public function employeeUpdateDetail(Request $request){
        $request->validate([
            'fname' => ['required','alpha'],
            'mname' => ['required','alpha'],
            'lname' => ['required','alpha'],
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

            $employee = EmployeeDetail::where('login_id',session('user_id'))->first();
            employee_activity::create([
                'employee_id' => $employee->employee_id,
                'description' => 'Updated employee resume' ,
                'activity_date' => date('Y-m-d h:i:s')
            ]);
        }

        EmployeeDetail::where('login_id',session('user_id'))->update([
            'educ' => $request->educ
        ]);

        UserDetail::where('login_id',session('user_id'))->update([
            'fname' => $request->fname,
            'mname' => $request->mname,
            'lname' => $request->lname,
            'bday' => $request->bday,
            'email' => $request->email,
            'cnum' => $request->cnum,
            'sex' => $request->sex
        ]);

        $employee = EmployeeDetail::where('login_id',session('user_id'))->first();
        employee_activity::create([
            'employee_id' => $employee->employee_id,
            'description' => 'Update employee information on the account' ,
            'activity_date' => date('Y-m-d h:i:s')
        ]);

        return back();
    }
}
