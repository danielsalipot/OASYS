<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Department;
use App\Models\EmployeeDetail;
use App\Models\HealthCheck;
use App\Models\Position;
use Illuminate\Http\Request;

class AttendanceGraphJSON extends Controller
{
    function getFilteredAttendanceGraph($i = 0,$from_date,$to_date){
        $total_attendance = 0;
        $total_ontime = 0;
        $total_absent = 0;
        $total_late = 0;

        $departments = Department::groupBy('department_name')->orderBy('department_name')->get('department_name');
        foreach ($departments as $key => $dept) {
            $dept->ontime = 0;
            $dept->absent = 0;
            $dept->late = 0;
        }

        $positions = Position::groupBy('position_title')->orderBy('position_title')->get('position_title');
        foreach ($positions as $key => $pos) {
            $pos->ontime = 0;
            $pos->absent = 0;
            $pos->late = 0;
        }


        $health_check_all = [[],[],[],[],[],[],[],[]];
        $all_time_attendance = Attendance::groupBy('attendance_date')
            ->whereBetween('attendance_date',[$from_date,$to_date])
            ->orderBy('attendance_date',"ASC")
            ->get('attendance_date');

        $employees = EmployeeDetail::all();

        foreach ($all_time_attendance as $key => $date) {
            $date->on_time_count = 0;
            $date->late_count = 0;
            $date->absent = 0;

            array_push($health_check_all[0],$date->attendance_date);
            array_push($health_check_all[1],0);
            array_push($health_check_all[2],0);
            array_push($health_check_all[3],0);
            array_push($health_check_all[4],0);
            array_push($health_check_all[5],0);
            array_push($health_check_all[6],0);
            array_push($health_check_all[7],0);

            foreach ($employees as $key => $employee) {
                $attendance = Attendance::where('employee_id',$employee->employee_id)
                    ->where('attendance_date',$date->attendance_date)
                    ->first();

                if(isset($attendance)){
                    $health_score = HealthCheck::where('attendance_id',$attendance->attendance_id)->first('score')->score;
                    $health_check_all[$health_score + 1][count($health_check_all[$health_score + 1]) -1 ] += 1;

                    $total_attendance += 1;
                    if($this->timeCalculator($employee->schedule_Timein) >= $this->timeCalculator($attendance->time_in) && $this->timeCalculator($employee->schedule_Timeout) <= $this->timeCalculator($attendance->time_out)){
                        $total_ontime += 1;
                        $date->on_time_count += 1;

                        foreach ($departments as $key => $dept) {
                            if($dept->department_name == $employee->department){
                                $dept->ontime += 1;
                            }
                        }
                        foreach ($positions as $key => $pos) {
                            if($pos->position_title == $employee->position){
                                $pos->ontime += 1;
                            }
                        }
                    }else{
                        $total_late += 1;
                        $date->late_count += 1;

                        foreach ($departments as $key => $dept) {
                            if($dept->department_name == $employee->department){
                                $dept->late += 1;
                            }
                        }
                        foreach ($positions as $key => $pos) {
                            if($pos->position_title == $employee->position){
                                $pos->late += 1;
                            }
                        }
                    }
                }else{
                    if(in_array(date('w',strtotime($date->attendance_date)),json_decode($employee->schedule_days))){
                        $total_absent += 1;
                        $date->absent += 1;

                        foreach ($departments as $key => $dept) {
                            if($dept->department_name == $employee->department){
                                $dept->absent += 1;
                            }
                        }

                        foreach ($positions as $key => $pos) {
                            if($pos->position_title == $employee->position){
                                $pos->absent += 1;
                            }
                        }
                    }
                }
            }
        }

        if($i == 1){
            return [$total_attendance, $total_ontime, $total_absent, $total_late];
        }
        if($i == 2){
            return $departments;
        }
        if($i == 3){
            return $positions;
        }
        if($i == 4){
            return $health_check_all;
        }


        return $all_time_attendance;
    }

    public function timeCalculator($time){
        list($hours, $minutes, $seconds) = explode(':',$time);
        return $hours * 3600 + $minutes * 60 + $seconds;
    }
}
