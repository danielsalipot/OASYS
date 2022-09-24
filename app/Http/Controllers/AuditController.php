<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Payroll\FPDF\mc_table;
use App\Models\Audit;
use App\Http\Controllers\Controller;

class AuditController extends Controller
{
    function audit(Request $request){
        $audit = Audit::with('payroll_manager','employee_detail')
            ->whereBetween('created_at',[$request->from,$request->to])
            ->where('activity_type',$request->type)
            ->get();

        $pdf=new mc_table();

        //Add a new page
        $pdf->AddPage('L');

        $pdf->SetFont('Times', '', 15);
        // Prints a cell with given text
        $logo = "school_assets/beulah_land_logo.jpg";
        $pdf->Image($logo, $pdf->GetX() + 78, $pdf->GetY() - 3, 33.78);

        $pdf->Ln(35);
        $pdf->Cell(280,7,'Beulah Land Christian College Inc.',0,1,'C');
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(280,5,'2 Marytown Cir, Novaliches, Quezon City, 1124 Metro Manila',0,1,'C');
        $pdf->Cell(280,5,'blccinc2020@gmail.com',0,1,'C');
        $pdf->Cell(280,5,'(033) 320-8347',0,1,'C');

        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(280,7,'Audit Trail Sheet ('.ucfirst(session('user_type')) . ')',0,1,'C');
        $pdf->Cell(280,7,'Date duration:',0,1,'C');
        $pdf->Cell(280,7,$request->from . " - " . $request->to,0,1,'C');

        $pdf->Ln(5);


        $pdf->SetFont('Arial','',10);

        //Table with 20 rows and 4 columns
        $pdf->SetWidths(array(40,20,40,40,60,40,40));
        $pdf->Row(array('Date of Activity (UTC)',ucfirst(session('user_type')).' Manager','Type','Employee','Activity','Detail','Activity'));

        foreach ($audit as $key => $value) {
            $employee = ' - ';
            if(isset($value->employee_detail->fname[0])){
                $employee = $value->employee_detail->fname[0]. ". " .$value->employee_detail->lname;
            }
            $pr_name = $value->payroll_manager->fname[0].". " .$value->payroll_manager->lname;

            $pdf->Row(array(date($value->created_at),$pr_name,$value->type,$employee,$value->activity,$value->amount,$value->tid));
        }

        $pdf->Output('F',"audits/". session('user_type') ."/audit(" .$request->from . " - " . $request->to.").pdf");
        $pdf->Output();
        exit;
    }
}