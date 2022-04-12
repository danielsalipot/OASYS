<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\EmployeeDetail;
use App\Models\Attendance;
//TODO: PAYROLL AND PAYSLIP FUNCTIONS
class JsonController extends Controller
{

    function Payroll1(){
        $PayrollDetails = EmployeeDetail::with('UserDetail','CashAdvance','Taxes','Deduction')->get();

        foreach ($PayrollDetails as $key => $value) {
            $value->attendance = $value->FilteredAttendance($value->employee_id, '2012-1-1','2022-1-1');
            if(!count($value->attendance) > 0){
                $json_arr = json_decode($PayrollDetails,true);
                unset($json_arr[$key]);
                $PayrollDetails = array_values($json_arr);
            }
        }

        return $PayrollDetails;
    }

    //FILTERED THE DATES OF ATTENDANCE, cash advance, and deductions
    function payroll(Request $request){
        if(request()->ajax()){
            if(!empty($request->from_date)){
                $PayrollDetails = EmployeeDetail::with('UserDetail','CashAdvance','Taxes','Deduction')->get();
                foreach ($PayrollDetails as $key => $value) {
                    $value->attendance = $value->FilteredAttendance($value->employee_id, $request->from_date,$request->to_date);
                    $value->deduction = $value->FilteredAttendance($value->employee_id, $request->from_date,$request->to_date);
                    $value->cashAdvance = $value->FilteredAttendance($value->employee_id, $request->from_date,$request->to_date);
                }
            }
            else{
                $PayrollDetails = EmployeeDetail::with('UserDetail','attendance','CashAdvance','Taxes','Deduction')
                        ->get();
            }

            //Set all of the calculated and concatinated values
            foreach ($PayrollDetails as $key => $detail) {
                // Computation for total hours
                $detail->complete_hours = 0;
                foreach ($detail->attendance as $key => $attendance) {
                    $detail->complete_hours += $attendance->total_hours;
                    $detail->complete_hours = round($detail->complete_hours,2);
                }

                // Computation for total deduction
                $detail->total_deduction = 0;
                foreach ($detail->deduction as $key => $deduction) {
                    $detail->total_deduction += $deduction->deduction_amount;
                    $detail->total_deduction = round($detail->total_deduction,2);
                }

                // Computation for tatol cash advance amount
                $detail->total_cash_advance = 0;
                foreach($detail->cashAdvance as $key => $cash_advance){
                    $detail->total_cash_advance += $cash_advance->cashAdvance_amount;
                    $detail->total_cash_advance = round($detail->cashAdvance_amount,2);
                };

                //Full name of employee
                $detail->full_name = "{$detail->UserDetail->fname} {$detail->UserDetail->mname} {$detail->UserDetail->lname}";

                //Gross pay computation
                $detail->gross_pay = round($detail->complete_hours * $detail->rate,2);

                //Taxes deduction computation
                $detail->tax_deduction = round($detail->gross_pay * floatval(substr_replace($detail->taxes->tax_amount ,"", -1)) / 100,2);

                $detail->net_pay = round($detail->gross_pay - $detail->total_deduction - $detail->total_cash_advance - $detail->tax_deduction,2);
            }
            return $PayrollDetails;
        }
    }
}
