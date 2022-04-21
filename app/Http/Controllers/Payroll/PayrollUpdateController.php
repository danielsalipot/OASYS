<?php

namespace App\Http\Controllers\Payroll;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\EmployeeDetail;

class PayrollUpdateController extends Controller
{
    function editrate(Request $request){
        $employee = EmployeeDetail::where('employee_id',$request->emp_id)->update(['rate' => $request->rate]);
        return redirect('/payroll/employeelist')->with('success','Post Created');
    }
}
