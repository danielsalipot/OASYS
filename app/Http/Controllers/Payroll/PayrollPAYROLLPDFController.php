<?php

namespace App\Http\Controllers\Payroll;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Fpdf\Fpdf;


use App\Models\Payroll;
use App\Models\UserDetail;
use App\Models\Audit;
use App\Models\UserCredential;
use App\Models\payroll_approval;

class PayrollPAYROLLPDFController extends Controller
{
    public function payrollPdf(Request $request){
        $PayrollDetails = json_decode($request->pr_col1);

        if($PayrollDetails == null){
            echo "<script>window.close();</script>";
        }
        $pdf = new FPDF();

        // upload signature
        $signfilename =  session('user_id').".".$request->file('esignature')->getClientOriginalExtension();
        $request->file('esignature')->storeAs("signature/", $signfilename,'public_uploads');

/*=============================================================================
|                                   START
|                             HEADER INFORMATION
|
*==============================================================================*/

        //Add a new page
        $pdf->AddPage();

        // Set the font for the text
        $pdf->SetFont('Arial', 'B', 12);

        // Prints a cell with given text
        $pdf->Cell(190,7,'Beulah Land Christian College Inc.',0,1,'C');
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(190,7,'Employee Payroll Sheet',0,1,'C');
        $pdf->Cell(190,7,'Cutoff Date:',0,1,'C');
        $pdf->Cell(190,7,$request->pr_col2,0,1,'C');

/*=============================================================================
|                                   END
*==============================================================================*/



/*=============================================================================
|                                   START
|                                  SUMMARY
|
*==============================================================================*/

$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 12);

// Employee Payroll Summary
$total_net = 0;
foreach ($PayrollDetails as $key => $employee) {
    $total_net += $employee->net_pay;
}

        $pdf->Cell(190,10,'Employee Payroll Summary',"T,B",1,'');
        $pdf->Cell(130,10,'Total Employee Payment: ',0,0,'');
        $pdf->Cell(60,10,number_format($total_net, 2, '.', ',') . " Php",0,1,'C');

// TOTAL WITHOLDING TAX
$total_wtax = 0;
foreach ($PayrollDetails as $key => $employee) {
    $total_wtax += $employee->witholding_tax;
}

        $pdf->Cell(130,10,'Total Employee Witholding Taxes: ',0,0,'');
        $pdf->Cell(60,10,number_format($total_wtax, 2, '.', ',') . " Php",0,1,'C');

// TOTAL EMPLOYEE BONUS
$total_employee_bonus = 0;
foreach ($PayrollDetails as $key => $employee) {
    $total_employee_bonus += $employee->total_bonus;
}

        $pdf->Cell(130,10,'Total Employee Bonus: ',0,0,'');
        $pdf->Cell(60,10,number_format($total_employee_bonus, 2, '.', ',') . " Php",0,1,'C');

// TOTAL EMPLOYEE DEDUCTION
$total_deduction = 0;
foreach ($PayrollDetails as $key => $employee) {
    $total_deduction += $employee->total_deduction;
}
        $pdf->Cell(130,10,'Total Employee deductions: ',0,0,'');
        $pdf->Cell(60,10,number_format($total_deduction, 2, '.', ',') . " Php",0,1,'C');

// TOTAL EMPLOYEE CASH ADVANCE
$total_ca = 0;
foreach ($PayrollDetails as $key => $employee) {
    $total_ca += $employee->total_cash_advance;
}

        $pdf->Cell(130,10,'Total Employee Cash Advance: ',0,0,'');
        $pdf->Cell(60,10,number_format($total_ca, 2, '.', ',') . " Php",0,1,'C');

/*=============================================================================
|                                   END
*==============================================================================*/



/*=============================================================================
|                                   START
|                       SSS CONTRIBUTION COMPUTATION
|
*==============================================================================*/

        $total_sss_er = 0;
        foreach ($PayrollDetails as $key => $employee) {
            $total_sss_er += $employee->employer_contribution;
        }

        $total_sss_ee = 0;
        foreach ($PayrollDetails as $key => $employee) {
            $total_sss_ee += $employee->employee_contribution;
        }

        $total_sss = $total_sss_ee + $total_sss_er;

        $pdf->Ln(5);
        $pdf->Cell(190,10,'SSS Summary',"T,B",1,'C');
        $pdf->Cell(95,10,'Total SSS Employee Contribution: ',0,0,'C');
        $pdf->Cell(95,10,'Total SSS Employer Contribution: ',0,1,'C');

        $pdf->Cell(95,10,number_format($total_sss_ee, 2, '.', ',') . " Php",0,0,'C');
        $pdf->Cell(95,10,number_format($total_sss_er, 2, '.', ',') . " Php",0,1,'C');

        $pdf->Cell(130,10,'Total SSS Payment: ',0,0,'');
        $pdf->Cell(60,10,number_format($total_sss, 2, '.', ',') . " Php",0,1,'C');

/*=============================================================================
|                                   END
*==============================================================================*/



/*=============================================================================
|                                   START
|                       Pag-ibig CONTRIBUTION COMPUTATION
|
*==============================================================================*/

        $total_pagibig_er = 0;
        foreach ($PayrollDetails as $key => $employee) {
            $total_pagibig_er += $employee->employer_pagibig_contribution;
        }

        $total_pagibig_ee = 0;
        foreach ($PayrollDetails as $key => $employee) {
            $total_pagibig_ee += $employee->employee_pagibig_contribution;
        }

        $total_pagibig = $total_pagibig_ee + $total_pagibig_er;

        $pdf->Ln(5);
        $pdf->Cell(190,10,'Pag-ibig Summary',"T,B",1,'C');
        $pdf->Cell(95,10,'Total Pag-ibig Employee Contribution: ',0,0,'C');
        $pdf->Cell(95,10,'Total Pag-ibig Employer Contribution: ',0,1,'C');

        $pdf->Cell(95,10,number_format($total_pagibig_er, 2, '.', ',') . " Php",0,0,'C');
        $pdf->Cell(95,10,number_format($total_pagibig_ee, 2, '.', ',') . " Php",0,1,'C');

        $pdf->Cell(130,10,'Total Pag-ibig Payment: ',0,0,'');
        $pdf->Cell(60,10,number_format($total_pagibig, 2, '.', ',') . " Php",0,1,'C');

/*=============================================================================
|                                   END
*==============================================================================*/



/*=============================================================================
|                                   START
|                       Philhealth CONTRIBUTION COMPUTATION
|
*==============================================================================*/

$total_philhealth_er = 0;
foreach ($PayrollDetails as $key => $employee) {
    $total_philhealth_er += $employee->employer_philhealth_contribution;
}

$total_philhealth_ee = 0;
foreach ($PayrollDetails as $key => $employee) {
    $total_philhealth_ee += $employee->employee_philhealth_contribution;
}

$total_philhealth = $total_philhealth_ee + $total_philhealth_er;

    $pdf->Ln(5);
    $pdf->Cell(190,10,'Philhealth Summary',"T,B",1,'C');
    $pdf->Cell(95,10,'Total Philhealth Employee Contribution: ',0,0,'C');
    $pdf->Cell(95,10,'Total Philhealth Employer Contribution: ',0,1,'C');

    $pdf->Cell(95,10,number_format($total_philhealth_er, 2, '.', ',') . " Php",0,0,'C');
    $pdf->Cell(95,10,number_format($total_philhealth_ee, 2, '.', ',') . " Php",0,1,'C');

    $pdf->Cell(130,10,'Total Philhealth Payment: ',0,0,'');
    $pdf->Cell(60,10,number_format($total_philhealth, 2, '.', ',') . " Php",0,1,'C');

/*=============================================================================
|                                   END
*==============================================================================*/



/*=============================================================================
|                                   START
|                              Employee Table
|
*==============================================================================*/

        $pdf->AddPage('L');

        //Employee Payroll Information
        $pdf->Ln(5);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(275,10,'Employee Payroll Information',"T,B",1,'');

        //start of table
        //Table Header
        $pdf->Ln(3);
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(10.1,7,'ID',1,0,'C');
        $pdf->Cell(36.1,7,'Employee Name',1,0,'C');
        $pdf->Cell(17.1,7,'Hours',1,0,'C');
        $pdf->Cell(21.1,7,'Rate',1,0,'C');
        $pdf->Cell(21.1,7,'Bonus',1,0,'C');
        $pdf->Cell(21.1,7,'Gross Pay',1,0,'C');

        $pdf->Cell(21.1,7,'SSS',1,0,'C');
        $pdf->Cell(21.1,7,'Pag-ibig',1,0,'C');
        $pdf->Cell(21.1,7,'Philhealth',1,0,'C');

        $pdf->Cell(21.1,7,'Deductions',1,0,'C');
        $pdf->Cell(21.1,7,'Cash Advance',1,0,'C');
        $pdf->Cell(21.1,7,'Taxes',1,0,'C');
        $pdf->Cell(21.1,7,'Net Pay',1,1,'C');

        $pdf->SetFont('Arial', '', 7);
        foreach ($PayrollDetails as $key => $employee) {
            $pdf->Cell(10.1,7,$employee->employee_id,1,0,'C');
            $pdf->Cell(36.1,7,$employee->full_name,1,0,'C');
            $pdf->Cell(17.1,7,$employee->complete_hours,1,0,'C');

            $pdf->Cell(21.1,7,number_format($employee->rate, 2, '.', ',') . " Php",1,0,'C');
            $pdf->Cell(21.1,7,number_format($employee->total_bonus, 2, '.', ',') . " Php",1,0,'C');
            $pdf->Cell(21.1,7,number_format($employee->gross_pay, 2, '.', ',') . " Php",1,0,'C');

            $pdf->Cell(21.1,7,number_format($employee->total_sss, 2, '.', ',') . " Php",1,0,'C');
            $pdf->Cell(21.1,7,number_format($employee->total_pagibig_contribution, 2, '.', ',') . " Php",1,0,'C');
            $pdf->Cell(21.1,7,number_format($employee->total_philhealth_contribution, 2, '.', ',') . " Php", 1,0,'C');

            $pdf->Cell(21.1,7,number_format($employee->total_deduction, 2, '.', ',') . " Php",1,0,'C');
            $pdf->Cell(21.1,7,number_format($employee->total_cash_advance, 2, '.', ',') . " Php", 1,0,'C');
            $pdf->Cell(21.1,7,number_format($employee->witholding_tax, 2, '.', ',') . " Php",1,0,'C');
            $pdf->Cell(21.1,7,number_format($employee->net_pay, 2, '.', ',') . " Php",1,1,'C');
        }

/*=============================================================================
|                                   END
*==============================================================================*/



/*=============================================================================
|                                   START
|                         PAYROLL GENERATION PAGE
|
*==============================================================================*/

        $pdf->AddPage();
        $pdf->Ln(20);

        $pdf->SetFont('Arial', 'B', 12);
        $pr_sign = "signature/".$employee->prm_id.".png";
        $pdf->Image($pr_sign, $pdf->GetX() + 78, $pdf->GetY() - 7, 33.78);
        $prm_name = UserDetail::where('login_id', $employee->prm_id)->first();
        $pdf->Cell(190,10,"$prm_name->fname $prm_name->mname $prm_name->lname",0,1,'C');

        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(63,10,'',0,0,'C');
        $pdf->Cell(63,10,'Generated by:','T',0,'C');
        $pdf->Cell(63,10,'',0,1,'C');


/*=============================================================================
|                                   END
*==============================================================================*/

        // AUDIT INSERTION
        Audit::create(['activity_type' => 'payroll',
            'payroll_manager_id' => session()->get('user_id'),
            'type' => 'Payroll',
            'employee' => ' - ',
            'activity' => 'Generated Payroll Summary',
            'amount' => '-',
            'tid' => ' - ',
        ]);

        $dates = explode(' - ',  $request->pr_col2);

        $check = Payroll::where('filename',"payrolls/payroll(" . $request->pr_col2 .").pdf")->first();

        // need mag create ng new record pag existing kasi yung sinosort siya by created time
        // so kailangan sabay lagi ang database at ang file created time

        if(isset($check)){
            //delete all approval
            payroll_approval::where('payroll_id',$check->id)->delete();
            //delete payroll record
            Payroll::where('filename',"payrolls/payroll(" . $request->pr_col2 .").pdf")->delete();
        }

        //insert new
        Payroll::create([
            'filename'=> "payrolls/payroll(" . $request->pr_col2 .").pdf",
            'payroll_manager_id'=> session()->get('user_id'),
            'from_date' => $dates[0],
            'to_date' => $dates[1],
        ]);


        $manager = UserDetail::where('login_id',session('user_id'))->first();
        $head = 'Generated payroll '. $request->pr_col2;
        $text = $manager->fname . " " . $manager->mname . " " . $manager->lname .
        " have generated  payroll " . $request->pr_col2 . " on " . date('Y-m-d') . ' check your account for approvals';

        $reciever_manager = UserCredential::where('user_type','payroll')
            ->where('login_id','!=',session('user_id'))
            ->get();

        foreach ($reciever_manager as $key => $value) {
            $detail = UserDetail::where('login_id',$value->login_id)->first();
            app('App\Http\Controllers\EmailSendingController')->sendNotifEmail($head,$text,
                [['email' => $detail->email, 'name' => $detail->fname . ' ' . $detail->lname]]
            );
        }

        $pdf->Output('F',"payrolls/payroll(" . $request->pr_col2 .").pdf");
        $pdf->Output();
        exit;
    }
}
