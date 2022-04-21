<?php

namespace App\Http\Controllers\Payroll;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\EmployeeDetail;
use App\Models\Deduction;
use App\Models\Overtime;
use App\Models\Attendance;
use App\Models\CashAdvance;

class PayrollController extends Controller
{
        function payroll(){
            return view('pages.payroll_manager.payroll');
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

        function bonus(){
            return view('pages.payroll_manager.bonus');
        }

        function doublepay(){
            return view('pages.payroll_manager.doublepay');
        }

        function message(){
            return view('pages.payroll_manager.message');
        }

        function notification(){
            return view('pages.payroll_manager.notification');
        }
}
