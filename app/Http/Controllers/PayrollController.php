<?php

namespace App\Http\Controllers;

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

        function editrate(Request $request){
            $employee = EmployeeDetail::where('employee_id',$request->emp_id)->update(['rate' => $request->rate]);
            return redirect('/employeelist')->with('success','Post Created');
        }

        function deduction(){
            $employeeDeductions = Deduction::join('employee_details','employee_details.employee_id','=','deductions.employee_id')
                            ->join('user_details', 'employee_details.information_id','=', 'user_details.information_id')
                            ->paginate(6);
            return view('pages.payroll_manager.deduction',['employeeDeductions' => $employeeDeductions]);
        }

        function overtime(){
            return view('pages.payroll_manager.overtime');
        }

        function cashadvance(){
            $cashAdvanceRecord = CashAdvance::join('employee_details', 'cash_advances.employee_id','=','employee_details.employee_id')
                                            ->join('user_details', 'employee_details.information_id','=', 'user_details.information_id')
                                            ->paginate(6);
            return view('pages.payroll_manager.cashadvance',['cashAdvanceRecord'=>$cashAdvanceRecord]);
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
