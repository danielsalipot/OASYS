<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;

class EmployeeInsertController extends Controller
{
    function TimeInInsert(Request $request){
        Attendance::create([
            'employee_id'=> Session('user_id'),
            'time_in'=> $request->time_in,
            'attendance_date'=> $request->time_in_date,
        ]);

        return back()->with(['insert'=>'You have successfully Timed in']);
    }

    function TimeOutInsert(Request $request){
        Attendance::where('attendance_id',$request->att_id)
            ->update([
                'time_out'=>$request->time_out
            ]);

            return back()->with(['insert'=>'You have successfully Timed Out']);
    }
}
