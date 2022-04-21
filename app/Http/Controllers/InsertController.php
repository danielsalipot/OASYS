<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Overtime;
use App\Models\CashAdvance;
use App\Models\Deduction;


class InsertController extends Controller
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
}

