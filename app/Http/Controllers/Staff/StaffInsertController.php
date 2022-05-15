<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\ApplicantDetail;
use App\Models\Department;
use App\Models\EmployeeDetail;
use App\Models\Interview;
use App\Models\notification_message;
use App\Models\Position;
use App\Models\UserCredential;
use Illuminate\Http\Request;

class StaffInsertController extends Controller
{
    public function InsertDepartment(Request $request){
        Department::create([
            'department_name'=> $request->dept_name
        ]);

        return back()->with('success','The action was recorded successfully');
    }

    public function InsertPosition(Request $request){
        Position::create([
            'position_title'=> $request->pos_title,
            'position_description'=> $request->pos_desc
        ]);

        return back()->with('success','The action was recorded successfully');
    }

    public function InsertInterview(Request $request){
        Interview::create([
            'applicant_id'=> $request->emp_id,
            'interview_detail'=> $request->int_status,
            'interview_schedule'=> $request->sched
        ]);

        $applicant_detail = ApplicantDetail::join('user_details','user_details.information_id','=','applicant_details.information_id')
            ->where('applicant_id', $request->emp_id)->first();

        if($request->int_status == 1){
            $notif = notification_message::create([
                'sender_id' => session()->get('user_id'),
                'title' => 'Your First Interview',
                'message' => $applicant_detail->fname ." ". $applicant_detail->mname ." ". $applicant_detail->lname . " your first interview is scheduled on " . $request->sched
            ]);
        }
        else{
            $notif = notification_message::create([
                'sender_id' => session()->get('user_id'),
                'title' => 'Your Second Interview',
                'message' => $applicant_detail->fname ." ". $applicant_detail->mname ." ". $applicant_detail->lname . " your second interview is scheduled on " . $request->sched
            ]);
        }

        $notif->receivers()->createMany([
            ['receiver_id' => $applicant_detail->login_id]
        ]);


        return back()->with('success','The action was recorded successfully');
    }

    public function InsertOnboardee(Request $request){
        $applicant_detail = ApplicantDetail::where('applicant_id',$request->app_id)->first();

        EmployeeDetail::create([
            'login_id' => $applicant_detail->login_id,
            'information_id' => $applicant_detail->information_id,
            'educ' => $applicant_detail->educ,
            'position' => $applicant_detail->educ,
            'department' => $applicant_detail->educ,
            'rate' => $applicant_detail->educ,
            'employment_status' => 'Onboardee',
            'resume' => $applicant_detail->resume,
            'start_date' => date('Y-m-d'),
            'schedule_Timein' => $request->timein,
            'schedule_Timeout' => $request->timeout,
        ]);

        UserCredential::where('login_id',$applicant_detail->login_id)->update(['user_type'=>'employee']);
        ApplicantDetail::where('applicant_id',$request->app_id)->delete();

        return back()->with('success','The action was recorded successfully');
    }
}
