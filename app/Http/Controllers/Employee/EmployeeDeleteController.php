<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\leave_approval;
use App\Models\overtime_approval;
use App\Models\Resigned;
use Illuminate\Http\Request;

class EmployeeDeleteController extends Controller
{
    function deleteOvertimeApplication(Request $request){
        overtime_approval::find($request->id)->delete();

        return back()->with(['delete'=>'Overtime appplication has been removed']);
    }

    function deleteEmployeeLeave(Request $request){
        leave_approval::find($request->id)->delete();

        return back()->with(['delete'=>'Leave appplication has been removed']);
    }

    function deleteEmployeeResignation(Request $request){
        Resigned::find($request->resignation_id)->delete();

        return back()->with(['delete'=>'Resignation appplication has been removed']);
    }
}
