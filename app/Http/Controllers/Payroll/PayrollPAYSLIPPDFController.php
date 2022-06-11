<?php

namespace App\Http\Controllers\Payroll;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Fpdf\Fpdf;

use App\Models\Payroll;
use App\Models\UserDetail;
use App\Models\Payslips;
use App\Models\payroll_audit;

class PayrollPAYSLIPPDFController extends Controller
{
    public function payslipPdf(Request $request){
        $EmployeePaylipDetails = json_decode($request->ps_col1);

        if(!file_exists("payslips/".$request->ps_col2)){
            mkdir("payslips/".$request->ps_col2);
        }

        foreach ($EmployeePaylipDetails as $key => $employee) {

/*=============================================================================
|                                   START
|                            HEADER INFORMATION
|
*==============================================================================*/

            $pdf = new FPDF();

            //Add a new page
            $pdf->AddPage();

            // Set the font for the text
            $pdf->SetFont('Arial', 'B', 12);

            // Prints a cell with given text
            $pdf->Cell(190,7,'Beulah Land Christian College Inc.',0,1,'C');
            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(190,7,'Employee Payslip Sheet',0,1,'C');
            $pdf->Cell(190,7,'Cutoff Date:',0,1,'C');
            $pdf->Cell(190,7,$request->ps_col2,0,1,'C');

/*=============================================================================
|                                   END
*==============================================================================*/



/*=============================================================================
|                                   START
|                            EMPLOYEE INFORMATION
|
*==============================================================================*/

            // Employee Payroll Summary
            $pdf->Ln(5);
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(190,10,'Employee information','T,B',1,'');

            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(100,7,'Employee ID:',0,0,'');
            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(90,7,$employee->employee_id,0,1,'C');

            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(100,7,'Employee Full Name:',0,0,'');
            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(90,7,$employee->full_name,0,1,'C');

            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(100,7,'Employee Position:',0,0,'');
            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(90,7,$employee->position,0,1,'C');

            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(100,7,'Employee Department:',0,0,'');
            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(90,7,$employee->department,0,1,'C');

/*=============================================================================
|                                   END
*==============================================================================*/



/*=============================================================================
|                                   START
|                       ATTENDANCE SUMMARY INFORMATION
|
*==============================================================================*/

            $pdf->Ln(3);

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(190,10,'Attedance Summary','T,B',1,'');

            $pdf->Cell(40,10,"Attendance Date",0,0,'C');
            $pdf->Cell(31.5,10,"Time In",0,0,'C');
            $pdf->Cell(31.5,10,"Time Out",0,0,'C');
            $pdf->Cell(31.5,10,"Overtime",0,0,'C');
            $pdf->Cell(31.5,10,"Multi Pay",0,0,'C');
            $pdf->Cell(26,10,"Hours",0,1,'C');

            $pdf->SetFont('Arial', '', 12);
            foreach ($employee->attendance as $key => $attendance) {
                $pdf->Cell(40,7,$attendance->attendance_date,0,0,'C');
                $pdf->Cell(31.5,7,$attendance->time_in,0,0,'C');
                $pdf->Cell(31.5,7,$attendance->time_out,0,0,'C');
                $pdf->Cell(31.5,7,$attendance->overtime,0,0,'C');
                if($attendance->mutli_pay_rate == '-'){
                    $pdf->Cell(31.5,7,$attendance->mutli_pay_rate,0,0,'C');
                }else{
                    $pdf->Cell(31.5,7,$attendance->mutli_pay_rate . 'x',0,0,'C');
                }

                $pdf->Cell(26,7,$attendance->work_time,0,1,'C');
            }

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(153,10,"Total Hours: ",0,0,'R');
            $pdf->Cell(19,10,$employee->complete_hours,0,1,'C');

/*=============================================================================
|                                   END
*==============================================================================*/



/*=============================================================================
|                                   START
|                           EMPLOYEE CONTRIBUTION
|
*==============================================================================*/

            $pdf->Ln(4);

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(190,10,'Employee Contributions','T,B',1,'');


            $pdf->Cell(30,7,'',0,0,'C');
            $pdf->Cell(53.3,7,'SSS',0,0,'C');
            $pdf->Cell(53.3,7,'Pag-ibig',0,0,'C');
            $pdf->Cell(53.3,7,'Philhealth',0,1,'C');

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(30.5,7,'Employee',0,0,'C');

            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(53.3,7,number_format($employee->employee_contribution, 2, '.', ','). " Php",0,0,'C');
            $pdf->Cell(53.3,7,number_format($employee->employee_philhealth_contribution, 2, '.', ','). " Php",0,0,'C');
            $pdf->Cell(53.3,7,number_format($employee->employee_pagibig_contribution, 2, '.', ','). " Php",0,1,'C');

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(30.5,7,'Employer',0,0,'C');

            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(53.3,7,number_format($employee->employer_contribution, 2, '.', ','). " Php",0,0,'C');
            $pdf->Cell(53.3,7,number_format($employee->employer_philhealth_contribution, 2, '.', ','). " Php",0,0,'C');
            $pdf->Cell(53.3,7,number_format($employee->employer_pagibig_contribution, 2, '.', ','). " Php",0,1,'C');

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(30.5,7,'Total',0,0,'C');

            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(53.3,7,number_format($employee->total_sss, 2, '.', ','). " Php",0,0,'C');
            $pdf->Cell(53.3,7,number_format($employee->total_philhealth_contribution, 2, '.', ','). " Php",0,0,'C');
            $pdf->Cell(53.3,7,number_format($employee->total_pagibig_contribution, 2, '.', ','). " Php",0,1,'C');



/*=============================================================================
|                                   START
|                           GROSS PAY INFORMATION
|
*==============================================================================*/

            $pdf->Ln(4);

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(190,10,'Gross Pay Computation','T,B',1,'');

            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(50,7,'Rate Per Hour:',0,0,'C');
            $pdf->Cell(130,7,number_format($employee->rate, 2, '.', ',') . " Php",0,1,'R');

            $pdf->Cell(50,7,'Total Hours:',0,0,'C');
            $pdf->Cell(130,7,$employee->complete_hours,0,1,'R');

            $pdf->Cell(50,7,'Total Bonus:',0,0,'C');
            $pdf->Cell(130,7, number_format($employee->total_bonus, 2, '.', ','),0,1,'R');

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(50,7,'Gross Payment:',0,0,'C');
            $pdf->Cell(130,7,number_format($employee->gross_pay, 2, '.', ','),0,1,'R');

/*=============================================================================
|                                   END
*==============================================================================*/



/*=============================================================================
|                                   START
|                            DEDUCTION SUMMARY
|
*==============================================================================*/

            $pdf->Ln(4);

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(190,10,'Deduction Summary','T,B',1,'');

            $pdf->Cell(47,10,"Deduction Date",0,0,'C');
            $pdf->Cell(47,10,"Payroll Manager",0,0,'C');
            $pdf->Cell(47,10,"Deduction Name",0,0,'C');
            $pdf->Cell(47,10,"Deduction Amount",0,1,'C');

            $pdf->SetFont('Arial', '', 12);
            if(count($employee->deduction) > 0){
                foreach ($employee->deduction as $key => $deduction) {
                    $pdf->Cell(47,7,$deduction->deduction_start_date,0,0,'C');
                    $prm_name = UserDetail::where('login_id', $deduction->payrollManager_id)->first();
                    $pdf->Cell(47,7,"$prm_name->fname $prm_name->mname $prm_name->lname",0,0,'C');
                    $pdf->Cell(47,7,$deduction->deduction_name,0,0,'C');
                    $pdf->Cell(47,7,number_format($deduction->deduction_amount, 2, '.', ',') . " Php" ,0,1,'C');
                }
                $pdf->SetFont('Arial', 'B', 12);
                $pdf->Cell(137,10,"Total Deduction: ",0,0,'R');
                $pdf->Cell(40,10,number_format($employee->total_deduction, 2, '.', ',') . " Php",0,1,'C');
            }else{
                $pdf->Cell(190,10,"No Deductions",1,1,'C');
            }

/*=============================================================================
|                                   END
*==============================================================================*/



/*=============================================================================
|                                   START
|                            CASH ADVANCE SUMMARY
|
*==============================================================================*/

            $pdf->Ln(4);

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(190,10,'Cash Advance Summary','T,B',1,'');

            $pdf->Cell(63,10,"Cash Advance Date",0,0,'C');
            $pdf->Cell(63,10,"Payroll Manager",0,0,'C');
            $pdf->Cell(63,10,"Cash Advance Amount",0,1,'C');

            $pdf->SetFont('Arial', '', 12);
            if(count($employee->cashAdvance) > 0){
                foreach ($employee->cashAdvance as $key => $cashAdvance) {
                    $pdf->Cell(63,7,$cashAdvance->cash_advance_date,0,0,'C');
                    $prm_name = UserDetail::where('login_id', $cashAdvance->payrollManager_id)->first();
                    $pdf->Cell(63,7,"$prm_name->fname $prm_name->mname $prm_name->lname",0,0,'C');
                    $pdf->Cell(63,7,number_format($cashAdvance->cashAdvance_amount, 2, '.', ',') . " Php",0,1,'C');
                }
                $pdf->SetFont('Arial', 'B', 12);
                $pdf->Cell(137,10,"Total Cash Advance: ",0,0,'R');
                $pdf->Cell(40,10,number_format($employee->total_cash_advance, 2, '.', ',') . " Php",0,1,'C');
            }else{
                $pdf->Cell(190,10,"No Cash Advance",1,1,'C');
            }

/*=============================================================================
|                                   END
*==============================================================================*/



/*=============================================================================
|                                   START
|                          FINAL COMPUTATION SUMMARY
|
*==============================================================================*/

            $pdf->AddPage();

            $pdf->Ln(4);

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(190,10,'Final Computation','T,B',1,'');

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(60,10,"Employee Gross Pay: ",0,0,'R');
            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(105,10,number_format($employee->gross_pay, 2, '.', ',') . " Php",0,1,'R');

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(60,10,"Total Deduction: ",0,0,'R');
            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(105,10,number_format($employee->total_deduction, 2, '.', ',') . " Php",0,1,'R');

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(60,10,"Total Cash Advance: ",0,0,'R');
            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(105,10,number_format($employee->total_cash_advance, 2, '.', ',') . " Php" ,0,1,'R');


            $total_contribution = $employee->employee_contribution + $employee->employee_philhealth_contribution + $employee->employee_pagibig_contribution;
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(60,10,"Total Employee Contribution: ",0,0,'R');
            $pdf->Cell(105,10,number_format($total_contribution, 2, '.', ',') . " Php",0,1,'R');

            $pdf->Cell(190,0,"","B",1,'R');

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(60,10,"Total Taxable Net: ",0,0,'R');
            $pdf->Cell(105,10,number_format($employee->taxable_net, 2, '.', ',') . " Php",0,1,'R');

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(60,10,"Total Witholding Tax: ",0,0,'R');
            $pdf->Cell(105,10,number_format($employee->witholding_tax, 2, '.', ',') . " Php",0,1,'R');

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(60,10,"Total Net Pay: ",0,0,'R');
            $pdf->Cell(105,10,number_format($employee->net_pay, 2, '.', ',') . " Php",0,1,'R');

            $pdf->Cell(190,10,'Generated by OASYS','T,B',0,'C');

            $pdf->Output('F',"payslips/".$request->ps_col2."/payslip(".$employee->employee_id.$employee->user_detail->lname.").pdf");
/*=============================================================================
|                                   END
*==============================================================================*/




/*=============================================================================
|                                   START
|                              Insert on Database
|
*==============================================================================*/
$payroll_date = explode(' - ',$request->ps_col2);

$payroll_file_record = Payroll::where('from_date',$payroll_date[0])
    ->where('to_date',$payroll_date[1])
    ->first();

Payslips::create([
    'payroll_id' => $payroll_file_record->id,
    'employee_id' => $employee->employee_id,
    'net_pay' => $employee->net_pay,
    'payroll_date' => date($payroll_date[1]),
    'file_name' => "payslip(".$employee->employee_id.$employee->user_detail->lname.").pdf",
    'file_path' => "payslips/".$request->ps_col2."/payslip(".$employee->employee_id.$employee->user_detail->lname.").pdf"
]);

payroll_audit::create([
    'payroll_manager_id' => session()->get('user_id'),
    'type' => 'Payslip',
    'employee' => $employee->employee_id,
    'activity' => 'Generated Payslip',
    'amount' => '-',
    'tid' => ' - ',
]);

/*=============================================================================
|                                   END
*==============================================================================*/
        }
        return 'payslip have been successfully generated';
    }
}
