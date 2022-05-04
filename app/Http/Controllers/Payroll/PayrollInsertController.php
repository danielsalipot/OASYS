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
use App\Models\Message;
use App\Models\notification_message;
use App\Models\notification_receiver;
use App\Models\Holiday;
use App\Models\Attendance;
use App\Models\EmployeeDetail;
use App\Models\holiday_attendance;
use App\Models\Leave;

class PayrollInsertController extends Controller
{
    public function InsertOvertime(Request $request){
        Overtime::create([
            'employee_id' => $request->emp_id,
            'attendance_id' => $request->attendance_id
        ]);

        return redirect('/payroll/overtime');
    }

    function InsertDeduction(Request $request)
    {
        $employee_ids = explode(';',$request->hidden_emp_id);
        for ($i=0; $i < count($employee_ids) - 1 ; $i++) {
            Deduction::create([
                'payrollManager_id' => $request->session()->get('user_id'),
                'employee_id' => $employee_ids[$i],
                'deduction_name' => $request->hidden_deduction_name,
                'deduction_start_date' => $request->hidden_deduction_start_date,
                'deduction_end_date' => $request->hidden_deduction_end_date,
                'deduction_amount' => $request->hidden_deduction_amount
            ]);
        }
        return redirect('/payroll/deduction');
    }

    function InsertCashAdvance(Request $request)
    {
        $employee_ids = explode(';',$request->hidden_emp_id);
        for ($i=0; $i < count($employee_ids) - 1 ; $i++) {
            CashAdvance::create([
                'payrollManager_id' => $request->session()->get('user_id'),
                'employee_id' => $employee_ids[$i],
                'cash_advance_date' => $request->hidden_cash_advance_date,
                'cashAdvance_amount' => $request->hidden_cash_advance_amount
            ]);
        }
        return redirect('/payroll/cashadvance');
    }

    function InsertBonus(Request $request)
    {
        $employee_ids = explode(';',$request->hidden_emp_id);
        for ($i=0; $i < count($employee_ids) - 1 ; $i++) {
            Bonus::create([
                'payrollManager_id' => $request->session()->get('user_id'),
                'employee_id' => $employee_ids[$i],
                'bonus_date' => $request->hidden_bonus_date,
                'bonus_amount' => $request->hidden_bonus_amount
            ]);
        }
        return redirect('/payroll/bonus');
    }

    public function InsertMultiPay(Request $request)
    {
        MultiPay::create([
            'payrollManager_id' => $request->session()->get('user_id'),
            'employee_id' => $request->hidden_emp_id,
            'attendance_id' => $request->hidden_attendance_id,
            'status' => $request->hidden_status
        ]);

        return redirect('/payroll/doublepay');
    }

    public function InsertMessage(Request $request)
    {
        Message::create([
            'sender_id' => $request->sid,
            'receiver_id' => $request->rid,
            'message' => $request->msg
        ]);
        return $request->rid;
    }

    public function InsertNotification(Request $request)
    {
        $ids = explode(';',$request->ids);

        $notif = notification_message::create([
            'sender_id' => session()->get('user_id'),
            'title' => $request->title,
            'message' => $request->body
        ]);

        for ($i=0; $i < count($ids) - 1; $i++) {
            $notif->receivers()->createMany([
                ['receiver_id' => $ids[$i]]
            ]);
        }
        return redirect('/payroll/notification');
    }

    public function InsertHoliday(Request $request)
    {
        Holiday::create([
            'holiday_name' => $request->holiday_name,
            'holiday_start_date' => $request->insert_start_date,
            'holiday_end_date' => $request->insert_end_date,
        ]);

        return redirect('/payroll/holidays');
    }

    public function InsertLeave(Request $request)
    {
        $employee_ids = explode(';',$request->hidden_emp_id);
        for ($i=0; $i < count($employee_ids) - 1; $i++) {
            $employee = EmployeeDetail::where('employee_id',$employee_ids[$i])->first();
            $attendance_id = Attendance::insertGetId([
                'employee_id' => $employee->employee_id,
                'time_in' => $employee->schedule_Timein,
                'time_out' => $employee->schedule_Timeout,
                'attendance_date'=> $request->hidden_leave_input
            ]);

            Leave::create([
                'employee_id' => $employee->employee_id,
                'attendance_id' => $attendance_id
            ]);
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
                    $attendance_id = Attendance::insertGetId([
                        'employee_id' => $employee->employee_id,
                        'time_in' => $employee->schedule_Timein,
                        'time_out' => $employee->schedule_Timeout,
                        'attendance_date'=> $dates[$i]
                    ]);

                    $h_id = json_decode($request->holiday);
                    holiday_attendance::create([
                        'holiday_id' => $h_id->holiday_id,
                        'attendance_id' => $attendance_id
                    ]);
                }
            }
        }
        else{
            $employee_ids = explode(';',$request->ids);
            $dates = $this->getDatesFromRange($request->emp_start_date,$request->emp_end_date);
            for ($i=0; $i < ((count($dates) - 1) == 0? 1 : (count($dates) - 1)); $i++) {
                for ($j=0; $j < count($employee_ids) - 1; $j++) {
                    $employee = EmployeeDetail::where('employee_id',$employee_ids[$j])->first();
                    $attendance_id = Attendance::insertGetId([
                        'employee_id' => $employee->employee_id,
                        'time_in' => $employee->schedule_Timein,
                        'time_out' => $employee->schedule_Timeout,
                        'attendance_date'=> $dates[$i]
                    ]);

                    $h_id = json_decode($request->holiday);
                    holiday_attendance::create([
                        'holiday_id' => $h_id->holiday_id,
                        'attendance_id' => $attendance_id
                    ]);
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
