<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\employee_activity;
use App\Models\EmployeeDetail;
use App\Models\HealthCheck;
use App\Models\leave_approval;
use App\Models\overtime_approval;
use App\Models\Resigned;
use Illuminate\Http\Request;

class EmployeeInsertController extends Controller
{
    function TimeInInsert(Request $request){
        $employee = EmployeeDetail::where('login_id',session('user_id'))->first();
        Attendance::create([
            'employee_id'=> $employee->employee_id,
            'time_in'=> $request->time_in,
            'attendance_date'=> $request->time_in_date,
            'attendance_day' => date('w')
        ]);

        employee_activity::create([
            'employee_id' => $employee->employee_id,
            'description' => 'Time in',
            'activity_date' => date('Y-m-d h:i:s')
        ]);

        return back()->with([
            'insert'=>'You have successfully Timed in',
        ]);
    }

    function insertHealthCheck(Request $request){
        $score = 0;
        for ($i=0; $i < 7; $i++) {
            $score += $request['choice_'.$i];
        }
        if($temp = round(($score-1 + $request->health_check_option ) / 2)){
            $score = $temp;
        }
        else{
            $score = 0;
        }

        if($score < 0){
            $score = 0;
        }

        $employee = EmployeeDetail::with('UserDetail')->where('login_id',session('user_id'))->first();
        HealthCheck::create([
            'employee_id' => $employee->employee_id,
            'score' => $score,
            'attendance_id' => $request->attendance_id
        ]);

        employee_activity::create([
            'employee_id' => $employee->employee_id,
            'description' => 'Answered health check form',
            'activity_date' => date('Y-m-d h:i:s')
        ]);

        return back()->with([
            'insert'=>'You have successfully Timed in'
        ]);
    }

    function TimeOutInsert(Request $request){
        Attendance::where('attendance_id',$request->att_id)
            ->update([
                'time_out'=>$request->time_out
            ]);

        $employee = EmployeeDetail::where('login_id',session('user_id'))->first();
        employee_activity::create([
            'employee_id' => $employee->employee_id,
            'description' => 'Time out',
            'activity_date' => date('Y-m-d h:i:s')
        ]);

        return back()->with(['insert'=>'You have successfully Timed Out']);
    }

    function overtimeApplicationInsert(Request $request){
        $request->validate([
            'attendance_id' => 'required',
            'message' => 'required',
        ]);

        $employee = EmployeeDetail::where('login_id',session('user_id'))->first();
        overtime_approval::create([
            'employee_id' => $employee->employee_id,
            'attendance_id' => $request->attendance_id,
            'overtime_date' => $request->attendance_date,
            'message' => $request->message,
        ]);

        employee_activity::create([
            'employee_id' => $employee->employee_id,
            'description' => 'Sent an application for overtime for attendance #'.$request->attendance_id,
            'activity_date' => date('Y-m-d h:i:s')
        ]);


        return back()->with(['insert'=>'Your Application for overtime on '. $request->attendance_date .' has been submitted']);
    }

    function insertEmployeeLeave(Request $request){
        $request->validate([
            'employee_id' => 'required',
            'from_date' => 'required',
            'to_date' => 'required',
            'title' => 'required',
            'detail' => 'required',
        ]);

        leave_approval::create([
            'employee_id' => $request->employee_id,
            'start_date' => $request->from_date,
            'end_date' => $request->to_date,
            'title' => $request->title,
            'detail' => $request->detail,
        ]);

        $employee = EmployeeDetail::where('login_id',session('user_id'))->first();
        employee_activity::create([
            'employee_id' => $employee->employee_id,
            'description' => 'Sent an application for leave for ' . $request->from_date . ' to ' . $request->to_date,
            'activity_date' => date('Y-m-d h:i:s')
        ]);

        return back()->with(['insert'=>'Your Application for leave on '.  $request->from_date .' to ' . $request->to_date .' has been submitted']);
    }

    function insertEmployeeResignation(Request $request){
        $filename =  session('user_id').".".$request->file('resign')->getClientOriginalExtension();
        $request->file('resign')->storeAs('resignation', $filename,'public_uploads');
        $employee = EmployeeDetail::where('login_id',session('user_id'))->first();

        Resigned::create([
            'employee_id' => $employee->employee_id,
            'resignation_path' => 'resignation/' . $filename
        ]);

        employee_activity::create([
            'employee_id' => $employee->employee_id,
            'description' => 'Sent an application for resignation',
            'activity_date' => date('Y-m-d h:i:s')
        ]);

        return back()->with(['insert'=>'Your Application for Resignation has been submitted on '. date('Y-m-d')]);
    }
}
