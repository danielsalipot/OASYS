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
        $paid_overtime = Overtime::all();
        $employee_schedules = EmployeeDetail::all();
        $employee_overtime_arr =[];
        $paid_overtime_arr =[];

        foreach ($employee_schedules as $key => $employee) {
            list($stimeout_hours, $stimeout_minutes, $stimeout_seconds) = explode(':',$employee->schedule_Timeout);
                $stimeout = $stimeout_hours * 3600 + $stimeout_minutes * 60 + $stimeout_seconds;
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
                                    ->join('user_details','user_details.information_id','=','employee_details.information_id')->first();

                list($timeout_hours, $timeout_minutes, $timeout_seconds) = explode(':',$employee->time_out);
                $timeout = $timeout_hours * 3600 + $timeout_minutes * 60 + $timeout_seconds;

                list($stimeout_hours, $stimeout_minutes, $stimeout_seconds) = explode(':',$employee->user_details->schedule_Timeout);
                $stimeout = $stimeout_hours * 3600 + $stimeout_minutes * 60 + $stimeout_seconds;

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
                                            ->join('user_details','user_details.information_id','=','employee_details.information_id')->first();

            list($timeout_hours, $timeout_minutes, $timeout_seconds) = explode(':',$employee->time_out);
            $timeout = $timeout_hours * 3600 + $timeout_minutes * 60 + $timeout_seconds;

            list($stimeout_hours, $stimeout_minutes, $stimeout_seconds) = explode(':',$employee->user_details->schedule_Timeout);
            $stimeout = $stimeout_hours * 3600 + $stimeout_minutes * 60 + $stimeout_seconds;

            $employee->total_overtime_hours = round(($timeout - $stimeout) / 3600,2);
        }
        return $paid_overtime_arr;
    }

    public function InsertOvertime(Request $request){
        Overtime::create([
            'employee_id' => $request->emp_id,
            'attendance_id' => $request->attendance_id
        ]);

        return redirect('/overtime');
    }

    public function DoublePay(){

    }

    public function Bonus(){

    }
}
