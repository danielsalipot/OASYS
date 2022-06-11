<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\notification_acknowledgements;
use App\Models\notification_receiver;
use App\Models\Payslips;
use App\Models\UserCredential;
use App\Models\UserDetail;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    //Employee Functions
    function employeehome(){
        $attendance = Attendance::join('employee_details','employee_details.employee_id','=','attendances.employee_id')
            ->join('user_details','user_details.information_id','=','employee_details.information_id')
            ->where('attendance_date',date('Y-m-d'))
            ->first();

        $attendance_history = Attendance::join('employee_details','employee_details.employee_id','=','attendances.employee_id')
            ->join('user_details','user_details.information_id','=','employee_details.information_id')
            ->where('attendances.employee_id',Session('user_id'))
            ->orderBy('attendance_date','desc')
            ->paginate(10);

        $notif = notification_receiver::with('message')
            ->where('receiver_id',session('user_id'))
            ->orderBy('created_at','desc')
            ->paginate(10);

        foreach ($notif as $key => $value) {
            $value->sender = UserDetail::where('login_id',$value->message->sender_id)->first();
        }

        foreach ($notif as $key => $value) {
            $value->acknowledgements = notification_acknowledgements::where('notification_receiver_id',$value->id)->count();
        }

        $payslips = Payslips::where('employee_id',session('user_id'))->get();
        return view('pages.employee.employeehome')->with([
            'attendance' => $attendance,
            'attendance_history' => $attendance_history,
            'payslips' => $payslips,
            'notif'=>$notif,
        ]);
    }

    function employeeorientation(){
        return view('pages.employee.employeeorientation');
    }
    function employeetraining(){
        return view('pages.employee.employeetraining');
    }
    function employeecorrection(){
        return view('pages.employee.employeecorrection');
    }
    function employeemessage(){
        return view('pages.employee.employeemessage');
    }
    function employeeprofile(){
        return view('pages.employee.employeeprofile');
    }
}
