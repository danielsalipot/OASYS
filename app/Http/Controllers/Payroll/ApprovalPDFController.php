<?php

namespace App\Http\Controllers\Payroll;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use setasign\Fpdi\Fpdi;

use App\Models\payroll_approval;
use App\Models\Payroll;
use App\Models\UserDetail;
use App\Models\payroll_audit;

class ApprovalPDFController extends Controller
{
    function Approval(Request $request){
        $request->validate([
            'hidden_filename'=>'required',
            'esignature'=>'required',
        ]);

        $filename = explode('/',$request->hidden_filename);

        if(!file_exists("signature/". str_replace(".pdf",'',$filename[2]))){
            mkdir("signature/". str_replace(".pdf",'',$filename[2]));
        }

        $sign_file_pate = "signature/". str_replace(".pdf",'',$filename[2]);

        // upload signature
        $signfilename =  session('user_id').".".$request->file('esignature')->getClientOriginalExtension();
        $request->file('esignature')->storeAs($sign_file_pate, $signfilename,'public_uploads');


        $payroll = Payroll::where('filename',ltrim($request->hidden_filename, '/'))->first();
        //insert sa database payroll_approval

        $check = payroll_approval::where('payroll_id',$payroll->id)->where('payroll_sign',session('user_id'))->first();

        if(isset($check)){
            payroll_approval::where('payroll_id',$payroll->id)
                ->where('payroll_sign',session('user_id'))
                ->update([
                    'payroll_id'=> $payroll->id,
                    'payroll_sign'=>session('user_id'),
                    'status'=>$request->status
                ]);
        }else{
            payroll_approval::create([
                'payroll_id'=> $payroll->id,
                'payroll_sign'=>session('user_id'),
                'status'=>$request->status
            ]);
        }


        $pdf = new Fpdi();
        $pagecount = $pdf->setSourceFile(ltrim($request->hidden_filename, '/'));

        $prm_name = UserDetail::where('login_id', session('user_id'))->first();

        $approves = payroll_approval::where('payroll_id',$payroll->id)->get();

        for ($i=1; $i <=  $pagecount; $i++) {
            $pdf->AddPage();
            $tplIdx = $pdf->importPage($i);
            // use the imported page and place it at point 10,10 with a width of 100 mm
            $pdf->useTemplate($tplIdx, null, null, null, null, true);


            if($i == $pagecount){
                $pdf->SetFont('Arial', 'B', 12);
                $y=0;
                if(count($approves) == 1){
                    $y=60;
                }else{
                    $y=60;
                    for ($j=0; $j < count($approves) - 1; $j++) {
                        $y +=30;
                    }
                }

                $pdf->Ln($y);
                $pdf->Cell(190,7,"$prm_name->fname $prm_name->mname $prm_name->lname",0,1,'C');
                $pdf->Image( $sign_file_pate . "/" .$signfilename, $pdf->GetX() + 78, $pdf->GetY() -20,35,15);
                $pdf->Cell(63,7,'',0,0,'C');
                if($request->status){
                    $pdf->Cell(63,7,'Approved by:','T',0,'C');
                }
                else{
                    $pdf->Cell(63,7,'Disapproved by:','T',0,'C');
                }

                $pdf->Cell(63,7,'',0,0,'C');
            }
        }

        if($request->status){
            $str = 'Approved';
        }
        else{
            $str = 'Dispproved';
        }

        payroll_audit::create([
            'payroll_manager_id' => session()->get('user_id'),
            'type' => 'Approval',
            'employee' => ' - ',
            'activity' => $str.': '.$filename[2],
            'amount' => '-',
            'tid' => ' - ',
        ]);

        $pdf->Output('F', ltrim($request->hidden_filename, '/'));
        $pdf->Output();

    }
}
