<?php

namespace App\Http\Controllers\Payroll;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Overtime;
use App\Models\CashAdvance;
use App\Models\Deduction;
use App\Models\Bonus;
use App\Models\MultiPay;
use App\Models\Message;
use App\Models\notification_message;
use App\Models\notification_receiver;


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
}
