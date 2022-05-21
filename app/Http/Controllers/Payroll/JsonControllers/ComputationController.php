<?php

namespace App\Http\Controllers\Payroll\JsonControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\EmployeeDetail;
use App\Models\UserDetail;
use App\Models\CashAdvance;
use App\Models\Attendance;
use App\Models\Deduction;
use App\Models\MultiPay;
use App\Models\Overtime;
use App\Models\Bonus;
use App\Models\Contributions;
use App\Models\philhealth;
use App\Models\Pagibig;

class ComputationController extends Controller
{
    //FILTERED THE DATES OF ATTENDANCE, cash advance, and deductions
    function payroll(Request $request){
        $PayrollDetails = EmployeeDetail::with('UserDetail','Taxes')->get();

        //FETCH ALL RECORDS OF:
        foreach ($PayrollDetails as $key => $value) {
            $value->attendance = $value->FilteredAttendance($value->employee_id, $request->from_date,$request->to_date);
            $value->deduction = $value->FilteredDeductions($value->employee_id, $request->from_date,$request->to_date);
            $value->cashAdvance = $value->FilteredCashAdvance($value->employee_id, $request->from_date,$request->to_date);
            $value->bonus = $value->FilteredBonus($value->employee_id, $request->from_date,$request->to_date);
        }





/*=============================================================================
|                                 START
|            COMPUTATION OF HOURS, BONUS, DEDUCTION, CASH ADVANCE
|                                 Result:
|                     complete_hours | total_deduction
|                 total_cash_advance | total_bonus
|                          gross_pay |
*==============================================================================*/

    foreach ($PayrollDetails as $key => $detail) {
        // Computation for total hours
        $detail->complete_hours = 0;
        //Gross pay computation
        $detail->gross_pay = 0;

        //Computes total time and gross pay with overtime and multipay
        foreach ($detail->attendance as $key => $attendance) {
            $overtime = Overtime::where('attendance_id',$attendance->attendance_id)->first();
            $sched = EmployeeDetail::where('employee_id',$attendance->employee_id)->first();
            $multipay = MultiPay::where('attendance_id',$attendance->attendance_id)->first();

            $timein = $this->timeCalculator($attendance->time_in);
            $timeout = $this->timeCalculator($attendance->time_out);

            $stimein = $this->timeCalculator($sched->schedule_Timein);
            $stimeout = $this->timeCalculator($sched->schedule_Timeout);
            $rate = $sched->rate;

            if($multipay){
                $rate = $rate * $multipay->status;
            }

            if($overtime){
                $time = ($timeout - $stimein) / 3600;


                $detail->gross_pay += $rate * $time;
                $detail->complete_hours += round($time,2);
            }else{

                $time = ($stimeout - $stimein) / 3600;

                if($timeout < $stimeout || $timein > $stimein){
                    $time =  round(($timeout - $stimein) / 3600);
                }

                $detail->gross_pay += $rate * $time;
                $detail->complete_hours += round($time,2);
            }
            $detail->gross_pay = round($detail->gross_pay,2);
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
                $detail->total_cash_advance = round($detail->total_cash_advance,2);
            };

            $detail->total_bonus = 0;
            foreach($detail->bonus as $key => $bonus){
                $detail->total_bonus += $bonus->bonus_amount;
                $detail->total_bonus = round($detail->total_bonus,2);
            };

            $detail->gross_pay = round($detail->gross_pay + $detail->total_bonus,2);

/*=============================================================================
|                                   END
*==============================================================================*/




/*=============================================================================
|                                   START
|                       Pag-ibig CONTRIBUTION COMPUTATION
|                                  Results:
|       employee_pagibig_contribution | employer_pagibig_contribution
|
*==============================================================================*/
$pagibig = Pagibig::first();

        $detail->employee_pagibig_contribution = 0;
        $detail->employer_pagibig_contribution = 0;

        if($detail->gross_pay < $pagibig->divider){
            $detail->employee_pagibig_contribution = $detail->gross_pay * ($pagibig->ee_min_rate / 100);
            $detail->employer_pagibig_contribution = $detail->gross_pay * ($pagibig->er_rate / 100);
        }
        if($detail->gross_pay > $pagibig->divider){
            if($detail->gross_pay * ($pagibig->ee_max_rate / 100) > $pagibig->maximum){
                $detail->employee_pagibig_contribution = $pagibig->maximum;
                $detail->employer_pagibig_contribution = $pagibig->maximum;
            }else{
                $detail->employee_pagibig_contribution = $detail->gross_pay * ($pagibig->ee_max_rate / 100);
                $detail->employer_pagibig_contribution = $detail->gross_pay * ($pagibig->er_rate / 100);

                if($detail->employer_pagibig_contribution > $pagibig->maximum){
                    $temp = $detail->employer_pagibig_contribution - $pagibig->maximum;
                    $detail->employer_pagibig_contribution -= $temp;
                    $detail->employee_pagibig_contribution += $temp;
                }

                if($detail->employee_pagibig_contribution > $pagibig->maximum){
                    $temp = $detail->employee_pagibig_contribution -= $pagibig->maximum;
                    $detail->employee_pagibig_contribution -= $temp;
                    $detail->employer_pagibig_contribution += $temp;
                }
            }
        }

        $detail->employee_pagibig_contribution = round($detail->employee_pagibig_contribution,2);
        $detail->employer_pagibig_contribution = round($detail->employer_pagibig_contribution,2);
        $detail->total_pagibig_contribution = round($detail->employee_pagibig_contribution + $detail->employer_pagibig_contribution,2);
/*=============================================================================
|                                   END
*==============================================================================*/




/*=============================================================================
|                                   START
|                       Philhealth CONTRIBUTION COMPUTATION
|                                  Results:
|     employer_philhealth_contribution | employee_philhealth_contribution
|
*==============================================================================*/

$philhealth = philhealth::first();

    $detail->employer_philhealth_contribution = 0;
    $detail->employee_philhealth_contribution = 0;

    if($detail->gross_pay < $philhealth->minimum){
        $detail->employer_philhealth_contribution +=  $philhealth->minimum * ($philhealth->er_min_rate / 100);
        $detail->employee_philhealth_contribution +=  $philhealth->minimum * ($philhealth->er_rate / 100);
    }
    elseif($detail->gross_pay > $philhealth->maximum){
        $total_philhealth_payment = $philhealth->ph_cap;
        $detail->employer_philhealth_contribution = $total_philhealth_payment * ($philhealth->er_max_rate / 100);
        $detail->employee_philhealth_contribution = $total_philhealth_payment * ($philhealth->ee_rate / 100);
    }else{
        $total_philhealth_payment = $detail->gross_pay * ($philhealth->ph_rate/100);
        $detail->employer_philhealth_contribution = $total_philhealth_payment * ($philhealth->er_rate / 100);
        $detail->employee_philhealth_contribution = $total_philhealth_payment * ($philhealth->ee_rate / 100);
    }

    $detail->employer_philhealth_contribution = round($detail->employer_philhealth_contribution,2);
    $detail->employee_philhealth_contribution = round($detail->employee_philhealth_contribution,2);

    $detail->total_philhealth_contribution = round($detail->employer_philhealth_contribution + $detail->employee_philhealth_contribution,2);

/*=============================================================================
|                                   END
*==============================================================================*/





/*=============================================================================
|                                   START
|                       SSS CONTRIBUTION COMPUTATION
|                                  Results:
|               employer_contribution | employee_contribution
|                           total_sss |
*==============================================================================*/

            $detail->employer_contribution = 0;
            $detail->employee_contribution = 0;

            $start = 3000;
            $gross_pay = $detail->gross_pay;
            $er_add = 0;

            $sss_rate = Contributions::first();

            $ee_rate = $sss_rate->employee_contribution / 100;
            $er_rate = $sss_rate->employer_contribution / 100;

            // Check Additional for ER
            if($gross_pay < 15000){$er_add = $sss_rate->add_low;}
            else{$er_add = $sss_rate->add_high;}

            while(1){
                if($gross_pay == 0){
                    $start = 0;
                    $er_add = 0;
                    break;
                }
                if($gross_pay < 3001){
                    break;
                }
                $start += 500;
                if($gross_pay >= $start - 250  && $gross_pay <= $start + 249){
                    break;
                }
                if($gross_pay >= 25000){
                    $start = 25000;
                    break;
                }
            }


            $detail->employer_contribution = round(($start * $er_rate + $er_add),1);
            $detail->employee_contribution = round($start * $ee_rate,1);
            $detail->total_sss = $detail->employer_contribution + $detail->employee_contribution;

/*=============================================================================
|                                   END
*==============================================================================*/




/*=============================================================================
|                                   START
|                         WITHOLDING TAX COMPUTATION
|                                  Results:
|                      witholding_tax | taxable_net
*==============================================================================*/

            $detail->taxable_net = round($detail->gross_pay - $detail->total_deduction -  $detail->employee_contribution - $detail->total_cash_advance - $detail->employer_philhealth_contribution - $detail->employer_pagibig_contribution,2);

            $detail->witholding_tax = 0;

            if($detail->taxable_net > 10417 && $detail->taxable_net < 16666){
                $detail->witholding_tax += ($detail->taxable_net - 10417) * 0.2;
            }
            if($detail->taxable_net > 16667 && $detail->taxable_net < 33332){
                $detail->witholding_tax += 1250 + (($detail->taxable_net - 16667) * 0.25);
            }
            if($detail->taxable_net > 33333 && $detail->taxable_net < 83332){
                $detail->witholding_tax += 5416.67 + (($detail->taxable_net - 33333) * 0.3);
            }
            if($detail->taxable_net > 83333 && $detail->taxable_net < 333332){
                $detail->witholding_tax += 20416.67 + (($detail->taxable_net - 83333) * 0.32);
            }
            if($detail->taxable_net > 333333){
                $detail->witholding_tax += 100416.67 + (($detail->taxable_net - 333333) * 0.35);
            }

            $detail->witholding_tax = round($detail->witholding_tax,2);

/*=============================================================================
|                                   END
*==============================================================================*/





            $detail->net_pay = round($detail->taxable_net - $detail->witholding_tax,2);
            $detail->gross_pay = round($detail->gross_pay,2);

            //Full name of employee
            $detail->prm_id = session('user_id');
            $detail->full_name = "{$detail->UserDetail->fname} {$detail->UserDetail->mname} {$detail->UserDetail->lname}";
        }



        return datatables()->of($PayrollDetails)->make(true);
    }


    public function timeCalculator($time){
        list($hours, $minutes, $seconds) = explode(':',$time);
        return $hours * 3600 + $minutes * 60 + $seconds;
    }
}
