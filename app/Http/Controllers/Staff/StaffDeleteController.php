<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\ApplicantDetail;
use App\Models\Audit;
use App\Models\EmployeeDetail;
use App\Models\Interview;
use App\Models\notification_message;
use App\Models\notification_receiver;
use App\Models\UserCredential;
use App\Models\UserDetail;
use Illuminate\Http\Request;

class StaffDeleteController extends Controller
{
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

        app('App\Http\Controllers\EmailSendingController')->sendCOE( './certificate/employment/'.$link, $employee->userDetail->email, $employee->userDetail->fname,$employee->userDetail->lname);

        EmployeeDetail::with('UserDetail')->where('employee_id',$request->id)->delete();
        UserCredential::where('login_id',$employee->login_id)->delete();
        return back()->with(['delete'=>'The employee has been deleted successfully']);
    }
}
