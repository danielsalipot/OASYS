<?php

namespace App\Http\Controllers\Payroll;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Fpdf\Fpdf;
use App\Models\UserDetail;

class PayrollPAYSLIPPDFController extends Controller
{
    public function payslipPdf(Request $request){

        if(!file_exists("payslips/".$request->ps_col2)){
            mkdir("payslips/".$request->ps_col2);
        }

        $EmployeePaylipDetails = json_decode($request->ps_col1);
        foreach ($EmployeePaylipDetails as $key => $employee) {
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

            $pdf->Ln(3);

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(190,10,'Attedance Summary','T,B',1,'');

            $pdf->Cell(57,10,"Attendance Date",0,0,'C');
            $pdf->Cell(40,10,"Time In",0,0,'C');
            $pdf->Cell(40,10,"Time Out",0,0,'C');
            $pdf->Cell(52,10,"Hours",0,1,'C');

            $pdf->SetFont('Arial', '', 12);
            foreach ($employee->attendance as $key => $attendance) {
                $pdf->Cell(57,7,$attendance->attendance_date,0,0,'C');
                $pdf->Cell(40,7,$attendance->time_in,0,0,'C');
                $pdf->Cell(40,7,$attendance->time_out,0,0,'C');
                $pdf->Cell(52,7,$attendance->total_hours,0,1,'C');
            }

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(153,10,"Total Hours: ",0,0,'R');
            $pdf->Cell(19,10,$employee->complete_hours,0,1,'C');

            $pdf->Ln(4);

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(190,10,'Gross Pay Computation','T,B',1,'');

            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(50,7,'Rate Per Hour:',0,0,'C');
            $pdf->Cell(130,7,number_format($employee->rate, 2, '.', ',') . " Php",0,1,'R');

            $pdf->Cell(50,7,'Total Hours:',0,0,'C');
            $pdf->Cell(130,7,$employee->complete_hours,0,1,'R');

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(50,7,'Gross Payment:',0,0,'C');
            $pdf->Cell(130,7,number_format($employee->gross_pay, 2, '.', ','),0,1,'R');

            $pdf->Ln(4);

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(190,10,'Tax Summary','T,B',1,'');

            $pdf->Cell(60,10,"Tax Percentage: ",0,0,'R');
            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(105,10,$employee->taxes->tax_amount,0,1,'R');

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(60,10,"Tax Deduction Amount: ",0,0,'R');
            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(105,10,number_format($employee->tax_deduction, 2, '.', ',') . " Php",0,1,'R');

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(60,10,"Employee Gross Pay: ",0,0,'R');
            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(105,10,number_format($employee->gross_pay, 2, '.', ',') . " Php",0,1,'R');

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(60,10,"Gross After Tax: ",0,0,'R');
            $pdf->Cell(105,10,number_format($employee->gross_pay - $employee->tax_deduction, 2, '.', ',') . " Php",0,1,'R');

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
                    $prm_name = UserDetail::where('login_id', $deduction->payrollManager_id)->first();
                    $pdf->Cell(63,7,"$prm_name->fname $prm_name->mname $prm_name->lname",0,0,'C');
                    $pdf->Cell(63,7,number_format($cashAdvance->cashAdvance_amount, 2, '.', ',') . " Php",0,1,'C');
                }
                $pdf->SetFont('Arial', 'B', 12);
                $pdf->Cell(137,10,"Total Cash Advance: ",0,0,'R');
                $pdf->Cell(40,10,number_format($employee->total_cash_advance, 2, '.', ',') . " Php",0,1,'C');
            }else{
                $pdf->Cell(190,10,"No Cash Advance",1,1,'C');
            }

            $pdf->Ln(4);

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(190,10,'Final Computation','T,B',1,'');

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(60,10,"Employee Gross Pay: ",0,0,'R');
            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(105,10,number_format($employee->gross_pay, 2, '.', ',') . " Php",0,1,'R');

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(60,10,"Tax Deduction Amount: ",0,0,'R');
            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(105,10,number_format($employee->tax_deduction, 2, '.', ',') . " Php",0,1,'R');

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(60,10,"Total Deduction: ",0,0,'R');
            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(105,10,number_format($employee->total_deduction, 2, '.', ',') . " Php",0,1,'R');

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(60,10,"Total Cash Advance: ",0,0,'R');
            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(105,10,number_format($employee->total_cash_advance, 2, '.', ',') . " Php",0,1,'R');

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(60,10,"Total Net Pay: ",0,0,'R');
            $pdf->Cell(105,10,number_format($employee->net_pay, 2, '.', ',') . " Php",0,1,'R');

            $pdf->Ln(30);


            $pdf->Cell(8,10,'',0,0,'C');
            $pres_sign = "signature/president.png";
            $pdf->Image($pres_sign, $pdf->GetX() + 17, $pdf->GetY() - 7, 33.78);
            $pdf->Cell(70,10,'John Doe',0,0,'C');
            $pdf->Cell(30,10,'',0,0,'C');
            $pr_sign = "signature/".$employee->prm_id.".png";
            $pdf->Image($pr_sign, $pdf->GetX() + 17, $pdf->GetY() - 7, 33.78);
            $prm_name = UserDetail::where('login_id', $employee->prm_id)->first();
            $pdf->Cell(70,10,"$prm_name->fname $prm_name->mname $prm_name->lname",0,1,'C');

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(8,10,'',0,0,'C');
            $pdf->Cell(70,10,'President','T',0,'C');
            $pdf->Cell(30,10,'',0,0,'C');
            $pdf->Cell(70,10,'Payroll Manager','T',1,'C');

            $pdf->Ln(30);
            $pdf->Cell(190,10,'Generated by OASYS','T,B',0,'C');

            $pdf->Output('F',"payslips/".$request->ps_col2."/payslip(".$employee->employee_id.$employee->user_detail->lname.").pdf");
        }
        echo "<script>window.close();</script>";
    }
}
