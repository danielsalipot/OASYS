<?php

namespace App\Http\Controllers\Payroll;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\EmployeeDetail;
use App\Models\Contributions;
use App\Models\Pagibig;
use App\Models\philhealth;

class PayrollUpdateController extends Controller
{
    function editrate(Request $request){
        EmployeeDetail::where('employee_id',$request->emp_id)->update(['rate' => $request->rate]);
        return redirect('/payroll/employeelist')->with('success','Post Created');
    }

    function edit_sss(Request $request){
        Contributions::where('contribution_id','1')
            ->update([
                'employee_contribution' => $request->sss_ee_rate,
                'employer_contribution' => $request->sss_er_rate,
                'add_low' => $request->sss_add_low,
                'add_high' => $request->sss_add_high
            ]);
        return redirect('/payroll/contributions')->with('success','Post Created');
    }

    function edit_philhealth(Request $request){
        philhealth::where('id','1')
            ->update([
                'ee_rate' => $request->philhealth_ee_rate,
                'er_rate' => $request->philhealth_er_rate,
                'ph_rate' => $request->philhealth_rate,
                'ph_cap' => $request->philhealth_max_share,
                'minimum' => $request->philhealth_min,
                'maximum' => $request->philhealth_max,
                'ee_personal' => $request->philhealth_share
            ]);
        return redirect('/payroll/contributions')->with('success','Post Created');
    }

    function edit_pagibig(Request $request){
        Pagibig::where('id','1')
            ->update([
                'ee_rate' => $request->pagibig_ee_rate,
                'er_rate' => $request->pagibig_er_rate,
                'maximum' => $request->pagibig_max,
                'divider' => $request->pagibig_divider
            ]);
        return redirect('/payroll/contributions')->with('success','Post Created');
    }
}
