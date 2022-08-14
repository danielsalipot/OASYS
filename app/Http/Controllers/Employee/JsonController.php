<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Assessment;
use App\Models\Attendance;
use App\Models\EmployeeDetail;
use App\Models\Overtime;
use App\Models\overtime_approval;
use DateTime;
use Illuminate\Http\Request;

class JsonController extends Controller
{
    public function overtimeJsonEmployee(Request $request){
        $employee_schedules = EmployeeDetail::where('employee_id',1)->get();
        $employee_overtime_arr =[];
        $paid_overtime_arr =[];

        foreach ($employee_schedules as $key => $employee) {

                $stimeout = $this->timeCalculator($employee->schedule_Timeout);
                // Add 30 mins for minimum overtime
                $stimeout += $request->time_filter;

            $temp = Attendance::where('employee_id',$employee->employee_id)
                ->whereBetween('attendance_date',[$request->from_date,new DateTime($request->to_date ." ". "23:59")])
                ->whereBetween('time_in',['00:00:00',$employee->schedule_Timein])
                ->whereBetween('time_out',[date('H:i:s',$stimeout),'24:00:00'])
                ->get();

            foreach ($temp as $key => $value) {
                if(Overtime::where('attendance_id',$value->attendance_id)->first()){
                    array_push($paid_overtime_arr,$value);
                }else{
                    array_push($employee_overtime_arr,$value);
                }

                if(overtime_approval::where('attendance_id',$value->attendance_id)->first()){
                    $value->applied = 1;
                }else{
                    $value->applied = 0;
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

    public function timeCalculator($time){
        list($hours, $minutes, $seconds) = explode(':',$time);
        return $hours * 3600 + $minutes * 60 + $seconds;
    }
}
