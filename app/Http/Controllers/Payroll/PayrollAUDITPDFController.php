<?php

namespace App\Http\Controllers\Payroll;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Fpdf\Fpdf;
use App\Http\Controllers\Payroll\FPDF\mc_table;

use App\Models\payroll_audit;

class PayrollAUDITPDFController extends Controller
{
    function audit(Request $request){
        $audit = payroll_audit::with('payroll_manager','employee_detail')
            ->whereBetween('created_at',[$request->from,$request->to])
            ->get();

        $pdf=new mc_table();

        //Add a new page
        $pdf->AddPage('L');

        $pdf->SetFont('Arial', 'B', 12);

        // Prints a cell with given text
        $pdf->Cell(280,7,'Beulah Land Christian College Inc.',0,1,'C');
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(280,7,'Audit Trail Sheet',0,1,'C');
        $pdf->Cell(280,7,'Date duration:',0,1,'C');
        $pdf->Cell(280,7,$request->from . " - " . $request->to,0,1,'C');

        $pdf->Ln(5);


        $pdf->SetFont('Arial','',10);

        //Table with 20 rows and 4 columns
        $pdf->SetWidths(array(40,20,40,40,60,40,40));
        $pdf->Row(array('Date of Activity (UTC)','Payroll Manager','Type','Employee','Activity','Detail','Activity'));

        foreach ($audit as $key => $value) {
            $employee = ' - ';
            if(isset($value->employee_detail->fname[0])){
                $employee = $value->employee_detail->fname[0]. ". " .$value->employee_detail->lname;
            }
            $pr_name = $value->payroll_manager->fname[0].". " .$value->payroll_manager->lname;

            $pdf->Row(array(date($value->created_at),$pr_name,$value->type,$employee,$value->activity,$value->amount,$value->tid));
        }

        $pdf->Output('F',"audits/audit(" .$request->from . " - " . $request->to.").pdf");
        $pdf->Output();
        exit;
    }

}
