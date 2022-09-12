<?php

namespace App\Http\Controllers\Payroll;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Fpdf\Fpdf;

use App\Models\Payroll;
use App\Models\UserDetail;
use App\Models\UserCredential;
use App\Models\notification_message;
use App\Models\Payslips;
use App\Models\Audit;
use App\Models\payroll_approval;

class PayrollPAYSLIPPDFController extends Controller
{
    public function payslipPdf(Request $request){
        if(!isset($request->employees_temp)){
            $EmployeePaylipDetails = json_decode($request->ps_col1);
        }else{
            $EmployeePaylipDetails = json_decode($request->employees_temp);
            $request->ps_col1 = json_decode($request->ps_col1);
            $request->ps_col2 = json_decode($request->ps_col2);
        }

        try {
            $payroll_date = explode(' - ',$request->ps_col2);

            $payroll_file_record = Payroll::where('from_date',$payroll_date[0])
                ->where('to_date',$payroll_date[1])
                ->first();
        } catch (\Throwable $th) {
            //throw $th;
        }


        $manager = UserDetail::where('login_id',$payroll_file_record->payroll_manager_id)->first();

        $payroll_file_record->approver = payroll_approval::join('user_details','user_details.login_id', '=', 'payroll_approvals.payroll_sign')
            ->where('payroll_id',$payroll_file_record->id)
            ->where('status',1)
            ->first();

        $payroll_file_record->noter = payroll_approval::join('user_details','user_details.login_id', '=', 'payroll_approvals.payroll_sign')
            ->where('payroll_id',$payroll_file_record->id)
            ->where('status',2)
            ->first();


        if(!file_exists("payslips/".$request->ps_col2)){
            mkdir("payslips/".$request->ps_col2);
        }

        foreach ($EmployeePaylipDetails as $key => $employee) {

/*=============================================================================
|                                   START
|                            New Payslip Format
|
*==============================================================================*/
$pdf = new FPDF();

//Add a new page
$pdf->AddPage();


// HEADER
$pdf->Ln(5);
$pdf->SetFont('Arial', 'BI', 11);
$pdf->Cell(190,14,'Beulah Land Christian College, Inc.','T,L,R',1,'C');
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(190,5,'CHECK VOUCHER','B,L,R',1,'C');

// FIRST ROW

$pdf->Cell(190,3,'','L,R',1,'C');
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(20,5,'Payee: ','L',0,'C');

$pdf->SetFont('Arial', '', 11);
$pdf->Cell(100,5,strtoupper($employee->full_name),'B',0,'');


$pdf->Cell(31,5,'CV NO. '. date('Y') .':',0,0,'R');
$pdf->Cell(35,5,'','B',0,'C');
$pdf->Cell(4,5,'','R',1,'C');

$pdf->Cell(190,3,'','L,R',1,'C');
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(20,5,'Pesos: ','L',0,'C');

$pdf->SetFont('Arial', '', 7);

if(strpos($employee->net_pay,'.')){
    $pdf->Cell(100,5, strtoupper($this->convertNumberToWord((float) $employee->net_pay)) .' ' . substr($employee->net_pay, -2) . '/100' ,'B',0,'');
}else{
    $pdf->Cell(100,5, strtoupper($this->convertNumberToWord( (float) $employee->net_pay)),'B',0,'');
}

$pdf->SetFont('Arial', '', 11);
$pdf->Cell(31,5,'     DATE:',0,0,'L');
$pdf->Cell(35,5,date('m/d/Y'),'',0,'L');
$pdf->Cell(4,5,'','R',1,'C');

$pdf->Cell(190,7,'','L,R',1,'C');

// END OF FIRST ROW

// SECOND ROW

$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(130,6,'Explanation/Computation',1,0,'C');
$pdf->Cell(60,6,'Amount',1,1,'C');

$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(40,15,'Salary','L,B',0,'C');
$pdf->Cell(90,15,'','B',0,'C');
$pdf->Cell(55,15, number_format($employee->net_pay,2),'B',0,'R');
$pdf->Cell(5,15,'','R,B',1,'C');

// END OF SECOND ROW

//THIRD ROW

$pdf->SetFont('Arial', 'BI', 11);
$pdf->Cell(190,6,'Journal Entry',1,1,'l');


$pdf->SetFont('Arial', '', 11);
$pdf->Cell(20,7,'Code',1,0,'C');
$pdf->Cell(110,7,'Account Title','B',0,'L');
$pdf->Cell(30,7,'Debit','B',0,'L');
$pdf->Cell(30,7,'Credit','B,R',1,'L');

$pdf->Cell(20,7,'',1,0,'C');
$pdf->Cell(108,7,'    '.'Salary',0,0,'L');
$pdf->Cell(30,7,number_format($employee->gross_pay - $employee->total_bonus, 2),0,0,'R');
$pdf->Cell(30,7,'',0,0,'R');
$pdf->Cell(2,7,'','R',1,'L');

if($employee->total_bonus){
    $pdf->Cell(20,7,'',1,0,'C');
    $pdf->Cell(108,7,'    '.'Bonus',0,0,'L');
    $pdf->Cell(30,7,number_format($employee->total_bonus, 2,2),0,0,'R');
    $pdf->Cell(30,7,'',0,0,'R');
    $pdf->Cell(2,7,'','R',1,'L');
}

$total_deduction = 0;
$pdf->Cell(20,7,'',1,0,'C');
$pdf->Cell(108,7,'    '. '    '.'Witholding Tax',0,0,'L');
$pdf->Cell(30,7,'',0,0,'R');
$pdf->Cell(30,7,number_format($employee->witholding_tax,2),0,0,'R');
$pdf->Cell(2,7,'','R',1,'L');
$total_deduction += $employee->witholding_tax;

$pdf->Cell(20,7,'',1,0,'C');
$pdf->Cell(108,7,'    '. '    '.'SSS Contribution',0,0,'L');
$pdf->Cell(30,7,'',0,0,'R');
$pdf->Cell(30,7,number_format($employee->employee_contribution,2),0,0,'R');
$pdf->Cell(2,7,'','R',1,'L');
$total_deduction += $employee->employee_contribution;


$pdf->Cell(20,7,'',1,0,'C');
$pdf->Cell(108,7,'    '.'    '.'Philhealth Contribution',0,0,'L');
$pdf->Cell(30,7,'',0,0,'R');
$pdf->Cell(30,7,number_format($employee->employee_philhealth_contribution ,2),0,0,'R');
$pdf->Cell(2,7,'','R',1,'L');
$total_deduction += $employee->employee_philhealth_contribution;


$pdf->Cell(20,7,'',1,0,'C');
$pdf->Cell(108,7,'    '.'    '.'Pagibig Contribution',0,0,'L');
$pdf->Cell(30,7,'',0,0,'R');
$pdf->Cell(30,7,number_format($employee->employee_pagibig_contribution,2),0,0,'R');
$pdf->Cell(2,7,'','R',1,'L');
$total_deduction += $employee->employee_pagibig_contribution;

if(count($employee->deduction) > 0){
    foreach ($employee->deduction as $key => $deduction) {
        $pdf->Cell(20,7,'',1,0,'C');
        $pdf->Cell(108,7,'    '.'    '.$deduction->deduction_name,0,0,'L');
        $pdf->Cell(30,7,'',0,0,'R');
        $pdf->Cell(30,7,number_format($deduction->deduction_amount,2),0,0,'R');
        $pdf->Cell(2,7,'','R',1,'L');
        $total_deduction += $deduction->deduction_amount;
    }
}

if(count($employee->cashAdvance)){
    $pdf->Cell(20,7,'',1,0,'C');
    $pdf->Cell(108,7,'    '.'    '.'Cash Advance',0,0,'L');
    $pdf->Cell(30,7,'',0,0,'R');
    $pdf->SetFont('Arial', 'B', 11);
    $pdf->Cell(30,7,number_format($employee->total_cash_advance,2),0,0,'R');
    $pdf->Cell(2,7,'','R',1,'L');
}


$pdf->Cell(20,7,'',1,0,'C');
$pdf->Cell(108,7,'    '.'    '.'Cash in Bank',0,0,'L');
$pdf->Cell(30,7,'',0,0,'R');
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(30,7,number_format($employee->net_pay,2),0,0,'R');
$pdf->Cell(2,7,'','R',1,'L');

$pdf->SetFont('Arial', '', 11);
$pdf->Cell(20,7,'',1,0,'C');
$pdf->Cell(78,7,'    '.'    '.'',0,0,'L');
$pdf->Cell(30,7,'    '.'    '.'Total',0,0,'R');
$pdf->Cell(30,7,number_format($employee->gross_pay,2),1,0,'R');
$pdf->Cell(30,7,number_format($total_deduction,2),'T,B',0,'R');
$pdf->Cell(2,7,'','T,B,R',1,'L');

// END OF THIRD ROW

// FORTH ROW
$sign_file_path = 'signature/payroll('. $request->ps_col2 .')';

$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(190,5,'','T,L,R',1,'C');
$pdf->Cell(2,14,'','L',0,'L');
$pdf->Cell(44.5,14,'Prepared By: ','',0,'L');
$pdf->Cell(2.5,14,'','',0,'L');
$pdf->Cell(44.5,14,'Approved By: ','',0,'L');
$pdf->Cell(2.5,14,'','',0,'L');
$pdf->Cell(44.5,14,'Noted By: ','',0,'L');
$pdf->Cell(2.5,14,'','',0,'L');
$pdf->Cell(45,14,'Recieved By:_________','',0,'L');
$pdf->Cell(2,14,'','R',1,'L');

$pdf->Cell(190,3,'','L,R',1,'C');

$pdf->Cell(2,8,'','L',0,'L');
$pdf->Image( $sign_file_path . "/" .$manager->login_id . '.png', $pdf->GetX() + 2, $pdf->GetY() -10,35,15);
$pdf->Cell(44.5,8,$manager->fname . ' ' . substr($manager->mname,0,1).'. ' . $manager->lname,'T',0,'L');
$pdf->Cell(2.5,14,'','',0,'L');

$pdf->Image( $sign_file_path . "/" .$payroll_file_record->approver->login_id . '.png', $pdf->GetX() + 2, $pdf->GetY() -10,35,15);
$pdf->Cell(44.5,8,$payroll_file_record->approver->fname . ' ' . substr($payroll_file_record->approver->mname,0,1).'. ' . $payroll_file_record->approver->lname,'T',0,'L');
$pdf->Cell(2.5,14,'','',0,'L');

$pdf->Image( $sign_file_path . "/" .$payroll_file_record->noter->login_id . '.png', $pdf->GetX() + 2, $pdf->GetY() -10,35,15);
$pdf->Cell(44.5,8,$payroll_file_record->noter->fname . ' ' . substr($payroll_file_record->noter->mname,0,1).'. ' . $payroll_file_record->noter->lname,'T',0,'L');
$pdf->Cell(2.5,8,'','',0,'L');
$pdf->Cell(45,8,'Date:________________','',0,'L');
$pdf->Cell(2,8,'','R',1,'L');

$pdf->Cell(190,5,'','B,L,R',1,'C');

$pdf->Output('F',"payslips/".$request->ps_col2."/payslip(".$employee->employee_id.$employee->user_detail->lname.").pdf");
/*=============================================================================
|                                   END
*==============================================================================*/

/*=============================================================================
|                                   START
|                              Insert on Database
|
*==============================================================================*/

Payslips::create([
    'payroll_id' => $payroll_file_record->id,
    'employee_id' => $employee->employee_id,
    'net_pay' => $employee->net_pay,
    'payroll_date' => date($payroll_date[1]),
    'file_name' => "payslip(".$employee->employee_id.$employee->user_detail->lname.").pdf",
    'file_path' => "payslips/".$request->ps_col2."/payslip(".$employee->employee_id.$employee->user_detail->lname.").pdf"
]);

Audit::create(['activity_type' => 'payroll',
    'payroll_manager_id' => session()->get('user_id'),
    'type' => 'Payslip',
    'employee' => $employee->employee_id,
    'activity' => 'Generated Payslip',
    'amount' => '-',
    'tid' => ' - ',
]);

$notif = notification_message::create([
    'sender_id' => session()->get('user_id'),
    'title' => 'Payslip generated ' ,
    'message' => 'Payslip has been generated for payroll' . $payroll_file_record->from_date . ' - ' .$payroll_file_record->to_date
]);

$notif->receivers()->createMany([
    ['receiver_id' => $employee->employee_id]
]);

array_splice($EmployeePaylipDetails,0,1);
session()->put('payslip_request_col1_flash', json_encode($request->ps_col1));
session()->put('payslip_request_col2_flash', json_encode($request->ps_col2));
session()->put('payslip_employee_temp_flash',json_encode($EmployeePaylipDetails));
if(count($EmployeePaylipDetails)){
    return redirect('/payroll/payslip_land');
}

/*=============================================================================
|                                   END
*==============================================================================*/
        }


        $head = 'Payslip has been generated for payroll '. $payroll_file_record->from_date . " - " . $payroll_file_record->to_date;
        $text = $manager->fname . " " . $manager->mname . " " . $manager->lname .
        " have generated the payslip for payroll " . $payroll_file_record->from_date . " - " . $payroll_file_record->to_date . " on " . date('Y-m-d');

        $reciever_manager = UserCredential::where('user_type','payroll')
            ->where('login_id','!=',session('user_id'))
            ->get();

        foreach ($reciever_manager as $key => $value) {
            $detail = UserDetail::where('login_id',$value->login_id)->first();
            app('App\Http\Controllers\EmailSendingController')->sendNotifEmail($head,$text,
                [['email' => $detail->email, 'name' => $detail->fname . ' ' . $detail->lname]]
            );
        }


        session()->forget('payslip_request_col1_flash');
        session()->forget('payslip_request_col2_flash');
        session()->forget('payslip_employee_temp_flash');

        return redirect('/payroll/approval')->with(['payslip_done'=>'Payslip has been generated successfully']);
    }

    function convertNumberToWord($num = false)
    {
        $words = array();
        if($num < 0){
            $num *= -1;
            array_push($words,'negative ');
        }

        $num = (int) $num;

        $num = str_replace(array(',', ' '), '' , trim($num));
        if(! $num) {
            return false;
        }

        $list1 = array('', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten', 'eleven',
            'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'
        );
        $list2 = array('', 'ten', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety', 'hundred');
        $list3 = array('', 'thousand', 'million', 'billion', 'trillion', 'quadrillion', 'quintillion', 'sextillion', 'septillion',
            'octillion', 'nonillion', 'decillion', 'undecillion', 'duodecillion', 'tredecillion', 'quattuordecillion',
            'quindecillion', 'sexdecillion', 'septendecillion', 'octodecillion', 'novemdecillion', 'vigintillion'
        );
        $num_length = strlen($num);
        $levels = (int) (($num_length + 2) / 3);
        $max_length = $levels * 3;
        $num = substr('00' . $num, -$max_length);
        $num_levels = str_split($num, 3);
        for ($i = 0; $i < count($num_levels); $i++) {
            $levels--;
            $hundreds = (int) ($num_levels[$i] / 100);
            $hundreds = ($hundreds ? ' ' . $list1[$hundreds] . ' hundred' . ' ' : '');
            $tens = (int) ($num_levels[$i] % 100);
            $singles = '';
            if ( $tens < 20 ) {
                $tens = ($tens ? ' ' . $list1[$tens] . ' ' : '' );
            } else {
                $tens = (int)($tens / 10);
                $tens = ' ' . $list2[$tens] . ' ';
                $singles = (int) ($num_levels[$i] % 10);
                $singles = ' ' . $list1[$singles] . ' ';
            }
            $words[] = $hundreds . $tens . $singles . ( ( $levels && ( int ) ( $num_levels[$i] ) ) ? ' ' . $list3[$levels] . ' ' : '' );
        } //end for loop
        $commas = count($words);
        if ($commas > 1) {
            $commas = $commas - 1;
        }
        return implode(' ', $words);
    }
}
