<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Payroll\FPDF\mc_table;
use App\Models\employee_activity;
use App\Models\EmployeeDetail;
use Illuminate\Http\Request;

class AdminPDFController extends Controller
{
    public function employeeActivityPDF(Request $request){
        $audit = employee_activity::whereBetween('created_at',[$request->from,$request->to])
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
        $pdf->Cell(280,7,'Employee Activities',0,1,'C');
        $pdf->Cell(280,7,'Date duration:',0,1,'C');
        $pdf->Cell(280,7,$request->from . " - " . $request->to,0,1,'C');

        $pdf->Ln(5);


        $pdf->SetFont('Arial','',10);

        $pdf->SetWidths(array(69,49,69,89));
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Row(array('Date of Activity (UTC)','Employee ID','Employee Name','Activity'));

        foreach ($audit as $key => $value) {
            $employee = EmployeeDetail::with('UserDetail')->where('employee_id',$value->employee_id)->first();

            $pdf->SetFont('Arial', '', 12);
            $pdf->Row(array(date($value->created_at),$employee->employee_id,$employee->userDetail->fname . ' ' . $employee->userDetail->mname . ' ' . $employee->userDetail->lname, $value->description));
        }

        $pdf->Output('F',"employee_activities/employee_logs(" .$request->from . " - " . $request->to.").pdf");
        $pdf->Output();
        exit;
    }
}
