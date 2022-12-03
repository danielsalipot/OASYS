<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Payroll\FPDF\mc_table;
use App\Models\Audit;
use App\Http\Controllers\Controller;

class AuditController extends Controller
{
    function audit(Request $request){

        $audit = Audit::with('payroll_manager')
            ->whereBetween('created_at',[$request->from . " 00:00:00",$request->to . " 23:59:59"])
            ->where('activity_type','admin')
            ->get();

        $pdf=new mc_table();

        //Add a new page
        $pdf->AddPage('L');

        // Prints a cell with given text
        $logo = "school_assets/blcc_header.jpg";
        $pdf->Image($logo, $pdf->GetX() + 65, $pdf->GetY(),150);


        $pdf->Ln(30);

        $pdf->SetFont('Arial','',10);
        $pdf->Cell(277,5,ucfirst(session('user_type')).' audit logs for the period covered from ' . $request->from . ' to ' . $request->to ,0,1,'L');

        $pdf->SetFont('Arial','',10);

        //Table with 20 rows and 4 columns
        $pdf->SetWidths(array(40,20,40,40,60,40,40));
        $pdf->Row(array('Date of Activity (UTC)',ucfirst(session('user_type')).' Manager','Type','Employee','Activity','Detail','Activity ID'));

        foreach ($audit as $key => $value) {
            $employee = ' - ';

            if(isset($value->employee)){
                $employee_name = explode(' ',$value->employee);
                $employee = $employee_name[0][0]. ". " . $employee_name[count($employee_name) -1];
            }

            $pr_name = $value->payroll_manager->fname[0].". " .$value->payroll_manager->lname;

            $pdf->Row(array(date($value->created_at),$pr_name,$value->type,$employee,$value->activity,$value->amount,$value->tid));
        }

        $pdf->Output('F',"audits/". session('user_type') ."/audit(" .$request->from . " - " . $request->to.").pdf");
        $pdf->Output();
        exit;
    }
}
