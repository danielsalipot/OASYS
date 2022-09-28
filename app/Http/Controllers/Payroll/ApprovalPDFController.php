<?php

namespace App\Http\Controllers\Payroll;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use setasign\Fpdi\Fpdi;

use App\Models\payroll_approval;
use App\Models\Payroll;
use App\Models\UserDetail;
use App\Models\Audit;
use App\Models\UserCredential;

class ApprovalPDFController extends Controller
{
    function Approval(Request $request){
        $filename = explode('/',$request->hidden_filename);

        if(!file_exists("signature/". str_replace(".pdf",'',$filename[2]))){
            mkdir("signature/". str_replace(".pdf",'',$filename[2]));
        }

        try {
            $sign_file_pate = "signature/". str_replace(".pdf",'',$filename[2]);

            // upload signature
            $signfilename =  session('user_id').".".$request->file('esignature')->getClientOriginalExtension();
            $request->file('esignature')->storeAs($sign_file_pate, $signfilename,'public_uploads');
        } catch (\Throwable $th) {
            session()->flash('err','E-signature is required');
            echo "<script>window.close();</script>";
            return;
        }

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

        $prm_name = UserDetail::join('user_credentials', 'user_credentials.login_id', '=' , 'user_details.login_id' )
        ->where('user_details.login_id',session('user_id'))->first();

        $approves = payroll_approval::where('payroll_id',$payroll->id)->get();

        for ($i=1; $i <=  $pagecount; $i++) {
            $pdf->AddPage();
            $tplIdx = $pdf->importPage($i);
            // use the imported page and place it at point 10,10 with a width of 100 mm
            $pdf->useTemplate($tplIdx, null, null, null, null, true);


            if($i == $pagecount){
                $x=0;
                if(count($approves) == 1){
                    $x=75;
                }else{
                    $x=90;
                    for ($j=0; $j < count($approves) - 1; $j++) {
                        $x += 70;
                    }
                }

                $pdf->Ln($payroll->height_reference- 30.1);
                $pdf->SetFont('Arial', '', 10);
                if($request->status == 1){
                    $pdf->Cell($x,5,'',0,0,'L');
                    $pdf->Cell(42,5,'Approved by:',0,1,'L');
                }
                if($request->status == 2){
                    $pdf->Cell($x,5,'',0,0,'L');
                    $pdf->Cell(42,5,'Noted by:',0,1,'L');
                }
                if($request->status == 0){
                    $pdf->Cell($x,5,'',0,0,'L');
                    $pdf->Cell(42,5,'Disapproved by:',0,1,'L');
                }

                $pdf->Ln(15);

                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell($x,5,'',0,0,'L');

                $pdf->Image( $sign_file_pate . "/" .$signfilename, $pdf->GetX(), $pdf->GetY() -10,28,15);
                $pdf->Cell(42,5,"$prm_name->fname " . substr($prm_name->mname,0,1) .". $prm_name->lname",0,1,'L');
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell($x,5,'',0,0,'L');
                $pdf->Cell(42,5,ucfirst($prm_name->user_type) . ' Manager' ,0,1,'L');

                $pdf->Cell(63,7,'',0,0,'C');

                $pdf->Cell(63,7,'',0,0,'C');
            }
        }

        if($request->status == 1){
            $str = 'Approved';
        }
        if($request->status  == 2){
            $str = 'Noted';
        }
        if($request->status  == 0){
            $str = 'Disapproved';
        }

        $manager = UserDetail::where('login_id',session('user_id'))->first();
        $head = $str . " payroll " . $payroll->from_date . " to " . $payroll->to_date;
        $text = $manager->fname . " " . $manager->mname . " " . $manager->lname .
        " have approved the payroll " . $payroll->from_date . " - " . $payroll->to_date . " on " . date('Y-m-d');

        $reciever_manager = UserCredential::where('user_type','payroll')
            ->where('login_id','!=',session('user_id'))
            ->get();

        foreach ($reciever_manager as $key => $value) {
            $detail = UserDetail::where('login_id',$value->login_id)->first();
            app('App\Http\Controllers\EmailSendingController')->sendNotifEmail($head,$text,
                [['email' => $detail->email, 'name' => $detail->fname . ' ' . $detail->lname]]
            );
        }

        Audit::create(['activity_type' => 'payroll',
            'payroll_manager_id' => session()->get('user_id'),
            'type' => 'Approval',

            'activity' => $str.': '.$filename[2],
            'amount' => '-',

        ]);


        $pdf->Output('F', ltrim($request->hidden_filename, '/'));
        $pdf->Output();
    }
}
