<?php

namespace App\Http\Controllers\Payroll;

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

class PayrollJSONController extends Controller
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

        //Set all of the calculated and concatinated values
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
                    $time = ($timeout - $timein) / 3600;

                    $detail->gross_pay += $rate * $time;
                    $detail->complete_hours += round($time,2);
                }else{
                    $time = ($stimeout - $stimein) / 3600;

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

            $detail->gross_pay += round($detail->gross_pay,2);
            //Full name of employee
            $detail->full_name = "{$detail->UserDetail->fname} {$detail->UserDetail->mname} {$detail->UserDetail->lname}";

            //Taxes deduction computation
            $detail->tax_deduction = round($detail->gross_pay * floatval(substr_replace($detail->taxes->tax_amount ,"", -1)) / 100,2);
            $detail->net_pay = round($detail->gross_pay - $detail->total_deduction - $detail->total_cash_advance - $detail->tax_deduction,2);
            $detail->prm_id = session('user_id');

            // SSS Contribution
            $detail->employer_contribution = 0;
            $detail->employee_contribution = 0;

            $start = 3000;
            $gross_pay = $detail->gross_pay;
            $er_add = 0;

            $sss_rate = Contributions::first();

            $ee_rate = $sss_rate->employee_contribution / 100;
            $er_rate = $sss_rate->employer_contribution / 100;

            // Check Additional for ER
            if($gross_pay < 15000){
                $er_add = 10;
            }
            else{
                $er_add = 30;
            }

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
        }
        return $PayrollDetails;
    }

    public function CashAdvance(Request $request){
        $cashAdvanceRecord = CashAdvance::join('employee_details', 'cash_advances.employee_id','=','employee_details.employee_id')
            ->join('user_details', 'employee_details.information_id','=', 'user_details.information_id')
            ->whereBetween('cash_advances.cash_advance_date',[$request->from_date,$request->to_date])
            ->get();

            return datatables()->of($cashAdvanceRecord)
                ->addColumn('delete',function($data){
                $button = ' <form action="/removeCashAdvance/'. $data->cashAdvances_id .'" method="GET">
                            <button type="submit" class="btn btn-outline-danger p-3 px-4"><i class="bi bi-trash"></i></button>
                            </form>';
                return $button;
                })
                ->rawColumns(['delete'])
                ->make(true);
    }

    public function EmployeeDetails(){
        $employeeDetails = EmployeeDetail::with('UserDetail')->get();
        return datatables()->of($employeeDetails)->make(true);
    }

    public function Deduction(Request $request){
        $deductions = Deduction::join('employee_details','employee_details.employee_id','=', 'deductions.employee_id')
            ->join('user_details','user_details.information_id','=','employee_details.information_id')
            ->whereBetween('deductions.deduction_start_date',[$request->from_date,$request->to_date])
            ->get();

        return datatables()->of($deductions)
            ->addColumn('delete',function($data){
                $button = ' <form action="/removeDeduction/'.$data->deduction_id.'" method="GET">
                            <button type="submit" class="btn btn-outline-danger p-3 px-4"><i class="bi bi-trash"></i></button>
                            </form>';
                return $button;
            })
            ->rawColumns(['delete'])
            ->make(true);
    }

    public function fetchSingleEmployee(Request $request){
        return $employeeDetails = EmployeeDetail::where('employee_id',$request->employee_id)->with('UserDetail')->first();
    }

    public function Overtime(Request $request){
        $paid_overtime = Overtime::all();
        $employee_schedules = EmployeeDetail::all();
        $employee_overtime_arr =[];
        $paid_overtime_arr =[];

        foreach ($employee_schedules as $key => $employee) {

                $stimeout = $this->timeCalculator($employee->schedule_Timeout);
                // Add 30 mins for minimum overtime
                $stimeout += $request->time_filter;

            $temp = Attendance::where('employee_id',$employee->employee_id)
                ->whereBetween('attendance_date',[$request->from_date,$request->to_date])
                ->whereBetween('time_in',['00:00:00',$employee->schedule_Timein])
                ->whereBetween('time_out',[date('H:i:s',$stimeout),'24:00:00'])
                ->get();

            foreach ($temp as $key => $value) {
                if(Overtime::where('attendance_id',$value->attendance_id)->first()){
                    array_push($paid_overtime_arr,$value);
                }else{
                    array_push($employee_overtime_arr,$value);
                }
            }
        }

        foreach ($employee_overtime_arr as $key => $employee) {
            $employee->user_details = EmployeeDetail::where('employee_id', $employee->employee_id)
                ->join('user_details','user_details.information_id','=','employee_details.information_id')
                ->first();

                $timeout = $this->timeCalculator($employee->time_out);
                $stimeout = $this->timeCalculator($employee->user_details->schedule_Timeout);

                $employee->total_overtime_hours = round(($timeout - $stimeout) / 3600,2);
        }

        return datatables()->of($employee_overtime_arr)->make(true);
    }

    public function getPaidOvertime(){
        $paid_overtime_arr = Overtime::join('attendances','attendances.attendance_id','=','overtimes.attendance_id')
            ->join('employee_details','employee_details.employee_id','=','overtimes.employee_id')
            ->join('user_details','user_details.information_id','=','employee_details.information_id')
            ->get();

        foreach ($paid_overtime_arr as $key => $employee) {
            $employee->user_details = EmployeeDetail::where('employee_id', $employee->employee_id)
                ->join('user_details','user_details.information_id','=','employee_details.information_id')
                ->first();

            $timeout = $this->timeCalculator($employee->time_out);
            $stimeout = $this->timeCalculator($employee->user_details->schedule_Timeout);

            $employee->total_overtime_hours = round(($timeout - $stimeout) / 3600,2);
        }
        return datatables()->of($paid_overtime_arr)->make(true);
    }

    public function Bonus(Request $request){
        $BonusRecords = Bonus::join('employee_details', 'bonuses.employee_id','=','employee_details.employee_id')
            ->join('user_details', 'employee_details.information_id','=', 'user_details.information_id')
            ->whereBetween('bonuses.bonus_date',[$request->from_date,$request->to_date])
            ->get();

        return datatables()->of($BonusRecords)
            ->addColumn('delete',function($data){
            $button = ' <form action="/removeDeleteBonus/'. $data->bonus_id .'" method="GET">
                        <button type="submit" class="btn btn-outline-danger p-3 px-4"><i class="bi bi-trash"></i></button>
                        </form>';
            return $button;
            })
            ->rawColumns(['delete'])
            ->make(true);
    }

    public function fetchAttedance(Request $request){
        $attendance = Attendance::join('employee_details','employee_details.employee_id','=','attendances.employee_id')
            ->join('user_details', 'employee_details.information_id','=', 'user_details.information_id')
            ->whereBetween('attendances.attendance_date',[$request->from_date,$request->to_date])
            ->get();

        $normal_pay_attendance = [];
        foreach ($attendance as $key => $value) {
            if(MultiPay::where('attendance_id',$value->attendance_id)->first()){
            }else{
                array_push($normal_pay_attendance,$value);
            }
        }

        foreach ($normal_pay_attendance as $key => $value) {
            $value->overtime = Overtime::where('attendance_id',$value->attendance_id)->first();

            $timein = $this->timeCalculator($value->time_in);
            $timeout = $this->timeCalculator($value->time_out);

            $stimein = $this->timeCalculator($value->schedule_Timein);
            $stimeout = $this->timeCalculator($value->schedule_Timeout);

            if($timeout < $stimeout){
                $value->under = 1;
            }

            if($timein > $stimein){
                $value->late = 1;
            }

            if($value->overtime){
                $value->total_hours = round(($timeout - $timein) / 3600,2);
            }else{
                $value->total_hours = round(($stimeout - $stimein) / 3600,2);
            }
        }

        return datatables()->of($normal_pay_attendance)->make(true);
    }

    public function DoublePay(Request $request){
        $multipay = MultiPay::join('employee_details','employee_details.employee_id','=','multi_pays.employee_id')
            ->join('attendances','attendances.attendance_id','=','multi_pays.attendance_id')
            ->join('user_details', 'employee_details.information_id','=', 'user_details.information_id')
            ->whereBetween('attendances.attendance_date',[$request->from_date,$request->to_date])
            ->get();

        foreach ($multipay as $key => $value) {
            $value->overtime = Overtime::where('attendance_id',$value->attendance_id)->first();

            $timein = $this->timeCalculator($value->time_in);
            $timeout = $this->timeCalculator($value->time_out);

            $stimein = $this->timeCalculator($value->schedule_Timein);
            $stimeout = $this->timeCalculator($value->schedule_Timeout);

            if($timeout < $stimeout){
                $value->under = 1;
            }

            if($timein > $stimein){
                $value->late = 1;
            }


            if($value->overtime){
                $value->total_hours = round(($timeout - $timein) / 3600,2);
                $value->total_compensation = round($value->rate * $value->total_hours * $value->status,2);
            }else{
                $value->total_hours = round(($stimeout - $stimein) / 3600,2);
                $value->total_compensation = round($value->rate * $value->total_hours * $value->status,2);
            }
        }

        return datatables()->of($multipay)
            ->addColumn('delete',function($data){
            $button = ' <form action="/removeMultiPay/'. $data->multi_pay_id .'" method="GET">
                        <button type="submit" class="btn btn-outline-danger p-3 px-4"><i class="bi bi-trash"></i></button>
                        </form>';
            return $button;
            })
            ->rawColumns(['delete'])
            ->make(true);;
    }

    public function contributions(Request $request){
        $employee_details = EmployeeDetail::join('user_details','user_details.information_id','=','employee_details.information_id')
            ->get();

        foreach ($employee_details as $key => $employee) {
            $employee->attendance = $employee->FilteredAttendance($employee->employee_id, $request->from_date,$request->to_date);
        }

        foreach ($employee_details as $key => $detail) {
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
                    $time = ($timeout - $timein) / 3600;

                    $detail->gross_pay += $rate * $time;
                    $detail->complete_hours += round($time,2);
                }else{
                    $time = ($stimeout - $stimein) / 3600;

                    $detail->gross_pay += $rate * $time;
                    $detail->complete_hours += round($time,2);
                }

                $detail->gross_pay = round($detail->gross_pay,2);

                $detail->complete_hours = round($detail->complete_hours,2);
            }

            // SSS Contribution
            $detail->employer_contribution = 0;
            $detail->employee_contribution = 0;

            $start = 3000;
            $gross_pay = $detail->gross_pay;
            $er_add = 0;

            $sss_rate = Contributions::first();

            $ee_rate = $sss_rate->employee_contribution / 100;
            $er_rate = $sss_rate->employer_contribution / 100;

            // Check Additional for ER
            if($gross_pay < 15000){
                $er_add = 10;
            }
            else{
                $er_add = 30;
            }

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
        }

        return datatables()->of($employee_details)->make(true);
    }

    public function Message(){

    }

    public function Notification(){

    }

    public function timeCalculator($time){
        list($hours, $minutes, $seconds) = explode(':',$time);
        return $hours * 3600 + $minutes * 60 + $seconds;
    }
}
