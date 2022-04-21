<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmployeeDetail;

class UpdateController extends Controller
{
    function editrate(Request $request){
        $employee = EmployeeDetail::where('employee_id',$request->emp_id)->update(['rate' => $request->rate]);
        return redirect('/payroll/employeelist')->with('success','Post Created');
    }
}
