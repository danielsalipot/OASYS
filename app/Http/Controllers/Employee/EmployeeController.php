<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    //Employee Functions
    function employeehome(){
        return view('pages.employee.employeehome');
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
