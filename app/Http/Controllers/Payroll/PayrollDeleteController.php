<?php

namespace App\Http\Controllers\payroll;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Overtime;
use App\Models\Deduction;
use App\Models\CashAdvance;
use App\Models\Bonus;
use App\Models\MultiPay;
use App\Models\Holiday;
use App\Models\Attendance;
use App\Models\EmployeeDetail;
use App\Models\holiday_attendance;
use App\Models\Leave;
use App\Models\payroll_audit;
use App\Models\notification_message;
use App\Models\notification_receiver;

class PayrollDeleteController extends Controller
{
    public function DeleteOvertime(Request $request){
        $ids = explode(';',$request->overtime_id);

        for ($i=0; $i < count($ids) - 1; $i++) {
            $att_id = Overtime::where('overtime_id',$ids[$i])->first();

            payroll_audit::create([
                'payroll_manager_id' => session()->get('user_id'),
                'type' => 'Overtime',
                'employee' => $att_id->employee_id,
                'activity' => 'Remove Overtime',
                'amount' => '-',
                'tid' => $ids[$i],
            ]);

            // AUTOMATIC SENDING OF NOTIFICATION
            $employee = EmployeeDetail::where('employee_id',$att_id->employee_id)->first();
            $emp_attendance = Attendance::where('attendance_id',$att_id->attendance_id)->first();

            $notif = notification_message::create([
                'sender_id' => session()->get('user_id'),
                'title' => 'Overtime Payment Revoked',
                'message' => $employee->userDetail->fname . " " . $employee->userDetail->mname . " " . $employee->userDetail->lname .
                            " Your overtime on " . $emp_attendance->attendance_date . " had its Payment revoked"
            ]);

            $notif->receivers()->createMany([
                ['receiver_id' => $att_id->employee_id]
            ]);

            Overtime::where('overtime_id',$ids[$i])->delete();
        }

        return redirect('/payroll/overtime');
    }

    public function DeleteDeduction($id){
        $deduction = Deduction::where('deduction_id',$id)->first();
        payroll_audit::create([
            'payroll_manager_id' => session()->get('user_id'),
            'type' => 'Deduction',
            'employee' => $deduction->employee_id,
            'activity' => 'Remove Deduction ('.$deduction->deduction_name.')',
            'amount' => $deduction->deduction_amount,
            'tid' => $deduction->deduction_id,
        ]);

        // AUTOMATIC SENDING OF NOTIFICATION
        $employee = EmployeeDetail::where('employee_id',$deduction->employee_id)->first();

        $notif = notification_message::create([
            'sender_id' => session()->get('user_id'),
            'title' => 'Deduction Removed',
            'message' => $employee->userDetail->fname . " " . $employee->userDetail->mname . " " . $employee->userDetail->lname .
                    " The deduction from " . $deduction->deduction_start_date . ' - ' . $deduction->deduction_end_date .
                    "with an amount of " . $deduction->deduction_amount . " has been revoked"
        ]);

        $notif->receivers()->createMany([
            ['receiver_id' => $deduction->employee_id]
        ]);

        Deduction::where('deduction_id',$id)->delete();

        return redirect('/payroll/deduction');
    }

    public function DeleteCashAdvance($id){
        $ca = CashAdvance::where('cashAdvances_id',$id)->first();
        payroll_audit::create([
            'payroll_manager_id' => session()->get('user_id'),
            'type' => 'Cash Advance',
            'employee' => $ca->employee_id,
            'activity' => 'Remove Cash Advance',
            'amount' => $ca->cashAdvance_amount,
            'tid' => $ca->cashAdvances_id,
        ]);

        // AUTOMATIC SENDING OF NOTIFICATION
        $employee = EmployeeDetail::where('employee_id',$ca->employee_id)->first();

        $notif = notification_message::create([
            'sender_id' => session()->get('user_id'),
            'title' => 'Cash Advance Removed',
            'message' => $employee->userDetail->fname . " " . $employee->userDetail->mname . " " . $employee->userDetail->lname .
                    " Your cash advance with an amount of " . $ca->cashAdvance_amount . "on " . $ca->cash_advance_date .
                    "has been revoked"
        ]);

        $notif->receivers()->createMany([
            ['receiver_id' => $ca->employee_id]
        ]);

        CashAdvance::where('cashAdvances_id',$id)->delete();

        return redirect('/payroll/cashadvance');
    }

    public function DeleteBonus($id){
        $bonus = Bonus::where('bonus_id',$id)->first();
        payroll_audit::create([
            'payroll_manager_id' => session()->get('user_id'),
            'type' => 'Bonus',
            'employee' => $bonus->employee_id,
            'activity' => 'Remove Bonus',
            'amount' => $bonus->bonus_amount,
            'tid' => $bonus->bonus_id,
        ]);

        // AUTOMATIC SENDING OF NOTIFICATION
        $employee = EmployeeDetail::where('employee_id',$bonus->employee_id)->first();

        $notif = notification_message::create([
            'sender_id' => session()->get('user_id'),
            'title' => 'Bonus Removed',
            'message' => $employee->userDetail->fname . " " . $employee->userDetail->mname . " " . $employee->userDetail->lname .
                " The bonus with an amount of  " . $bonus->bonus_amount . "on " . $bonus->bonus_date .
                " has been revoked"
        ]);

        $notif->receivers()->createMany([
            ['receiver_id' => $bonus->employee_id]
        ]);

        Bonus::where('bonus_id',$id)->delete();

        return redirect('/payroll/bonus');
    }

    public function DeleteMultiPay($id){
        $multipay = MultiPay::where('multi_pay_id',$id)->first();

        payroll_audit::create([
            'payroll_manager_id' => session()->get('user_id'),
            'type' => 'Multi Salary',
            'employee' => $multipay->employee_id,
            'activity' => 'Remove Multi Salary',
            'amount' => '-',
            'tid' => $multipay->multi_pay_id,
        ]);

        // AUTOMATIC SENDING OF NOTIFICATION
        $employee = EmployeeDetail::with('UserDetail')->where('employee_id', $multipay->employee_id)->first();
        $emp_attendance = Attendance::where('attendance_id',$multipay->attendance_id)->first();

        $title;
        if($multipay->status == 2){
            $title = 'Double Salary Pay Removed';
        }
        if($multipay->status == 3){
            $title = 'Triple Salary Pay Removed';
        }

        $notif = notification_message::create([
            'sender_id' => session()->get('user_id'),
            'title' => $title,
            'message' => $employee->userDetail->fname . " " . $employee->userDetail->mname . " " . $employee->userDetail->lname .
                        " Your attendance on " . $emp_attendance->attendance_date . "  that recieved " . $title
        ]);

        $notif->receivers()->createMany([
            ['receiver_id' =>  $multipay->employee_id]
        ]);

        MultiPay::where('multi_pay_id',$id)->delete();
        return redirect('/payroll/doublepay');
    }

    public function DeleteHoliday($id){
        $holiday = Holiday::where('holiday_id',$id)->first();

        payroll_audit::create([
            'payroll_manager_id' => session()->get('user_id'),
            'type' => 'Holiday',
            'employee' => ' - ',
            'activity' => 'Unlisted Holiday ('.$holiday->holiday_name.')',
            'amount' => '-',
            'tid' => $holiday->holiday_id,
        ]);

        Holiday::where('holiday_id',$id)->delete();
        return redirect('/payroll/holidays');
    }

    public function DeleteHolidayAllAttendance($id){
        $attendance = holiday_attendance::where('holiday_id',$id)->get();
        foreach ($attendance as $key => $value) {
            $att = Attendance::where('attendance_id',$value->attendance_id)->first();
            $ha_att = holiday_attendance::join('holidays','holidays.holiday_id','=','holiday_attendances.holiday_id')
                ->where('attendance_id',$value->attendance_id)
                ->first();

            payroll_audit::create([
                'payroll_manager_id' => session()->get('user_id'),
                'type' => 'Holiday Attendance',
                'employee' => $att->employee_id,
                'activity' => 'Unpaid holiday ('.$ha_att->holiday_name.')',
                'amount' => '-',
                'tid' => $ha_att->id,
            ]);

            // AUTOMATIC SENDING OF NOTIFICATION
            $employee = EmployeeDetail::where('employee_id',$att->employee_id)->first();
            $emp_attendance = Attendance::where('attendance_id',$value->attendance_id)->first();

            $notif = notification_message::create([
                'sender_id' => session()->get('user_id'),
                'title' => 'Paid Holiday Remove',
                'message' => $employee->userDetail->fname . " " . $employee->userDetail->mname . " " . $employee->userDetail->lname .
                            " the payment on the Holiday on " . $emp_attendance->attendance_date . " will be revoked"
            ]);

            $notif->receivers()->createMany([
                ['receiver_id' => $att->employee_id]
            ]);

            Attendance::where('attendance_id',$value->attendance_id)->delete();
            holiday_attendance::where('attendance_id',$value->attendance_id)->delete();
        }

        return redirect('/payroll/holidays');
    }

    public function DeleteHolidayAttendance($hid,$aid){
        $ha_att = holiday_attendance::join('holidays','holidays.holiday_id','=','holiday_attendances.holiday_id')
            ->join('attendances','attendances.attendance_id','=','holiday_attendances.attendance_id')
            ->where('id',$hid)
            ->first();

        payroll_audit::create([
            'payroll_manager_id' => session()->get('user_id'),
            'type' => 'Holiday Attendance',
            'employee' => $ha_att->employee_id,
            'activity' => 'Unpaid holiday ('.$ha_att->holiday_name.')',
            'amount' => '-',
            'tid' => $ha_att->id,
        ]);

        // AUTOMATIC SENDING OF NOTIFICATION
        $employee = EmployeeDetail::where('employee_id', $ha_att->employee_id)->first();
        $emp_attendance = Attendance::where('attendance_id',$ha_att->attendance_id)->first();

        $notif = notification_message::create([
            'sender_id' => session()->get('user_id'),
            'title' => 'Paid Holiday Removed',
            'message' => $employee->userDetail->fname . " " . $employee->userDetail->mname . " " . $employee->userDetail->lname .
                        " the payment on the Holiday on " . $emp_attendance->attendance_date . " will be revoked"
        ]);

        $notif->receivers()->createMany([
            ['receiver_id' => $ha_att->employee_id]
        ]);

        holiday_attendance::where('id',$hid)->delete();
        Attendance::where('attendance_id',$aid)->delete();

        return redirect('/payroll/holidays');
    }

    public function DeleteLeave($lid,$aid){
        $leave = Leave::where('id',$lid)->first();

        payroll_audit::create([
            'payroll_manager_id' => session()->get('user_id'),
            'type' => 'Leave',
            'employee' => $leave->employee_id,
            'activity' => 'Remove Leave',
            'amount' => '-',
            'tid' => $leave->id,
        ]);

        // AUTOMATIC SENDING OF NOTIFICATION
        $employee = EmployeeDetail::where('employee_id',$leave->employee_id)->first();
        $emp_attendance = Attendance::where('attendance_id',$leave->attendance_id)->first();

        $notif = notification_message::create([
            'sender_id' => session()->get('user_id'),
            'title' => 'Paid Leave Removed',
            'message' => $employee->userDetail->fname . " " . $employee->userDetail->mname . " " . $employee->userDetail->lname .
                        " Your leave on " . $emp_attendance->attendance_date . " has been revoked"
        ]);

        $notif->receivers()->createMany([
            ['receiver_id' => $leave->employee_id]
        ]);

        Attendance::where('attendance_id',$aid)->delete();
        return redirect('/payroll/leave');
    }
}
