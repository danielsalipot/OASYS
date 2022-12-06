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
        $request->validate([
            'dept_name' => 'required'
        ]);

        Department::create([
            'department_name'=> $request->dept_name
        ]);

        Audit::create(['activity_type' => 'staff',
            'payroll_manager_id' => session()->get('user_id'),
            'type' => 'Department',
            'activity' => 'Added new department',
            'amount' => $request->dept_name,

        ]);

        return back()->with('success','The action was recorded successfully');
    }

    public function InsertPosition(Request $request){
        $request->validate([
            'pos_title' => 'required',
            'pos_desc' => 'required'
        ]);

        Position::create([
            'position_title'=> $request->pos_title,
            'position_description'=> $request->pos_desc
        ]);

        Audit::create(['activity_type' => 'staff',
            'payroll_manager_id' => session()->get('user_id'),
            'type' => 'Position',
            'activity' => 'Added new position',
            'amount' => $request->pos_title,

        ]);

        return back()->with('success','The action was recorded successfully');
    }

    public function InsertInterview(Request $request){

        if($request->sched == "____-__-__ __:__"){
            return back()->with(['delete'=>'The schedule field is required']);
        }

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

        ]);


        if($request->int_status == 1){
            $head = 'Your First Interview';
            $text =  $applicant_detail->fname ." ". $applicant_detail->mname ." ". $applicant_detail->lname . " your first interview is scheduled on " . $request->sched;
            $notif = notification_message::create([
                'sender_id' => session()->get('user_id'),
                'title' => $head,
                'message' => $text
            ]);
        }
        else{

            $head = 'Your Second Interview';
            $text = $applicant_detail->fname ." ". $applicant_detail->mname ." ". $applicant_detail->lname . " your second interview is scheduled on " . $request->sched;
            $notif = notification_message::create([
                'sender_id' => session()->get('user_id'),
                'title' => $head,
                'message' => $text
            ]);
        }

        $notif->receivers()->createMany([
            ['receiver_id' => $applicant_detail->login_id]
        ]);

        app('App\Http\Controllers\EmailSendingController')->sendNotifEmail($head,$text,
            [['email' => $applicant_detail->email, 'name' => $applicant_detail->fname . ' ' . $applicant_detail->lname]]
        );

        return back()->with(['insert'=>'The action was recorded successfully']);
    }

    public function InsertOnboardee(Request $request){
        try{
            $days = [];
            $str_days = '';
            if(isset($request->sunday)){
                array_push($days,(int)$request->sunday);
                $str_days .= ' Sunday,';
            }
            if(isset($request->monday)){
                array_push($days,(int)$request->monday);
                $str_days .= ' Monday,';
            }
            if(isset($request->tuesday)){
                array_push($days,(int)$request->tuesday);
                $str_days .= ' Tuesday,';
            }
            if(isset($request->wednesday)){
                array_push($days,(int)$request->wednesday);
                $str_days .= ' Wednesday,';
            }
            if(isset($request->thursday)){
                array_push($days,(int)$request->thursday);
                $str_days .= ' Thursday,';
            }
            if(isset($request->friday)){
                array_push($days,(int)$request->friday);
                $str_days .= ' Friday,';
            }
            if(isset($request->saturday)){
                array_push($days,(int)$request->saturday);
                $str_days .= ' Saturday,';
            }

            $applicant_detail = ApplicantDetail::where('applicant_id',$request->app_id)->first();
            EmployeeDetail::create([
                'login_id' => $applicant_detail->login_id,
                'information_id' => $applicant_detail->information_id,
                'educ' => $applicant_detail->educ,
                'position' => $request->position,
                'department' => $request->department,
                'rate' => $request->rate,
                'employment_status' => 'onboardee',
                'resume' => $applicant_detail->resume,
                'leave_days' => 0,
                'start_date' => date('Y-m-d'),
                'schedule_days' => json_encode($days),
                'schedule_Timein' => $request->timein . ":00",
                'schedule_Timeout' => $request->timeout . ":00",
                'sss_included'=>1,
                'philhealth_included'=>1,
                'pagibig_included'=>1,
            ]);

            $detail = UserDetail::where('information_id',  $applicant_detail->information_id)->first();

            $head = 'You have been onboarded';
            $text = $detail->fname . " " . $detail->mname . " " . $detail->lname .
                " You have been onboarded on  " . date('Y-m-d') . "<br>
                    The details of your employment is as follows </p>
                    <ul>
                        <li><b>Position: </b> ". $request->position ."</li>
                        <li><b>Department: </b> ". $request->department ."</li>
                        <li><b>Hourly Rate: </b> ". $request->rate ."</li>
                        <li><b>Scheduled Days: </b> ".  $str_days ."</li>
                        <li><b>Scheduled Time in: </b> ". $request->timein . ":00" ."</li>
                        <li><b>Scheduled Time out: </b> ". $request->timeout . ":00" ."</li>
                    </ul><p>
                ";

            $notif = notification_message::create([
                'sender_id' => session('user_id'),
                'title' => $head,
                'message' => $text
            ]);

            $notif->receivers()->createMany([
                ['receiver_id' => $applicant_detail->login_id]
            ]);

            app('App\Http\Controllers\EmailSendingController')->sendNotifEmail($head,$text,
                [['email' => $detail->email, 'name' => $detail->fname . ' ' . $detail->lname]]
            );

            Audit::create(['activity_type' => 'staff',
                'payroll_manager_id' => session()->get('user_id'),
                'type' => 'Onboarding',
                'employee' =>  $detail->fname ." ". $detail->mname ." ". $detail->lname,
                'activity' => 'Onboarded new employee',
                'amount' => '-',

            ]);

            UserCredential::where('login_id',$applicant_detail->login_id)->update(['user_type'=>'employee']);
            ApplicantDetail::where('applicant_id',$request->app_id)->delete();

            return back()->with(['insert'=>'The action was recorded successfully']);
        } catch (\Throwable $th) {
            return back()->with(['delete'=>'Invalid submition of onboarding form, please retry']);
        }
    }

    public function InsertOffboardee(Request $request){
        if(isset($request->resignedId)){
            $employee = EmployeeDetail::with('UserDetail')->where('employee_id',Resigned::find($request->resignedId)->employee_id)->first();
            Resigned::where('id',$request->resignedId)->update([
                'status' => 1,
                'update_date' => date('Y-m-d'),
                'manager_id' => session('user_id')
            ]);

            $head = 'Resignation Update';
            $text =$employee->fname . " " . $employee->mname . " " . $employee->lname .
            "Your resignation has been approved on " . date('Y-m-d');

            $notif = notification_message::create([
                'sender_id' => session('user_id'),
                'title' => $head,
                'message' => $text
            ]);

            $notif->receivers()->createMany([
                ['receiver_id' => $employee->login_id]
            ]);

            app('App\Http\Controllers\EmailSendingController')->sendNotifEmail($head,$text,
                [['email' => $employee->userDetail->email, 'name' => $employee->userDetail->fname . ' ' . $employee->userDetail->lname]]
            );
        }

        $clearance_arr = json_decode($request->clearanceHidden);
        foreach ($clearance_arr as $key => $value) {
            Clearance::create([
                'employee_id' => $request->emp_id,
                'clearance_name' => $value,
                'clearance_status' => 0
            ]);
        }

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

        $employee = EmployeeDetail::with('UserDetail')->where('employee_id', $request->emp_id)->first();
        Audit::create(['activity_type' => 'staff',
            'payroll_manager_id' => session()->get('user_id'),
            'type' => 'Offboarding',
            'employee' =>  $employee->userDetail->fname ." ". $employee->userDetail->mname ." ". $employee->userDetail->lname,
            'activity' => 'Offboarding an employee',
            'amount' => $request->term_type,

        ]);

        $head = 'Employment status change to offboardee';
        $text = $employee->userDetail->fname ." ". $employee->userDetail->mname ." ". $employee->userDetail->lname .
        "Your employment status has been change to offboardee on " . date('Y-m-d') .
        "<br>" .
        "Please view your clearance list and comply";

        $notif = notification_message::create([
            'sender_id' => session('user_id'),
            'title' => $head,
            'message' => $text
        ]);

        $notif->receivers()->createMany([
            ['receiver_id' => $employee->information_id]
        ]);

        app('App\Http\Controllers\EmailSendingController')->sendNotifEmail($head,$text,
            [['email' => $employee->userDetail->email, 'name' => $employee->userDetail->fname . ' ' . $employee->userDetail->lname]]
        );

        EmployeeDetail::where('employee_id',$request->emp_id)->update(['employment_status'=>'Offboardee']);
        return back()->with(['insert'=>'The action was recorded successfully']);
    }

}
