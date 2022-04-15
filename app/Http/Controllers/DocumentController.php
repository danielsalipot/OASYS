<?php

namespace App\Http\Controllers;

use Fpdf\Fpdf;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function payrollPdf(Request $request){
        $request->pr_col1 = explode(";", $request->pr_col1);
        $request->pr_col2 = explode(";", $request->pr_col2);
        $request->pr_col3 = explode(";", $request->pr_col3);
        $request->pr_col4 = explode(";", $request->pr_col4);
        $request->pr_col5 = explode(";", $request->pr_col5);
        $request->pr_col6 = explode(";", $request->pr_col6);
        $request->pr_col7 = explode(";", $request->pr_col7);
        $request->pr_col8 = explode(";", $request->pr_col8);
        $request->pr_col9 = explode(";", $request->pr_col9);

        $total_net = 0;
        foreach ($request->pr_col9 as $key => $value) {
            $total_net += $value;
        }

        $total_tax = 0;
        foreach ($request->pr_col6 as $key => $value) {
            $total_tax += $value;
        }

        $total_ca = 0;
        foreach ($request->pr_col8 as $key => $value) {
            $total_ca += $value;
        }


        $pdf = new FPDF();

        //Add a new page
        $pdf->AddPage();

        // Set the font for the text
        $pdf->SetFont('Arial', 'B', 12);

        // Prints a cell with given text
        $pdf->Cell(190,7,'Beulah Land Christian College Inc.',0,1,'C');
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(190,7,'Employee Payroll Sheet',0,1,'C');
        $pdf->Cell(190,7,'Cutoff Date:',0,1,'C');
        $pdf->Cell(190,7,$request->pr_date,0,1,'C');

        // Employee Payroll Summary
        $pdf->Cell(190,14,'',0,1,'');
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(190,15,'Employee Payroll Summary',0,1,'');
        $pdf->Cell(130,10,'Total Employee Payment: ',1,0,'');
        $pdf->Cell(60,10,number_format($total_net, 2, '.', ',') ,1,1,'C');
        $pdf->Cell(130,10,'Total Employee Taxes: ',1,0,'');
        $pdf->Cell(60,10,number_format($total_tax, 2, '.', ','),1,1,'C');
        $pdf->Cell(130,10,'Total Employee Cash Advance: ',1,0,'');
        $pdf->Cell(60,10,number_format($total_ca, 2, '.', ','),1,1,'C');

        //Employee Payroll Information
        $pdf->Cell(190,14,'',0,1,'');
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(190,15,'Employee Payroll Information',0,1,'');

        //start of table
        //Table Header
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(13.1,7,'ID',1,0,'C');
        $pdf->Cell(29.1,7,'Employee Name',1,0,'C');
        $pdf->Cell(21.1,7,'Hours',1,0,'C');
        $pdf->Cell(21.1,7,'Rate',1,0,'C');
        $pdf->Cell(21.1,7,'Gross Pay',1,0,'C');
        $pdf->Cell(21.1,7,'Taxes',1,0,'C');
        $pdf->Cell(21.1,7,'Deductions',1,0,'C');
        $pdf->Cell(21.1,7,'Cash Advance',1,0,'C');
        $pdf->Cell(21.1,7,'Net Pay',1,1,'C');

        for ($i=0; $i < count($request->pr_col1); $i++) {
            $pdf->SetFont('Arial', '', 8);
            $pdf->Cell(13.1,7,$request->pr_col1[$i],1,0,'C');
            $pdf->SetFont('Arial', '', 6);
            $pdf->Cell(29.1,7,$request->pr_col2[$i],1,0,'C');
            $pdf->SetFont('Arial', '', 8);
            $pdf->Cell(21.1,7,$request->pr_col3[$i],1,0,'C');
            $pdf->Cell(21.1,7,number_format($request->pr_col4[$i], 2, '.', ','),1,0,'C');
            $pdf->Cell(21.1,7,number_format($request->pr_col5[$i], 2, '.', ','),1,0,'C');
            $pdf->Cell(21.1,7,number_format($request->pr_col6[$i], 2, '.', ','),1,0,'C');
            $pdf->Cell(21.1,7,number_format($request->pr_col7[$i], 2, '.', ','),1,0,'C');
            $pdf->Cell(21.1,7,number_format($request->pr_col8[$i], 2, '.', ','),1,0,'C');
            $pdf->Cell(21.1,7,number_format($request->pr_col9[$i], 2, '.', ','),1,1,'C');
        }


        // return the generated output
        $pdf->Output('F',"payrolls/payroll(" . $request->date .").pdf");
        $pdf->Output();
        exit;
    }

    public function payslipPdf(Request $request){
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

            $pdf->Line(10,42,200,42);

            // Employee Payroll Summary
            $pdf->Ln(5);
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(190,10,'Employee Payroll Summary',0,1,'');

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

            $pdf->Line(10,83,200,83);

            $pdf->Ln(3);

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(190,7,'Attedance Summary',0,1,'');

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

            $pdf->Ln(5);

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(190,7,'Payslip Summary',0,1,'');

            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(50,7,'Rate Per Hour:',0,0,'C');
            $pdf->Cell(130,7,number_format($employee->rate, 2, '.', ',') . " Php",0,1,'R');

            $pdf->Cell(50,7,'Total Hours:',0,0,'C');
            $pdf->Cell(130,7,$employee->complete_hours,0,1,'R');

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(50,7,'Gross Payment:',0,0,'C');
            $pdf->Cell(130,7,number_format($employee->gross_pay, 2, '.', ','),0,1,'R');

            // $pdf->Output('F',"payslips/payslip(PDF NAME).pdf");
            $pdf->Output();
            exit;
        }
    }
}

