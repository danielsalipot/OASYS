<?php

namespace App\Http\Controllers\Payroll;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Contributions;

class PayrollController extends Controller
{
        function payroll(){
            return view('pages.payroll_manager.payroll');
        }

        function history(){
            return view('pages.payroll_manager.pr_history');
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

        function contributions(){
            $sss = Contributions::first();
            return view('pages.payroll_manager.contributions',compact('sss'));
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
