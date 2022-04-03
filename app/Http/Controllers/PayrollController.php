<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmployeeDetail;
use Illuminate\Support\Facades\DB;

class PayrollController extends Controller
{
        //Payroll Manager Functions
        function payroll(){
            
            $completeEmployeeDetail = EmployeeDetail::join('user_details', 'employee_details.information_id','=', 'user_details.information_id')
                                    ->paginate(6);
            return view('pages.payroll_manager.payroll',['employees' => $completeEmployeeDetail]);
        }
        function employeelist(){
            return view('pages.payroll_manager.employeelist');
        }
        function deduction(){
            return view('pages.payroll_manager.deduction');
        }
        function overtime(){
            return view('pages.payroll_manager.overtime');
        }
        function cashadvance(){
            return view('pages.payroll_manager.cashadvance');
        }
        function deductiontype(){
            return view('pages.payroll_manager.deductiontype');
        }
        function message(){
            return view('pages.payroll_manager.message');
        }
        function notification(){
            return view('pages.payroll_manager.notification');
        }
}
