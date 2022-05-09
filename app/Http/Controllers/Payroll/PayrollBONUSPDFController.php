<?php

namespace App\Http\Controllers\Payroll;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Payroll\FPDF\mc_table;
use App\Models\EmployeeDetail;

class PayrollBONUSPDFController extends Controller
{
    public function bonusPdf(Request $request){
        $dates = explode(' - ',$request->json);
        $employees = EmployeeDetail::join('user_details','user_details.information_id','=','employee_details.information_id')
        ->get();
        foreach ($employees as $key1 => $employee) {
            $employee->payroll = $employee->FilteredPayroll($employee->employee_id, $dates[0],$dates[1]);
            foreach ($employee->payroll as $key2 => $payroll) {
                $employee->total_salary += $payroll->net_pay;
            }
            $employee->total_salary = round($employee->total_salary,2);
            $employee->estimated_bonus = round($employee->total_salary / 12,2);
        }

        $pdf=new mc_table();

        //Add a new page
        $pdf->AddPage('L');

        $pdf->SetFont('Arial', 'B', 12);

        // Prints a cell with given text
        $pdf->Cell(280,7,'Beulah Land Christian College Inc.',0,1,'C');
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(280,7,'13th Month bonus Summary',0,1,'C');
        $pdf->Cell(280,7,'Date duration:',0,1,'C');
        $pdf->Cell(280,7,$dates[0] . " - " . $dates[1],0,1,'C');

        $pdf->SetWidths(array(46,46,46,46,46,46,46));
        $pdf->Row(array('Employee Name','Employee Department','Employee Position','Employee Rate','Employee Total Salary','Estimated Bonus'));

        foreach ($employees as $key => $employee) {
            $pdf->Row(array($employee->fname[0]. ". ". $employee->lname,
                $employee->department,
                $employee->position,
                $employee->rate ." Php",
                $employee->total_salary ." Php",
                $employee->estimated_bonus ." Php"));
        }

        $pdf->Output('F',"bonuses/bonus(" . $dates[0]."-". $dates[1] .").pdf");
        $pdf->Output();
        exit;
    }
}
