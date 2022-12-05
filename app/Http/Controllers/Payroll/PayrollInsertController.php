<?php

namespace App\Http\Controllers\Payroll;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DateTime;
use DatePeriod;
use DateInterval;

use App\Models\Overtime;
use App\Models\CashAdvance;
use App\Models\Deduction;
use App\Models\Bonus;
use App\Models\MultiPay;
use App\Models\notification_message;
use App\Models\Holiday;
use App\Models\Attendance;
use App\Models\EmployeeDetail;
use App\Models\holiday_attendance;
use App\Models\Leave;
use App\Models\Audit;
use App\Models\overtime_approval;
use Carbon\CarbonPeriod;

class PayrollInsertController extends Controller
{
    public function InsertOvertime(Request $request)
    {
        overtime_approval::where('attendance_id',$request->attendance_id)->update([
            'status' => 1,
            'approval_date' => date('Y-m-d'),
            'approver_id' => session('user_id')
        ]);

        $id = Overtime::create([
            'employee_id' => $request->emp_id,
            'attendance_id' => $request->attendance_id,
            'payrollManager_id' => session()->get('user_id')
        ]);

        $employee = EmployeeDetail::with('UserDetail')->where('employee_id',$request->emp_id)->first();

        Audit::create(['activity_type' => 'payroll',
            'payroll_manager_id' => session()->get('user_id'),
            'type' => 'Overtime',
            'employee' => $employee->userDetail->fname . " " . $employee->userDetail->mname . " " . $employee->userDetail->lname,
            'activity' => 'Paid Overtime Attendance (ID:'.$request->attendance_id.')',
            'amount' => '-',
            'tid' => $id->overtime_id,
        ]);

        if(isset($request->chk)){
            // AUTOMATIC SENDING OF NOTIFICATION
            $employee = EmployeeDetail::where('employee_id',$request->emp_id)->first();
            $emp_attendance = Attendance::where('attendance_id',$request->attendance_id)->first();

            $head = 'Overtime Payment';
            $text = $employee->userDetail->fname . " " . $employee->userDetail->mname . " " . $employee->userDetail->lname .
            " Your overtime on " . $emp_attendance->attendance_date . " recieved Overtime Payment";

            $notif = notification_message::create([
                'sender_id' => session()->get('user_id'),
                'title' => $head,
                'message' => $text
            ]);

            $notif->receivers()->createMany([
                ['receiver_id' => $request->emp_id]
            ]);

            app('App\Http\Controllers\EmailSendingController')->sendNotifEmail($head,$text,
                [['email' => $employee->userDetail->email, 'name' => $employee->userDetail->fname . ' ' . $employee->userDetail->lname]]
            );
        }

        return redirect('/payroll/overtime');
    }

    function InsertDeduction(Request $request)
    {
        $employee_ids = explode(';',$request->hidden_emp_id);
        for ($i=0; $i < count($employee_ids) - 1 ; $i++) {
            $id = Deduction::create([
                'payrollManager_id' => $request->session()->get('user_id'),
                'employee_id' => $employee_ids[$i],
                'deduction_name' => $request->hidden_deduction_name,
                'deduction_start_date' => $request->hidden_deduction_start_date,
                'deduction_end_date' => $request->hidden_deduction_end_date,
                'deduction_amount' => $request->hidden_deduction_amount
            ]);

            $employee = EmployeeDetail::with('UserDetail')->where('employee_id',$employee_ids[$i])->first();


            Audit::create(['activity_type' => 'payroll',
                'payroll_manager_id' => session()->get('user_id'),
                'type' => 'Deduction',
                'employee' => $employee->userDetail->fname . " " . $employee->userDetail->mname . " " . $employee->userDetail->lname,
                'activity' => 'Added Deduction Name: '.$request->hidden_deduction_name,
                'amount' => $request->hidden_deduction_amount,
                'tid' => $id->deduction_id,
            ]);

            if(isset($request->chk)){
                // AUTOMATIC SENDING OF NOTIFICATION
                $employee = EmployeeDetail::with('UserDetail')->where('employee_id',$employee_ids[$i])->first();

                $head = 'Deduction on Salary';
                $text = $employee->userDetail->fname . " " . $employee->userDetail->mname . " " . $employee->userDetail->lname .
                    " A deduction has been added on your salary from " . $request->hidden_deduction_start_date . ' - ' . $request->hidden_deduction_end_date .
                    " with an amount of " . $request->hidden_deduction_amount;

                $notif = notification_message::create([
                    'sender_id' => session()->get('user_id'),
                    'title' => $head,
                    'message' => $text
                ]);

                $notif->receivers()->createMany([
                    ['receiver_id' => $employee_ids[$i]]
                ]);

                app('App\Http\Controllers\EmailSendingController')->sendNotifEmail($head,$text,
                    [['email' => $employee->userDetail->email, 'name' => $employee->userDetail->fname . ' ' . $employee->userDetail->lname]]
                );
            }
        }
        return redirect('/payroll/deduction');
    }

    function InsertCashAdvance(Request $request)
    {
        $employee_ids = explode(';',$request->hidden_emp_id);
        for ($i=0; $i < count($employee_ids) - 1 ; $i++) {
            $id = CashAdvance::create([
                'payrollManager_id' => $request->session()->get('user_id'),
                'employee_id' => $employee_ids[$i],
                'cash_advance_date' => $request->hidden_cash_advance_date,
                'cashAdvance_amount' => $request->hidden_cash_advance_amount
            ]);

            $employee = EmployeeDetail::with('UserDetail')->where('employee_id',$employee_ids[$i])->first();

            Audit::create(['activity_type' => 'payroll',
                'payroll_manager_id' => session()->get('user_id'),
                'type' => 'Cash Advance',
                'employee' => $employee->userDetail->fname . " " . $employee->userDetail->mname . " " . $employee->userDetail->lname,
                'activity' => 'Added Cash Advance',
                'amount' => $request->hidden_cash_advance_amount,
                'tid' => $id->cashAdvances_id,
            ]);

            if(isset($request->chk)){
                // AUTOMATIC SENDING OF NOTIFICATION
                $employee = EmployeeDetail::with('UserDetail')->where('employee_id',$employee_ids[$i])->first();

                $head = 'Cash Advance Recorded';
                $text = $employee->userDetail->fname . " " . $employee->userDetail->mname . " " . $employee->userDetail->lname .
                " Your cash advance has been recorded with an amount of " . $request->hidden_cash_advance_amount . "on " . $request->hidden_cash_advance_date;

                $notif = notification_message::create([
                    'sender_id' => session()->get('user_id'),
                    'title' => $head,
                    'message' => $text
                ]);

                $notif->receivers()->createMany([
                    ['receiver_id' => $employee_ids[$i]]
                ]);

                app('App\Http\Controllers\EmailSendingController')->sendNotifEmail($head,$text,
                    [['email' => $employee->userDetail->email, 'name' => $employee->userDetail->fname . ' ' . $employee->userDetail->lname]]
                );
            }
        }

        return redirect('/payroll/cashadvance');
    }

    function InsertBonus(Request $request)
    {
        $employee_ids = explode(';',$request->hidden_emp_id);
        for ($i=0; $i < count($employee_ids) - 1 ; $i++) {
            $id = Bonus::create([
                'payrollManager_id' => $request->session()->get('user_id'),
                'employee_id' => $employee_ids[$i],
                'bonus_date' => $request->hidden_bonus_date,
                'bonus_amount' => $request->hidden_bonus_amount
            ]);

            $employee = EmployeeDetail::with('UserDetail')->where('employee_id',$employee_ids[$i])->first();

            Audit::create(['activity_type' => 'payroll',
                'payroll_manager_id' => session()->get('user_id'),
                'type' => 'Bonus',
                'employee' => $employee->userDetail->fname . " " . $employee->userDetail->mname . " " . $employee->userDetail->lname,
                'activity' => 'Added Bonus',
                'amount' => $request->hidden_bonus_amount,
                'tid' => $id->bonus_id,
            ]);

            if(isset($request->chk)){
                // AUTOMATIC SENDING OF NOTIFICATION
                $employee = EmployeeDetail::with('UserDetail')->where('employee_id',$employee_ids[$i])->first();

                $head = 'Your recieved a Bonus';
                $text =  $employee->userDetail->fname . " " . $employee->userDetail->mname . " " . $employee->userDetail->lname .
                " You recieved a bonus with an amount of  " . $request->hidden_bonus_amount . "on " . $request->hidden_bonus_date;

                $notif = notification_message::create([
                    'sender_id' => session()->get('user_id'),
                    'title' => $head,
                    'message' => $text
                ]);

                $notif->receivers()->createMany([
                    ['receiver_id' => $employee_ids[$i]]
                ]);

                app('App\Http\Controllers\EmailSendingController')->sendNotifEmail($head,$text,
                    [['email' => $employee->userDetail->email, 'name' => $employee->userDetail->fname . ' ' . $employee->userDetail->lname]]
                );
            }
        }
        return redirect('/payroll/bonus');
    }

    public function InsertMultiPay(Request $request)
    {
        $id = MultiPay::create([
            'payrollManager_id' => $request->session()->get('user_id'),
            'employee_id' => $request->hidden_emp_id,
            'attendance_id' => $request->hidden_attendance_id,
            'status' => $request->hidden_status
        ]);

        $employee = EmployeeDetail::with('UserDetail')->where('employee_id',$request->hidden_emp_id)->first();


        Audit::create(['activity_type' => 'payroll',
            'payroll_manager_id' => session()->get('user_id'),
            'type' => 'Multi Salary',
            'employee' => $employee->userDetail->fname . " " . $employee->userDetail->mname . " " . $employee->userDetail->lname,
            'activity' => $request->hidden_status.'X pay attendance (Attendance Id:'.$request->hidden_attendance_id.')',
            'amount' => '-',
            'tid' => $id->multi_pay_id,
        ]);

        if(isset($request->chk)){
        // AUTOMATIC SENDING OF NOTIFICATION
            $employee = EmployeeDetail::with('UserDetail')->where('employee_id',$request->hidden_emp_id)->first();
            $emp_attendance = Attendance::where('attendance_id',$request->hidden_attendance_id)->first();

            if($request->hidden_status == 2){
                $title = 'Double Salary Pay';
            }
            if($request->hidden_status == 3){
                $title = 'Triple Salary Pay';
            }

            $head = $title;
            $text =  $employee->userDetail->fname . " " . $employee->userDetail->mname . " " . $employee->userDetail->lname .
            " Your attendance on " . $emp_attendance->attendance_date . " recieved " . $title;

            $notif = notification_message::create([
                'sender_id' => session()->get('user_id'),
                'title' => $title,
                'message' => $text
            ]);

            $notif->receivers()->createMany([
                ['receiver_id' => $request->hidden_emp_id]
            ]);

            app('App\Http\Controllers\EmailSendingController')->sendNotifEmail($head,$text,
                [['email' => $employee->userDetail->email, 'name' => $employee->userDetail->fname . ' ' . $employee->userDetail->lname]]
            );
        }

        return redirect('/payroll/doublepay');
    }

    public function InsertHoliday(Request $request)
    {
        $request->validate([
            'holiday_name' => 'required',
            'insert_start_date' => 'required',
            'insert_end_date' => 'required',
        ]);

        $id = Holiday::create([
            'holiday_name' => $request->holiday_name,
            'holiday_start_date' => $request->insert_start_date,
            'holiday_end_date' => $request->insert_end_date,
        ]);

        Audit::create(['activity_type' => 'payroll',
            'payroll_manager_id' => session()->get('user_id'),
            'type' => 'Listed Holiday',

            'activity' => $request->holiday_name . ' (' . $request->insert_start_date . ' - '. $request->insert_end_date.')',
            'amount' => '-',
            'tid' => $id->holiday_id,
        ]);

        return redirect('/payroll/holidays');
    }

    public function InsertLeave(Request $request)
    {
        $employee_ids = explode(';',$request->hidden_emp_id);
        for ($i=0; $i < count($employee_ids) - 1; $i++) {
            $employee = EmployeeDetail::with('UserDetail')->where('employee_id',$employee_ids[$i])->first();

            $period = CarbonPeriod::create($request->hidden_leave_from_input, $request->hidden_leave_to_input);
            foreach ($period as $key => $value) {
                $attendance_id = Attendance::create([
                    'employee_id' => $employee->employee_id,
                    'time_in' => $employee->schedule_Timein,
                    'time_out' => $employee->schedule_Timeout,
                    'attendance_day' => date('w',strtotime($value->format('Y-m-d'))),
                    'attendance_date'=> $value->format('Y-m-d')
                ]);

                $id = Leave::create([
                    'employee_id' => $employee->employee_id,
                    'attendance_id' => $attendance_id->attendance_id,
                    'payrollManager_id' =>session()->get('user_id'),
                    'applied_status' => 0,
                ]);
            }

            Audit::create(['activity_type' => 'payroll',
                'payroll_manager_id' => session()->get('user_id'),
                'type' => 'Leave',
                'employee' => $employee->userDetail->fname. ' '. $employee->userDetail->mname . ' '. $employee->userDetail->lname,
                'activity' => 'Paid Leave from '. $request->hidden_leave_from_input . ' to '. $request->hidden_leave_to_input,
                'amount' => '-',
                'tid' => $id->id,
            ]);

            if(isset($request->chk)){
                // AUTOMATIC SENDING OF NOTIFICATION
                $employee = EmployeeDetail::where('employee_id',$employee->employee_id)->first();
                $emp_attendance = Attendance::where('attendance_id',$attendance_id->attendance_id)->first();

                $head = 'Paid Leave Recorded';
                $text = $employee->userDetail->fname . " " . $employee->userDetail->mname . " " . $employee->userDetail->lname .
                " Your leave on " . $emp_attendance->attendance_date . " will recieve payment";

                $notif = notification_message::create([
                    'sender_id' => session()->get('user_id'),
                    'title' => $head,
                    'message' => $text,
                ]);

                $notif->receivers()->createMany([
                    ['receiver_id' => $employee->employee_id]
                ]);

                app('App\Http\Controllers\EmailSendingController')->sendNotifEmail($head,$text,
                    [['email' => $employee->userDetail->email, 'name' => $employee->userDetail->fname . ' ' . $employee->userDetail->lname]]
                );
            }
        }

        return redirect('/payroll/leave');
    }

    public function InsertAttendanceHoliday(Request $request)
    {
        if($request->selected_all){
            $employees = EmployeeDetail::all();
            $dates = $this->getDatesFromRange($request->emp_start_date,$request->emp_end_date);
            for ($i=0; $i < ((count($dates) - 1) == 0? 1 : (count($dates) - 1)); $i++) {
                foreach ($employees as $key => $employee) {
                    $attendance_id = Attendance::create([
                        'employee_id' => $employee->employee_id,
                        'time_in' => $employee->schedule_Timein,
                        'time_out' => $employee->schedule_Timeout,
                        'attendance_day' => date('w',strtotime($dates[$i])),
                        'attendance_date'=> $dates[$i]
                    ]);

                    $h_id = json_decode($request->holiday);
                    $id = holiday_attendance::create([
                        'holiday_id' => $h_id->holiday_id,
                        'attendance_id' =>$attendance_id->attendance_id,
                        'payrollManager_id' =>session()->get('user_id')
                    ]);

                    $employee = EmployeeDetail::with('UserDetail')->where('employee_id',$employee->employee_id)->first();

                    Audit::create(['activity_type' => 'payroll',
                        'payroll_manager_id' => session()->get('user_id'),
                        'type' => 'Holiday',
                        'employee' => $employee->userDetail->fname. ' '. $employee->userDetail->mname . ' '. $employee->userDetail->lname,
                        'activity' => 'Paid Holiday',
                        'amount' => '-',
                        'tid' => $id->id,
                    ]);

                    if(isset($request->chk)){
                        // AUTOMATIC SENDING OF NOTIFICATION
                        $employee = EmployeeDetail::where('employee_id',$employee->employee_id)->first();
                        $emp_attendance = Attendance::where('attendance_id',$attendance_id->attendance_id)->first();

                        $head = 'Paid Holiday';
                        $text = $employee->userDetail->fname . " " . $employee->userDetail->mname . " " . $employee->userDetail->lname .
                        " the Holiday on " . $emp_attendance->attendance_date . " will be a paid holiday";

                        $notif = notification_message::create([
                            'sender_id' => session()->get('user_id'),
                            'title' => $head,
                            'message' => $text
                        ]);

                        $notif->receivers()->createMany([
                            ['receiver_id' => $employee->employee_id]
                        ]);

                        app('App\Http\Controllers\EmailSendingController')->sendNotifEmail($head,$text,
                            [['email' => $employee->userDetail->email, 'name' => $employee->userDetail->fname . ' ' . $employee->userDetail->lname]]
                        );
                    }
                }
            }
        }
        else{
            $employee_ids = explode(';',$request->ids);
            $dates = $this->getDatesFromRange($request->emp_start_date,$request->emp_end_date);
            for ($i=0; $i < ((count($dates) - 1) == 0? 1 : (count($dates) - 1)); $i++) {
                for ($j=0; $j < count($employee_ids) - 1; $j++) {
                    $employee = EmployeeDetail::where('employee_id',$employee_ids[$j])->first();
                    $attendance_id = Attendance::create([
                        'employee_id' => $employee->employee_id,
                        'time_in' => $employee->schedule_Timein,
                        'time_out' => $employee->schedule_Timeout,
                        'attendance_day' => date('w',strtotime($dates[$i])),
                        'attendance_date'=> $dates[$i]
                    ]);

                    $h_id = json_decode($request->holiday);
                    $id = holiday_attendance::create([
                        'holiday_id' => $h_id->holiday_id,
                        'attendance_id' =>$attendance_id->attendance_id,
                        'payrollManager_id' =>session()->get('user_id')
                    ]);

                    $employee = EmployeeDetail::with('UserDetail')->where('employee_id',$employee->employee_id)->first();

                    Audit::create(['activity_type' => 'payroll',
                        'payroll_manager_id' => session()->get('user_id'),
                        'type' => 'Holiday',
                        'employee' => $employee->userDetail->fname. ' '. $employee->userDetail->mname . ' '. $employee->userDetail->lname,
                        'activity' => 'Paid Holiday',
                        'amount' => '-',
                        'tid' => $id->id,
                    ]);

                    if(isset($request->chk)){
                        // AUTOMATIC SENDING OF NOTIFICATION
                        $employee = EmployeeDetail::where('employee_id',$employee->employee_id)->first();
                        $emp_attendance = Attendance::where('attendance_id',$attendance_id->attendance_id)->first();

                        $head = 'Paid Holiday';
                        $text = $employee->userDetail->fname . " " . $employee->userDetail->mname . " " . $employee->userDetail->lname .
                        " the Holiday on " . $emp_attendance->attendance_date . " will be a paid holiday";
                        $notif = notification_message::create([
                            'sender_id' => session()->get('user_id'),
                            'title' => $head,
                            'message' => $text
                        ]);

                        $notif->receivers()->createMany([
                            ['receiver_id' => $employee->employee_id]
                        ]);

                        app('App\Http\Controllers\EmailSendingController')->sendNotifEmail($head,$text,
                            [['email' => $employee->userDetail->email, 'name' => $employee->userDetail->fname . ' ' . $employee->userDetail->lname]]
                        );
                    }
                }
            }
        }

        return redirect('/payroll/holidays');
    }

    function getDatesFromRange($start, $end, $format = 'Y-m-d') {
        // Declare an empty array
        $array = array();

        // Variable that store the date interval
        // of period 1 day
        $interval = new DateInterval('P1D');

        $realEnd = new DateTime($end);
        $realEnd->add($interval);

        $period = new DatePeriod(new DateTime($start), $interval, $realEnd);

        // Use loop to store date into array
        foreach($period as $date) {
            $array[] = $date->format($format);
        }

        // Return the array elements
        return $array;
    }
}
