<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\EmployeeDetail;

class JsonController extends Controller
{
    function Payroll(){
        $PayrollDetails = EmployeeDetail::with('UserDetail','attendance','CashAdvance','Taxes','Deduction')
                        ->get();
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
            }

            // Computation for tatol cash advance amount
            $detail->total_cash_advance = 0;
            foreach($detail->cashAdvance as $key => $cash_advance){
                $detail->total_cash_advance += $cash_advance->cashAdvance_amount;
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
    
    public function CashAdvance(){

    }

    public function Deduction(){

    }

    public function DeductionType(){

    }

    public function EmployeeList(){

    }
    
    public function Message(){

    }

    public function Notification(){

    }

    public function Overtime(){
        
    }
}
