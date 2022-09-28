<?php

namespace App\Http\Controllers\Payroll;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Fpdf\Fpdf;

use App\Models\Payroll;
use App\Models\UserDetail;
use App\Models\Audit;
use App\Models\Deduction;
use App\Models\UserCredential;
use App\Models\payroll_approval;
use Carbon\Carbon;

class PayrollPAYROLLPDFController extends Controller
{
    public function payrollPdf(Request $request){
        $PayrollDetails = json_decode($request->pr_col1);

        if($PayrollDetails == null){
            echo "<script>window.close();</script>";
        }

        if(!file_exists("signature/". "payroll(" . $request->pr_col2 .")")){
            mkdir("signature/". "payroll(" . $request->pr_col2 .")");
        }

        $pdf = new FPDF('P','mm',array( 215.9,330.2));

        // upload signature
        try {
            $signfilename =  session('user_id').".".$request->file('esignature')->getClientOriginalExtension();
            $request->file('esignature')->storeAs("signature/". "payroll(" . $request->pr_col2 .")", $signfilename,'public_uploads');
        } catch (\Throwable $th) {
            session()->flash('err','E-signature is required to create payroll');
            echo "<script>window.close();</script>";
            return;
        }


/*=============================================================================
|                                   START
|                             HEADER INFORMATION
|
*==============================================================================*/

        //Add a new page
        $pdf->AddPage('L');

        // Prints a cell with given text
        $logo = "school_assets/blcc_header.jpg";
        $pdf->Image($logo, $pdf->GetX() + 80, $pdf->GetY() -7,150);

        $pdf->Ln(35);

        $pdf->SetFont('Arial', 'I', 9);

        $dates = explode(' - ',$request->pr_col2);
        $str = '';
        if(date('F',strtotime($dates[0])) == date('F',strtotime($dates[1]))){
            $str .= date('F',strtotime($dates[0])) . ' ' . date('d',strtotime($dates[0])) . '-' . date('d',strtotime($dates[1])) . ',' .  date('Y',strtotime($dates[1]));
        }

        $pdf->Cell(277,5,'Payroll for the period covered ' . $str ,0,1,'L');

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(42,16,'Name of Employees',1,0,'C');
        $pdf->Cell(20,8,'Gross','T,L,R',0,'C');
        $pdf->Cell(198,8,"Deductions",1,0,'C');
        $pdf->Cell(25,8,'Total','T,L,R',0,'C');
        $pdf->Cell(25,8,'Net','T,L,R',1,'C');

        $pdf->Cell(42,16,'',0,0,'C');
        $pdf->Cell(20,8,'Salary','B,L,R',0,'C');

        $deductions =  Deduction::whereBetween('deduction_start_date',[$dates[0],$dates[1]])
            ->whereBetween('deduction_start_date',[$dates[0],$dates[1]])
            ->groupBy('deduction_name')
            ->get('deduction_name');

        $size = 198 / (count($deductions) + 5);

        $pdf->SetFont('Arial', 'B', 7);
        $pdf->Cell($size,8,"SSS",1,0,'C');
        $pdf->Cell($size,8,"Philhealth",1,0,'C');
        $pdf->Cell($size,8,"Pagibig",1,0,'C');
        foreach ($deductions as $key => $value) {
            $pdf->Cell($size,8,$value->deduction_name,1,0,'C');
        }
        $pdf->Cell($size,8,'Witholding Tax',1,0,'C');
        $pdf->Cell($size,8,'Cash Advance',1,0,'C');

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(25,8,'Deductions','B,L,R',0,'C');
        $pdf->Cell(25,8,'Salary','B,L,R',1,'C');

        $total_pdf_gross = 0;
        $total_pdf_dd = 0;
        $total_pdf_net = 0;

        foreach ($PayrollDetails as $key => $employee) {
            $pdf->SetFont('Arial', '', 9);
            $pdf->Cell(42,8,$employee->user_detail->fname . ' ' . substr($employee->user_detail->mname,0,1) . '. ' . $employee->user_detail->lname,1,0,'L');
            $total_pdf_gross += $employee->gross_pay;
            $pdf->Cell(20,8,number_format($employee->gross_pay,2),'B,L,R',0,'C');

            $deductions =  Deduction::whereBetween('deduction_start_date',[$dates[0],$dates[1]])
                ->whereBetween('deduction_start_date',[$dates[0],$dates[1]])
                ->groupBy('deduction_name')
                ->get('deduction_name');

            $size = 198 / (count($deductions) + 5);


            $ttl_deduction = 0;
            $pdf->SetFont('Arial', '', 9);

            $ttl_deduction += $employee->employee_contribution;
            $pdf->Cell($size,8,number_format($employee->employee_contribution,2),1,0,'R');

            $ttl_deduction += $employee->employee_philhealth_contribution;
            $pdf->Cell($size,8,number_format($employee->employee_philhealth_contribution,2),1,0,'R');

            $ttl_deduction += $employee->employee_pagibig_contribution;
            $pdf->Cell($size,8,number_format($employee->employee_pagibig_contribution,2),1,0,'R');

            foreach ($deductions as $key => $value) {
                $deduction = Deduction::where('employee_id',$employee->employee_id)
                    ->whereBetween('deduction_start_date',[$dates[0],$dates[1]])
                    ->whereBetween('deduction_start_date',[$dates[0],$dates[1]])
                    ->where('deduction_name', $value->deduction_name)
                    ->get();

                if(count($deduction)){
                    $amount = 0;
                    foreach ($deduction as $key => $dd_amount) {
                        $days = Carbon::parse($dd_amount->deduction_start_date)->diffInDays(Carbon::parse($dd_amount->deduction_end_date));
                        $amount += $dd_amount->deduction_amount / $days;
                    }
                    $ttl_deduction += $amount;
                    $pdf->Cell($size,8,number_format($amount,2),1,0,'R');
                }
                else{
                    $pdf->Cell($size,8,'-',1,0,'R');
                }
            }

            $ttl_deduction += $employee->witholding_tax;
            $pdf->Cell($size,8,number_format($employee->witholding_tax,2),1,0,'R');

            $ttl_ca = 0;
            foreach ($employee->cashAdvance as $key => $cash_advance) {
                $ttl_deduction += $cash_advance->cashAdvance_amount;
                $ttl_ca += $cash_advance->cashAdvance_amount;
            }

            if($ttl_ca){
                $pdf->Cell($size,8,number_format($ttl_ca,2),1,0,'R');
            }
            else{
                $pdf->Cell($size,8,'-',1,0,'R');
            }

            $total_pdf_dd += $ttl_deduction;
            $pdf->Cell(25,8,number_format($ttl_deduction,2),'B,L,R',0,'R');
            $total_pdf_net += $employee->net_pay;
            $pdf->Cell(25,8,number_format($employee->net_pay,2),'B,L,R',1,'R');
        }

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(42,8,'SUB-TOTAL',0,0,'R');
        $pdf->Cell(20,8,number_format($total_pdf_gross,2),'B',0,'C');
        $pdf->Cell(198,8,"","B",0,'C');
        $pdf->Cell(25,8,number_format($total_pdf_dd,2),'B',0,'C');
        $pdf->Cell(25,8,number_format($total_pdf_net,2),'B',1,'C');


        $pdf->Ln(10);

        $manager = UserDetail::join('user_credentials', 'user_credentials.login_id', '=' , 'user_details.login_id' )
            ->where('user_details.login_id',session('user_id'))->first();

        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(42,5,'Prepared By: ',0,1,'L');
        $pdf->Ln(15);
        $pdf->SetFont('Arial', 'B', 10);

        $sign_file_path = 'signature/payroll('.$request->pr_col2.')';
        $pdf->Image( $sign_file_path . "/" .$manager->login_id . '.png', $pdf->GetX() + 2, $pdf->GetY() -10,28,15);

        $height_reference = $pdf->GetY();
        $pdf->Cell(42,5,$manager->fname. ' ' . substr($manager->mname,0,1) . '. ' . $manager->lname ,0,1,'L');

        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(42,5,ucfirst($manager->user_type) . ' Manager' ,0,1,'L');

        $pdf->Output('F','payrolls/payroll('.$request->pr_col2.').pdf');
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
            'height_reference' => $height_reference
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

        $pdf->Output();
        exit;
    }
}
