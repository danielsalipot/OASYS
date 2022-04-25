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

            //Full name of employee
            // $detail->full_name = "{$detail->UserDetail->fname} {$detail->UserDetail->mname} {$detail->UserDetail->lname}";

            // $start = 3000;
            // while(1){
            //     if($detail->gross_pay <= 3000){
            //         return;
            //     }
            //     if($detail->gross_pay >= $start-250 && $detail->gross_pay <= $start+249){
            //         return;
            //     }
            //     $start += 500;
            // }

            //Taxes deduction computation
            $detail->tax_deduction = round($detail->gross_pay * floatval(substr_replace($detail->taxes->tax_amount ,"", -1)) / 100,2);
            $detail->net_pay = round($detail->gross_pay - $detail->total_deduction - $detail->total_cash_advance - $detail->tax_deduction,2);
            $detail->prm_id = session('user_id');
        }
        return $PayrollDetails;
    }

    public function CashAdvance(Request $request){
        return $cashAdvanceRecord = CashAdvance::join('employee_details', 'cash_advances.employee_id','=','employee_details.employee_id')
            ->join('user_details', 'employee_details.information_id','=', 'user_details.information_id')
            ->whereBetween('cash_advances.cash_advance_date',[$request->from_date,$request->to_date])
            ->get();
    }

    public function EmployeeDetails(){
        return EmployeeDetail::with('UserDetail')->get();
    }

    public function Deduction(Request $request){
        return Deduction::join('employee_details','employee_details.employee_id','=', 'deductions.employee_id')
            ->join('user_details','user_details.information_id','=','employee_details.information_id')
            ->whereBetween('deductions.deduction_start_date',[$request->from_date,$request->to_date])
            ->get();
    }

    public function EmployeeList(){
        return $employeeDetails = EmployeeDetail::with('UserDetail')->get();
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

        return $employee_overtime_arr;
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
        return $paid_overtime_arr;
    }

    public function Bonus(Request $request){
        return $BonusRecords = Bonus::join('employee_details', 'bonuses.employee_id','=','employee_details.employee_id')
            ->join('user_details', 'employee_details.information_id','=', 'user_details.information_id')
            ->whereBetween('bonuses.bonus_date',[$request->from_date,$request->to_date])
            ->get();
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

        return $normal_pay_attendance;
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

        return $multipay;
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
