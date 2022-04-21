<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Overtime;
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
                'payrollManager_id' => '2',
                'employee_id' => $employee_ids[0],
                'deduction_name' => $request->hidden_deduction_name,
                'deduction_date' => $request->hidden_deduction_date,
                'deduction_amount' => $request->hidden_deduction_amount
            ]);

        }

        return redirect('/payroll/deduction');
    }
}

