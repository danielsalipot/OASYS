<?php

namespace App\Http\Controllers\Payroll;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Fpdf\Fpdf;

use App\Models\payroll_audit;

class PayrollAUDITPDFController extends Controller
{
    function audit(Request $request){
        $audit = payroll_audit::with('payroll_manager','employee_detail')
        ->whereBetween('created_at',[$request->from,$request->to])
            ->get();

        $pdf = new FPDF('L');

        //Add a new page
        $pdf->AddPage();

        $pdf->SetFont('Arial', 'B', 12);

        // Prints a cell with given text
        $pdf->Cell(280,7,'Beulah Land Christian College Inc.',0,1,'C');
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(280,7,'Audit Trail Sheet',0,1,'C');
        $pdf->Cell(280,7,'Date duration:',0,1,'C');
        $pdf->Cell(280,7,$request->from . " - " . $request->to,0,1,'C');

        $pdf->Ln(5);

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->MultiCell(40,7,'Dateasdasdasdads',1);
        $pdf->Cell(40,7,'Payroll Manager',1,0,'C');
        $pdf->Cell(40,7,'Type',1,0,'C');
        $pdf->Cell(40,7,'Employee',1,0,'C');
        $pdf->Cell(40,7,'Activity',1,0,'C');
        $pdf->Cell(40,7,'Detail',1,0,'C');
        $pdf->Cell(40,7,'Activity ID',1,1,'C');

        foreach ($audit as $key => $value) {
            $pdf->Cell(40,7,date($value->created_at),1,0,'C');
            $pdf->Cell(40,7,$value->payroll_manager->fname[0].". " .$value->payroll_manager->lname,1,0,'C');
            $pdf->Cell(40,7,$value->type,1,0,'C');

            if(isset($value->employee_detail->fname[0])){
                $pdf->Cell(40,7,$value->employee_detail->fname[0]. ". " .$value->employee_detail->lname,1,0,'C');
            }else{
                $pdf->Cell(40,7,' - ',1,0,'C');
            }

            $pdf->Cell(40,7,$value->activity,1,0,'C');
            $pdf->Cell(40,7,$value->amount,1,0,'C');
            $pdf->Cell(40,7,$value->tid,1,1,'C');
        }


        $pdf->Output();
        exit;
    }

}
