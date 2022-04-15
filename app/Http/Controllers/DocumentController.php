<?php

namespace App\Http\Controllers;

use Fpdf\Fpdf;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function payroll(Request $request){
        $request->col1 = explode(";", $request->col1);
        $request->col2 = explode(";", $request->col2);
        $request->col3 = explode(";", $request->col3);
        $request->col4 = explode(";", $request->col4);
        $request->col5 = explode(";", $request->col5);
        $request->col6 = explode(";", $request->col6);
        $request->col7 = explode(";", $request->col7);
        $request->col8 = explode(";", $request->col8);
        $request->col9 = explode(";", $request->col9);

        $total_net = 0;
        foreach ($request->col9 as $key => $value) {
            $total_net += $value;
        }

        $total_tax = 0;
        foreach ($request->col6 as $key => $value) {
            $total_tax += $value;
        }

        $total_ca = 0;
        foreach ($request->col8 as $key => $value) {
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
        $pdf->Cell(190,7,$request->date,0,1,'C');

        // Employee Payroll Summary
        $pdf->Cell(190,14,'',0,1,'');
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(190,15,'Employee Payroll Summary',0,1,'');
        $pdf->Cell(130,10,'Total Employee Payment: ',1,0,'');
        $pdf->Cell(60,10,$total_net ,1,1,'C');
        $pdf->Cell(130,10,'Total Employee Taxes: ',1,0,'');
        $pdf->Cell(60,10,$total_tax,1,1,'C');
        $pdf->Cell(130,10,'Total Employee Cash Advance: ',1,0,'');
        $pdf->Cell(60,10,$total_ca,1,1,'C');

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

        for ($i=0; $i < count($request->col1); $i++) {
            $pdf->SetFont('Arial', '', 8);
            $pdf->Cell(13.1,7,$request->col1[$i],1,0,'C');
            $pdf->SetFont('Arial', '', 6);
            $pdf->Cell(29.1,7,$request->col2[$i],1,0,'C');
            $pdf->SetFont('Arial', '', 8);
            $pdf->Cell(21.1,7,$request->col3[$i],1,0,'C');
            $pdf->Cell(21.1,7,$request->col4[$i],1,0,'C');
            $pdf->Cell(21.1,7,$request->col5[$i],1,0,'C');
            $pdf->Cell(21.1,7,$request->col6[$i],1,0,'C');
            $pdf->Cell(21.1,7,$request->col7[$i],1,0,'C');
            $pdf->Cell(21.1,7,$request->col8[$i],1,0,'C');
            $pdf->Cell(21.1,7,$request->col9[$i],1,1,'C');
        }


        // return the generated output
        $pdf->Output('F',"payrolls/payroll(" . $request->date .").pdf");
        echo "<script>window.close();</script>";
    }
}
