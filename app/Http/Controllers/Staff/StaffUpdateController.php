<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\ApplicantDetail;
use App\Models\Audit;
use App\Models\Clearance;
use App\Models\EmployeeDetail;
use App\Models\Interview;
use App\Models\notification_message;
use App\Models\Resigned;
use App\Models\UserDetail;
use Illuminate\Http\Request;

class StaffUpdateController extends Controller
{
    public function EmployeeDepartmentUpdate(Request $request){
        $ids = explode(';',$request->hidden_emp_id);

        for ($i=0; $i < count($ids)-1; $i++) {
            EmployeeDetail::where('employee_id',$ids[$i])
                ->update([
                    'department' => $request->department_name
                ]);

            $employee = EmployeeDetail::with('UserDetail')->where('employee_id',$ids[$i])->first();
            Audit::create(['activity_type' => 'staff',
                'payroll_manager_id' => session()->get('user_id'),
                'type' => 'Department',
                'employee' =>  $employee->userDetail->fname ." ". $employee->userDetail->mname ." ". $employee->userDetail->lname,
                'activity' => 'Move employee into ' . $request->department_name . ' department',
                'amount' => ' - ',

            ]);

            $head = 'Department Change';
            $text = $employee->userDetail->fname . " " . $employee->userDetail->mname . " " . $employee->userDetail->lname .
            " has been moved to the " . $request->department_name . ' department';

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

        return back()->with(['update'=>'The Employee\'s department has been updated successfully']);
    }

    public function EmployeePositionUpdate(Request $request){
        $ids = explode(';',$request->hidden_emp_id);

        for ($i=0; $i < count($ids)-1; $i++) {
            EmployeeDetail::where('employee_id',$ids[$i])
                ->update([
                    'position' => $request->position_title
                ]);

            $employee = EmployeeDetail::with('UserDetail')->where('employee_id',$ids[$i])->first();
            Audit::create(['activity_type' => 'staff',
                'payroll_manager_id' => session()->get('user_id'),
                'type' => 'Position',
                'employee' =>  $employee->userDetail->fname ." ". $employee->userDetail->mname ." ". $employee->userDetail->lname,
                'activity' => 'Change employee position title into '. $request->position_title,
                'amount' => ' - ',

            ]);

            $head = 'Position Change';
            $text = $employee->userDetail->fname . " " . $employee->userDetail->mname . " " . $employee->userDetail->lname .
            " your position has been changed into " . $request->position_title;

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

        return back()->with(['update'=>'The Employee\'s position has been updated successfully']);
    }

    public function WithResponseInterview(Request $request){
        Interview::find($request->interview_id)->update([
            'response_status'=> 1,
            'score'=> $request->score,
            'feedback'=> $request->feedback
        ]);

        $interview = Interview::find($request->interview_id)->first();
        $employee = UserDetail::where('information_id', ApplicantDetail::where('applicant_id',$interview->applicant_id)->first()->information_id)->first();
        Audit::create(['activity_type' => 'staff',
            'payroll_manager_id' => session()->get('user_id'),
            'type' => 'Interview',
            'employee' =>  $employee->fname ." ". $employee->mname ." ". $employee->lname,
            'activity' => 'Record scores and feedback of applicant',
            'amount' => 'Applicant #'.$interview->applicant_id,

        ]);


        $head = 'Interview Response';
        $text = $employee->fname . " " . $employee->mname . " " . $employee->lname .
        " you scored " .$request->score . " on your interview on " . $interview->interview_schedule . " the feed back was: " . $request->feedback;

        $notif = notification_message::create([
            'sender_id' => session('user_id'),
            'title' => $head,
            'message' => $text
        ]);

        $notif->receivers()->createMany([
            ['receiver_id' => $employee->login_id]
        ]);

        app('App\Http\Controllers\EmailSendingController')->sendNotifEmail($head,$text,
            [['email' => $employee->email, 'name' => $employee->fname . ' ' . $employee->lname]]
        );

        return back()->with(['update'=>'The applicant\'s scores and feedback has been recorded successfully']);
    }

    public function NoResponseInterview(Request $request){
        Interview::find($request->interview_id)->update([
            'response_status'=> 0
        ]);

        $interview = Interview::find($request->interview_id)->first();
        $employee = UserDetail::where('information_id', ApplicantDetail::where('applicant_id',$interview->applicant_id)->first()->information_id)->first();
        Audit::create(['activity_type' => 'staff',
            'payroll_manager_id' => session()->get('user_id'),
            'type' => 'Interview',
            'employee' =>  $employee->fname ." ". $employee->mname ." ". $employee->lname,
            'activity' => 'Recorded a no response on interview',
            'amount' => ' - ',

        ]);

        $head = 'Interview Response';
        $text = $employee->fname . " " . $employee->mname . " " . $employee->lname .
        "You scored did not responded on your interview on " . $interview->interview_schedule;

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

        return back()->with(['update'=>'The applicant\'s no response has been recorded successfully']);
    }

    public function UpdateSchedule(Request $request){
        $employee = EmployeeDetail::with('UserDetail')->where('employee_id',$request->emp_id)->first();
        if($request->sched_type){
            EmployeeDetail::where('employee_id',$request->emp_id)->update(['schedule_Timein'=>$request->sched.':00']);

            Audit::create(['activity_type' => 'staff',
                'payroll_manager_id' => session('user_id'),
                'type' => 'Schedule',
                'employee' =>  $employee->userDetail->fname ." ". $employee->userDetail->mname ." ". $employee->userDetail->lname,
                'activity' => 'Updated employee scheduled time in',
                'amount' => 'Change into: '. $request->sched.':00',

            ]);

            $head = 'Time in schedule changes';
            $text = $employee->fname . " " . $employee->mname . " " . $employee->lname .
            "Your time in schedule has been change into ". $request->sched.':00';

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

            return back()->with(['update'=>'Employee '. $employee->userDetail->fname ." ". $employee->userDetail->mname ." ". $employee->userDetail->lname .' time in has been updated']);
        }
        else{
            EmployeeDetail::where('employee_id',$request->emp_id)->update(['schedule_Timeout'=>$request->sched.':00']);

            Audit::create(['activity_type' => 'staff',
                'payroll_manager_id' => session()->get('user_id'),
                'type' => 'Schedule',
                'employee' =>  $employee->userDetail->fname ." ". $employee->userDetail->mname ." ". $employee->userDetail->lname,
                'activity' => 'Updated employee scheduled time out',
                'amount' => 'Change into: '. $request->sched.':00',

            ]);

            $head = 'Time out schedule changes';
            $text = $employee->fname . " " . $employee->mname . " " . $employee->lname .
            "Your time out schedule has been change into ". $request->sched.':00';

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

            return back()->with(['update'=>'Employee '. $employee->userDetail->fname ." ". $employee->userDetail->mname ." ". $employee->userDetail->lname .' time out has been updated']);
        }
    }

    public function updateScheduleDays(Request $request){
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

        EmployeeDetail::where('employee_id',$request->emp_id)->update([
            'schedule_days' => json_encode($days)
        ]);

        $employee = EmployeeDetail::with('UserDetail')->where('employee_id',$request->emp_id)->first();
        Audit::create(['activity_type' => 'staff',
            'payroll_manager_id' => session('user_id'),
            'type' => 'Schedule',
            'employee' =>  $employee->userDetail->fname ." ". $employee->userDetail->mname ." ". $employee->userDetail->lname,
            'activity' => 'Updated employee scheduled days',
            'amount' => 'Change into: ' . substr_replace($str_days ,"", -1),

        ]);


        $head = 'Schedule days changes';
        $text = $employee->fname . " " . $employee->mname . " " . $employee->lname .
        "Your scheduled days has been change into ".  substr_replace($str_days ,"", -1);

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

        return back()->with(['update'=>'Employee '. $employee->userDetail->fname ." ". $employee->userDetail->mname ." ". $employee->userDetail->lname .' scheduled days has been updated']);
    }

    public function updateEmployeeResignation(Request $request){
        $employee = EmployeeDetail::with('UserDetail')->where('employee_id',Resigned::find($request->id)->employee_id)->first();
        if($request->status){
            Resigned::find($request->id)->update([
                'status' => $request->status,
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

            return back()->with(['update'=>'Employee '. $employee->userDetail->fname ." ". $employee->userDetail->mname ." ". $employee->userDetail->lname .' resignation has been approved']);

        }else{
            Resigned::find($request->id)->update([
                'status' => $request->status,
                'update_date' => date('Y-m-d'),
                'manager_id' => session('user_id')
            ]);

            $head = 'Resignation Update';
            $text = $employee->fname . " " . $employee->mname . " " . $employee->lname .
            "Your resignation has been denied on " . date('Y-m-d');

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

            return back()->with(['update'=>'Employee '. $employee->userDetail->fname ." ". $employee->userDetail->mname ." ". $employee->userDetail->lname .' resignation has been denied']);
        }

    }


    public function updateClearanceItem(Request $request){
        Clearance::find($request->clearance_id)->update([
            'clearance_status' => 1,
            'date_cleared' => date('Y-m-d')
        ]);

        $clearance = Clearance::find($request->clearance_id)->first();
        $employee = EmployeeDetail::with('UserDetail')->where('employee_id',$request->employee_id)->first();
        Audit::create(['activity_type' => 'staff',
            'payroll_manager_id' => session()->get('user_id'),
            'type' => 'Clearance',
            'employee' =>  $employee->userDetail->fname ." ". $employee->userDetail->mname ." ". $employee->userDetail->lname,
            'activity' => 'Cleared '.$clearance->clearance_name.' clearance for employee #' . $request->employee_id,
            'amount' => ' - '
        ]);

        $head = 'Cleared for a clearance';
        $text = $employee->userDetail->fname ." ". $employee->userDetail->mname ." ". $employee->userDetail->lname .
            " You have been cleared in " .$clearance->clearance_name . "clearance on " . date('Y-m-d');

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

        return back()->with(['insert'=>'Employee #'. $request->employee_id . ' has been cleared on ' .$clearance->clearance_name]);
    }

}
