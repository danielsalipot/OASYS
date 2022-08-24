<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\employee_activity;
use App\Models\EmployeeDetail;
use App\Models\leave_approval;
use App\Models\overtime_approval;
use App\Models\Resigned;
use Illuminate\Http\Request;

class EmployeeDeleteController extends Controller
{
    function deleteOvertimeApplication(Request $request){
        $application = overtime_approval::find($request->id)->first();

        $employee = EmployeeDetail::where('login_id',session('user_id'))->first();
        employee_activity::create([
            'employee_id' => $employee->employee_id,
            'description' => 'Removed overtime application for attendance ' . $application->attendance_id ,
            'activity_date' => date('Y-m-d h:i:s')
        ]);

        overtime_approval::find($request->id)->delete();
        return back()->with(['delete'=>'Overtime appplication has been removed']);

    }

    function deleteEmployeeLeave(Request $request){
        $application = leave_approval::find($request->id)->first();

        $employee = EmployeeDetail::where('login_id',session('user_id'))->first();
        employee_activity::create([
            'employee_id' => $employee->employee_id,
            'description' => 'Removed leave application on ' . $application->start_date . ' to ' . $application->end_date,
            'activity_date' => date('Y-m-d h:i:s')
        ]);

        leave_approval::find($request->id)->delete();
        return back()->with(['delete'=>'Leave appplication has been removed']);
    }

    function deleteEmployeeResignation(Request $request){
        $application = Resigned::find($request->resignation_id)->first();

        $employee = EmployeeDetail::where('login_id',session('user_id'))->first();
        employee_activity::create([
            'employee_id' => $employee->employee_id,
            'description' => 'Removed resignation application on ' . $application->created_at,
            'activity_date' => date('Y-m-d h:i:s')
        ]);

        unlink($application->resignation_path);
        Resigned::find($request->resignation_id)->delete();
        return back()->with(['delete'=>'Resignation appplication has been removed']);
    }
}
