<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\ApplicantDetail;
use App\Models\Audit;
use App\Models\Clearance;
use App\Models\Department;
use App\Models\EmployeeDetail;
use App\Models\Interview;
use App\Models\notification_message;
use App\Models\Position;
use App\Models\Resigned;
use App\Models\Retired;
use App\Models\Terminated;
use App\Models\UserCredential;
use App\Models\UserDetail;
use Illuminate\Http\Request;

class StaffInsertController extends Controller
{
    public function InsertDepartment(Request $request){
        Department::create([
            'department_name'=> $request->dept_name
        ]);

        Audit::create(['activity_type' => 'staff',
            'payroll_manager_id' => session()->get('user_id'),
            'type' => 'Department',
            'employee' =>  ' - ',
            'activity' => 'Added new department',
            'amount' => $request->dept_name,
            'tid' => '',
        ]);

        return back()->with('success','The action was recorded successfully');
    }

    public function InsertPosition(Request $request){
        Position::create([
            'position_title'=> $request->pos_title,
            'position_description'=> $request->pos_desc
        ]);

        Audit::create(['activity_type' => 'staff',
            'payroll_manager_id' => session()->get('user_id'),
            'type' => 'Position',
            'employee' =>  ' - ',
            'activity' => 'Added new position',
            'amount' => $request->pos_title,
            'tid' => '',
        ]);

        return back()->with('success','The action was recorded successfully');
    }

    public function InsertInterview(Request $request){
        $request->validate([
            'sched'=>'required'
        ]);

        Interview::create([
            'applicant_id'=> $request->emp_id,
            'interview_detail'=> $request->int_status,
            'interview_schedule'=> $request->sched
        ]);

        $applicant_detail = ApplicantDetail::join('user_details','user_details.information_id','=','applicant_details.information_id')
            ->where('applicant_id', $request->emp_id)->first();

        Audit::create(['activity_type' => 'staff',
            'payroll_manager_id' => session()->get('user_id'),
            'type' => 'Interview',
            'employee' =>  $applicant_detail->fname ." ". $applicant_detail->mname ." ". $applicant_detail->lname,
            'activity' => 'Added interview schedule',
            'amount' => 'Date: ' . $request->sched,
            'tid' => '',
        ]);

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


        return back()->with(['insert'=>'The action was recorded successfully']);
    }

    public function InsertOnboardee(Request $request){
        $days = [];
        if(isset($request->sunday)){
            array_push($days,(int)$request->sunday);
        }
        if(isset($request->monday)){
            array_push($days,(int)$request->monday);
        }
        if(isset($request->tuesday)){
            array_push($days,(int)$request->tuesday);
        }
        if(isset($request->wednesday)){
            array_push($days,(int)$request->wednesday);
        }
        if(isset($request->thursday)){
            array_push($days,(int)$request->thursday);
        }
        if(isset($request->friday)){
            array_push($days,(int)$request->friday);
        }
        if(isset($request->saturday)){
            array_push($days,(int)$request->saturday);
        }

        $applicant_detail = ApplicantDetail::where('applicant_id',$request->app_id)->first();
        EmployeeDetail::create([
            'login_id' => $applicant_detail->login_id,
            'information_id' => $applicant_detail->information_id,
            'educ' => $applicant_detail->educ,
            'position' => $request->position,
            'department' => $request->department,
            'rate' => $request->rate,
            'employment_status' => 'Onboardee',
            'resume' => $applicant_detail->resume,
            'start_date' => date('Y-m-d'),
            'schedule_days' => json_encode($days),
            'schedule_Timein' => $request->timein,
            'schedule_Timeout' => $request->timeout,
        ]);


        $detail = UserDetail::where('information_id',  $applicant_detail->information_id)->first();

        $notif = notification_message::create([
            'sender_id' => session('user_id'),
            'title' => 'You have been onboarded',
            'message' => $detail->fname . " " . $detail->mname . " " . $detail->lname .
                        "You have been onboarded on  " . date('Y-m-d')
        ]);

        $notif->receivers()->createMany([
            ['receiver_id' => $applicant_detail->login_id]
        ]);

        Audit::create(['activity_type' => 'staff',
            'payroll_manager_id' => session()->get('user_id'),
            'type' => 'Onboarding',
            'employee' =>  $detail->fname ." ". $detail->mname ." ". $detail->lname,
            'activity' => 'Onboarded new employee',
            'amount' => '-',
            'tid' => '',
        ]);

        UserCredential::where('login_id',$applicant_detail->login_id)->update(['user_type'=>'employee']);
        ApplicantDetail::where('applicant_id',$request->app_id)->delete();

        return back()->with(['insert'=>'The action was recorded successfully']);
    }

    public function InsertClearance(Request $request){
        Clearance::create([
            'employee_id'=> $request->employee_id,
        ]);

        $employee = EmployeeDetail::with('UserDetail')->where('employee_id',$request->employee_id)->first();

        Audit::create(['activity_type' => 'staff',
            'payroll_manager_id' => session()->get('user_id'),
            'type' => 'Clearance',
            'employee' =>  $employee->userDetail->fname ." ". $employee->userDetail->mname ." ". $employee->userDetail->lname,
            'activity' => 'Cleared offboardee for clearance',
            'amount' => ' - ',
            'tid' => '',
        ]);

        $notif = notification_message::create([
            'sender_id' => session('user_id'),
            'title' => 'Cleared for clearance',
            'message' => $employee->userDetail->fname ." ". $employee->userDetail->mname ." ". $employee->userDetail->lname .
                        " You have been cleared on offboardee clearance on" . date('Y-m-d')
        ]);

        $notif->receivers()->createMany([
            ['receiver_id' => $employee->information_id]
        ]);


        return back()->with(['insert'=>'The action was recorded successfully']);
    }

    public function InsertOffboardee(Request $request){
        if($request->term_type == 'Retirement'){
            Retired::create([
                'employee_id'=>$request->emp_id
            ]);
        }
        if($request->term_type == 'Termination'){
            Terminated::create([
                'employee_id'=>$request->emp_id
            ]);
        }
        if($request->term_type == 'Resignation'){
            Resigned::create([
                'employee_id'=>$request->emp_id
            ]);
        }

        $employee = EmployeeDetail::with('UserDetail')->where('employee_id', $request->emp_id)->first();
        Audit::create(['activity_type' => 'staff',
            'payroll_manager_id' => session()->get('user_id'),
            'type' => 'Offboarding',
            'employee' =>  $employee->userDetail->fname ." ". $employee->userDetail->mname ." ". $employee->userDetail->lname,
            'activity' => 'Offboarding an employee',
            'amount' => $request->term_type,
            'tid' => '',
        ]);

        $notif = notification_message::create([
            'sender_id' => session('user_id'),
            'title' => 'Employment status change to offboardee',
            'message' => $employee->userDetail->fname ." ". $employee->userDetail->mname ." ". $employee->userDetail->lname .
                        "Your employment status has been change to offboardee on" . date('Y-m-d')
        ]);

        $notif->receivers()->createMany([
            ['receiver_id' => $employee->information_id]
        ]);


        EmployeeDetail::where('employee_id',$request->emp_id)->update(['employment_status'=>'Offboardee']);
        return back()->with(['insert'=>'The action was recorded successfully']);
    }

}
