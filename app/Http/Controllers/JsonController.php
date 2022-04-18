<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\EmployeeDetail;
use App\Models\UserDetail;
use App\Models\Attendance;
use App\Models\Deduction;
use App\Models\Overtime;

class JsonController extends Controller
{

    function Payroll1(){
        $PayrollDetails = EmployeeDetail::with('UserDetail','Taxes')->get();
        foreach ($PayrollDetails as $key => $value) {
            $value->attendance = $value->FilteredAttendance($value->employee_id,'1000-1-1','2022-1-1');
            $value->deduction = $value->FilteredDeductions($value->employee_id,'1000-1-1','2022-1-1');
            $value->cashAdvance = $value->FilteredCashAdvance($value->employee_id,'1000-1-1','2022-1-1');
        }

        foreach ($PayrollDetails as $key => $value) {
            foreach ($value->CashAdvance as $key => $el) {
                echo $el;
                echo '<br><br>';
            }
        }
    }

    //FILTERED THE DATES OF ATTENDANCE, cash advance, and deductions
    function payroll(Request $request){
        if(request()->ajax()){
            if(!empty($request->from_date)){
            $PayrollDetails = EmployeeDetail::with('UserDetail','Taxes')->get();
                foreach ($PayrollDetails as $key => $value) {
                    $value->attendance = $value->FilteredAttendance($value->employee_id, $request->from_date,$request->to_date);
                    $value->deduction = $value->FilteredDeductions($value->employee_id, $request->from_date,$request->to_date);
                    $value->cashAdvance = $value->FilteredCashAdvance($value->employee_id, $request->from_date,$request->to_date);
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
                    $detail->total_cash_advance = round($detail->total_cash_advance,2);
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

    function payslip(Request $request){
        $PayrollDetails = EmployeeDetail::with('UserDetail','Taxes')->get();
        foreach ($PayrollDetails as $key => $value) {
            $value->attendance = $value->FilteredAttendance($value->employee_id, $request->from_date,$request->to_date);
            $value->deduction = $value->FilteredDeductions($value->employee_id, $request->from_date,$request->to_date);
            $value->cashAdvance = $value->FilteredCashAdvance($value->employee_id, $request->from_date,$request->to_date);
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
                $detail->total_cash_advance = round($detail->total_cash_advance,2);
            };

            //Full name of employee
            $detail->full_name = "{$detail->UserDetail->fname} {$detail->UserDetail->mname} {$detail->UserDetail->lname}";

            //Gross pay computation
            $detail->gross_pay = round($detail->complete_hours * $detail->rate,2);

            //Taxes deduction computation
            $detail->tax_deduction = round($detail->gross_pay * floatval(substr_replace($detail->taxes->tax_amount ,"", -1)) / 100,2);

            $detail->net_pay = round($detail->gross_pay - $detail->total_deduction - $detail->total_cash_advance - $detail->tax_deduction,2);
            $detail->prm_id = session('user_id');
        }
        return $PayrollDetails;
    }

    public function CashAdvance(){
        return $cashAdvanceRecord = CashAdvance::join('employee_details', 'cash_advances.employee_id','=','employee_details.employee_id')
                                            ->join('user_details', 'employee_details.information_id','=', 'user_details.information_id')
                                            ->get();
    }

    public function Deduction(){
        return Deduction::join('employee_details','employee_details.employee_id','=', 'deductions.employee_id')
                        ->join('user_details','user_details.information_id','=','employee_details.information_id')
                        ->get();
    }

    public function DeductionType(){

    }

    public function EmployeeList(){
        return $employeeDetails = EmployeeDetail::with('UserDetail')->get();
    }

    public function fetchSingleEmployee(Request $request){
        return $employeeDetails = EmployeeDetail::where('employee_id',$request->employee_id)->with('UserDetail')->first();
    }

    public function Message(){

    }

    public function Notification(){

    }

    public function Overtime(Request $request){
        $employee_schedules = EmployeeDetail::all();
        $employee_overtime =[];
        foreach ($employee_schedules as $key => $employee) {
            list($stimeout_hours, $stimeout_minutes, $stimeout_seconds) = explode(':',$employee->schedule_Timeout);
                $stimeout = $stimeout_hours * 3600 + $stimeout_minutes * 60 + $stimeout_seconds;
                // Add 30 mins for minimum overtime
                $stimeout += 1800;

            array_push($employee_overtime,Attendance::where('employee_id',$employee->employee_id)
                                        ->whereBetween('attendance_date',[$request->from_date,$request->to_date])
                                        ->whereBetween('time_in',['00:00:00',$employee->schedule_Timein])
                                        ->whereBetween('time_out',[date('H:i:s',$stimeout),'24:00:00'])
                                        ->get());
        }

        foreach ($employee_overtime as $key => $employee) {
            foreach ($employee as $key => $value) {
                $value->user_details = EmployeeDetail::where('employee_id', $value->employee_id)
                                        ->join('user_details','user_details.information_id','=','employee_details.information_id')->first();

                list($timeout_hours, $timeout_minutes, $timeout_seconds) = explode(':',$value->time_out);
                $timeout = $timeout_hours * 3600 + $timeout_minutes * 60 + $timeout_seconds;

                list($stimeout_hours, $stimeout_minutes, $stimeout_seconds) = explode(':',$value->user_details->schedule_Timeout);
                $stimeout = $stimeout_hours * 3600 + $stimeout_minutes * 60 + $stimeout_seconds;

                $value->total_overtime_hours = round(($timeout - $stimeout) / 3600,2);
            }
        }

        $output_arr = [];
        foreach ($employee_overtime as $key => $employee) {
            foreach($employee as $key => $value){
                array_push($output_arr,$value);
            }
        }

        return $output_arr;
    }
}
