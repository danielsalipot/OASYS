<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
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
        ]);

        return back()->with([
            'insert'=>'You have successfully Timed in',
        ]);
    }

    function insertHealthCheck(Request $request){
        $employee = EmployeeDetail::with('UserDetail')->where('login_id',session('user_id'))->first();
        HealthCheck::create([
            'employee_id' => $employee->employee_id,
            'score' => $request->score,
            'attendance_id' => $request->attendance_id
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

        return back()->with(['insert'=>'You have successfully Timed Out']);
    }

    function overtimeApplicationInsert(Request $request){
        $employee = EmployeeDetail::where('login_id',session('user_id'))->first();
        overtime_approval::create([
            'employee_id' => $employee->employee_id,
            'attendance_id' => $request->attendance_id,
            'overtime_date' => $request->attendance_date,
            'message' => $request->message,
        ]);

        return back()->with(['insert'=>'Your Application for overtime on '. $request->attendance_date .' has been submitted']);
    }

    function insertEmployeeLeave(Request $request){
        return $request;
        leave_approval::create([
            'employee_id' => $request->employee_id,
            'start_date' => $request->from_date,
            'end_date' => $request->to_date,
            'title' => $request->title,
            'detail' => $request->detail,
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

        return back()->with(['insert'=>'Your Application for Resignation has been submitted on '. date('Y-m-d')]);
    }
}
