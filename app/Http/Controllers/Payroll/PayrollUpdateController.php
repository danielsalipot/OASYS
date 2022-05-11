<?php

namespace App\Http\Controllers\Payroll;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\EmployeeDetail;
use App\Models\Contributions;
use App\Models\Pagibig;
use App\Models\philhealth;
use App\Models\payroll_audit;
use App\Models\notification_message;
use App\Models\notification_receiver;

class PayrollUpdateController extends Controller
{
    function editrate(Request $request){
        $rate = EmployeeDetail::where('employee_id',$request->emp_id)->first();

        payroll_audit::create([
            'payroll_manager_id' => session()->get('user_id'),
            'type' => 'Employee Rate',
            'employee' => $rate->employee_id,
            'activity' => 'Update Rate Per Hour',
            'amount' => $rate->rate.' -> '. $request->rate,
            'tid' => $rate->employee_id,
        ]);

        if(isset($request->chk)){
            // AUTOMATIC SENDING OF NOTIFICATION
            $employee = EmployeeDetail::where('employee_id',$rate->employee_id)->first();
            $notif = notification_message::create([
                'sender_id' => session()->get('user_id'),
                'title' => 'Pay rate Adjusted',
                'message' => $employee->userDetail->fname . " " . $employee->userDetail->mname . " " . $employee->userDetail->lname .
                            " Your Salary rate has been adjusted from " . $rate->rate . " to " . $request->rate
            ]);

            $notif->receivers()->createMany([
                ['receiver_id' => $rate->employee_id]
            ]);
        }


        EmployeeDetail::where('employee_id',$request->emp_id)->update(['rate' => $request->rate]);

        return redirect('/payroll/employeelist')->with('success','Post Created');
    }

    function edit_sss(Request $request){
        $sss = Contributions::where('contribution_id','1')->first();

        $str = '';
        if($sss->employee_contribution != $request->sss_ee_rate){
            $str .= 'Update Employee Contribution | ';
        }
        if($sss->employer_contribution != $request->sss_er_rate){
            $str .= 'Update Employer Contribution | ';
        }
        if($sss->add_low != $request->sss_add_low){
            $str .= 'Update Low Additional | ';
        }
        if($sss->add_high != $request->sss_add_high){
            $str .= 'Update High Additional | ';
        }

        payroll_audit::create([
            'payroll_manager_id' => session()->get('user_id'),
            'type' => 'SSS',
            'employee' => ' - ',
            'activity' => $str,
            'amount' => '-',
            'tid' => ' - ',
        ]);

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
        $ph = philhealth::where('id','1')->first();

        $str = '';
        if($ph->ee_rate != $request->philhealth_ee_rate){
            $str .= 'Update Employee Philhealth Rate | ';
        }
        if($ph->er_rate != $request->philhealth_er_rate){
            $str .= 'Update Employer Philhealth Rate | ';
        }
        if($ph->ph_rate != $request->philhealth_rate){
            $str .= 'Update Philhealth Rate | ';
        }
        if($ph->ph_cap != $request->philhealth_max_share){
            $str .= 'Update Philhealth Maximum Share | ';
        }
        if($ph->minimum != $request->philhealth_min){
            $str .= 'Update Philhealth Minimum Range | ';
        }
        if($ph->maximum != $request->philhealth_max){
            $str .= 'Update Philhealth Maximum Range | ';
        }
        if($ph->ee_personal != $request->philhealth_share){
            $str .= 'Update High Additional | ';
        }

            payroll_audit::create([
                'payroll_manager_id' => session()->get('user_id'),
                'type' => 'Philhealth',
                'employee' => ' - ',
                'activity' => $str,
                'amount' => ' - ',
                'tid' => ' - ',
            ]);

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
        $pagibig = Pagibig::where('id','1')->first();

        $str = '';
        if($pagibig->ee_rate != $request->pagibig_ee_rate){
            $str .= 'Update Employee Contribution | ';
        }
        if($pagibig->er_rate != $request->pagibig_er_rate){
            $str .= 'Update Employer Contribution | ';
        }
        if($pagibig->maximum != $request->pagibig_max){
            $str .= 'Update Low Additional | ';
        }
        if($pagibig->divider != $request->pagibig_divider){
            $str .= 'Update High Additional | ';
        }

        payroll_audit::create([
            'payroll_manager_id' => session()->get('user_id'),
            'type' => 'Pagibig',
            'employee' => ' - ',
            'activity' => $str,
            'amount' => ' - ',
            'tid' => ' - ',
        ]);

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
