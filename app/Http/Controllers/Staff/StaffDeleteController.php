<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\ApplicantDetail;
use App\Models\Assessment;
use App\Models\Attendance;
use App\Models\Audit;
use App\Models\Bonus;
use App\Models\CashAdvance;
use App\Models\Clearance;
use App\Models\Deduction;
use App\Models\Department;
use App\Models\employee_activity;
use App\Models\EmployeeDetail;
use App\Models\HealthCheck;
use App\Models\Interview;
use App\Models\Learners;
use App\Models\Leave;
use App\Models\leave_approval;
use App\Models\MultiPay;
use App\Models\notification_message;
use App\Models\notification_receiver;
use App\Models\Overtime;
use App\Models\overtime_approval;
use App\Models\Position;
use App\Models\Regular;
use App\Models\Resigned;
use App\Models\Retired;
use App\Models\Terminated;
use App\Models\UserCredential;
use App\Models\UserDetail;
use Illuminate\Http\Request;

class StaffDeleteController extends Controller
{

    public function deleteDepartment(Request $request){
        $department = Department::find($request->department_id);
        Department::find($request->department_id)->delete();
        return back()->with(['delete'=>'The '. $department->department_name .' department was removed successfully']);
    }

    public function deletePosition(Request $request){
        $position = Position::find($request->position_id);
        Position::find($request->position_id)->delete();
        return back()->with(['delete'=>'The '. $position->position_title .' Position was removed successfully']);
    }

    public function deleteInterviewSchedule(Request $request){
        $applicant = ApplicantDetail::with('UserDetail')
            ->where('applicant_id',Interview::find($request->interview_id)->applicant_id)
            ->first();

        $head = 'Rescheduling of Interview';
        $text = $applicant->fname . " " . $applicant->mname . " " . $applicant->lname .
            "Your interview has been rescheduled.";

            $notif = notification_message::create([
            'sender_id' => session('user_id'),
            'title' => $head,
            'message' => $text
        ]);

        $notif->receivers()->createMany([
            ['receiver_id' => $applicant->login_id]
        ]);

        app('App\Http\Controllers\EmailSendingController')->sendNotifEmail($head,$text,
            [['email' => $applicant->userDetail->email, 'name' => $applicant->userDetail->fname . ' ' . $applicant->userDetail->lname]]
        );

        Interview::find($request->interview_id)->delete();
        return back()->with(['delete'=>'The schedule was removed successfully']);
    }

    public function staffDeleteApplicant(Request $request){
        $employee = UserDetail::where('login_id',$request->login_id)->first();

        Audit::create(['activity_type' => 'staff',
            'payroll_manager_id' => session()->get('user_id'),
            'type' => 'Application',
            'employee' =>  $employee->fname . ' ' . $employee->mname . ' ' . $employee->lname,
            'activity' => 'Deletion of Application',
            'amount' => ' - ',

        ]);

        $head = 'Your account has been deleted';
        $text = $employee->fname . " " . $employee->mname . " " . $employee->lname .
        " your account has been deleted on " . date('Y-m-d');

        app('App\Http\Controllers\EmailSendingController')->sendNotifEmail($head,$text,
            [['email' => $employee->email, 'name' => $employee->fname . ' ' . $employee->lname]]
        );

        UserDetail::where('login_id',$request->login_id)->delete();
        UserCredential::where('login_id',$request->login_id)->delete();
        ApplicantDetail::where('login_id',$request->login_id)->delete();
        notification_receiver::where('receiver_id',$request->login_id)->delete();
        return back()->with(['delete'=>'The action was recorded successfully']);
    }

    public function deleteEmployee(Request $request){
        $employee = EmployeeDetail::with('UserDetail')->where('employee_id',$request->id)->first();
        $link = app('App\Http\Controllers\Staff\CertificateController')->employmentCertificate($request->id);

        if(!$link){
            return redirect('/profile')->with(['coe_fail'=>'Please upload HR staff signature for the Employee COE']);
        }

        Audit::create(['activity_type' => 'staff',
            'payroll_manager_id' => session()->get('user_id'),
            'type' => 'Application',
            'employee' =>  $employee->UserDetail->fname . ' ' . $employee->UserDetail->mname . ' ' . $employee->UserDetail->lname,
            'activity' => 'Deletion of Employee Account',
            'amount' => ' - ',

        ]);

        app('App\Http\Controllers\EmailSendingController')->sendCOE( env('APP_URL').'/certificate/employment/'.$link, $employee->userDetail->email, $employee->userDetail->fname,$employee->userDetail->lname);

        EmployeeDetail::with('UserDetail')->where('employee_id',$request->id)->delete();
        UserCredential::where('login_id',$employee->login_id)->delete();
        Attendance::where('employee_id',$request->id)->delete();
        HealthCheck::where('employee_id',$request->id)->delete();
        employee_activity::where('employee_id',$request->id)->delete();
        CashAdvance::where('employee_id',$request->id)->delete();
        Bonus::where('employee_id',$request->id)->delete();
        Learners::where('employee_id',$request->id)->delete();
        leave_approval::where('employee_id',$request->id)->delete();
        Leave::where('employee_id',$request->id)->delete();
        Assessment::where('employee_id',$request->id)->delete();
        Clearance::where('employee_id',$request->id)->delete();
        Deduction::where('employee_id',$request->id)->delete();
        MultiPay::where('employee_id',$request->id)->delete();
        overtime_approval::where('employee_id',$request->id)->delete();
        Overtime::where('employee_id',$request->id)->delete();
        Regular::where('employee_id',$request->id)->delete();
        Resigned::where('employee_id',$request->id)->delete();
        Retired::where('employee_id',$request->id)->delete();
        Terminated::where('employee_id',$request->id)->delete();


        return back()->with(['delete'=>'The employee has been deleted successfully']);
    }
}
