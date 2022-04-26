<?php

namespace App\Http\Controllers\Payroll;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\EmployeeDetail;
use App\Models\Contributions;

class PayrollUpdateController extends Controller
{
    function editrate(Request $request){
        EmployeeDetail::where('employee_id',$request->emp_id)->update(['rate' => $request->rate]);
        return redirect('/payroll/employeelist')->with('success','Post Created');
    }

    function edit_sss(Request $request){
        Contributions::where('contribution_id','1')->update(['employee_contribution' => $request->ee_rate, 'employer_contribution' => $request->er_rate]);
        return redirect('/payroll/contributions')->with('success','Post Created');
    }
}
