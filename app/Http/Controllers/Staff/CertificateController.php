<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Clearance;
use App\Models\coe;
use App\Models\EmployeeDetail;
use App\Models\UserCredential;
use App\Models\UserDetail;
use Fpdf\Fpdf;


class CertificateController extends Controller
{
    public function employmentCertificate($id){
        $employee = EmployeeDetail::with('UserDetail')->where('employee_id',$id)->first();
        $employee->username = UserCredential::where('login_id',$employee->login_id)->first(['username'])->username;

        $manager = UserDetail::where('login_id',session('user_id'))->first();
        $clearance = Clearance::where('employee_id',$employee->employee_id)->first();

        $pdf = new FPDF();
        $pdf->AddPage();

        $pdf->SetFont('Times', '', 15);
        // Prints a cell with given text
        $logo = "school_assets/beulah_land_logo.jpg";
        $pdf->Image($logo, $pdf->GetX() + 78, $pdf->GetY() - 3, 33.78);

        $pdf->Ln(35);
        $pdf->Cell(190,7,'Beulah Land Christian College Inc.',0,1,'C');
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(190,5,'2 Marytown Cir, Novaliches, Quezon City, 1124 Metro Manila',0,1,'C');
        $pdf->Cell(190,5,'blccinc2020@gmail.com',0,1,'C');
        $pdf->Cell(190,5,'(033) 320-8347',0,1,'C');

        $pdf->Ln(10);
        $pdf->SetFont('Arial', 'B', 20);
        $pdf->Cell(190,40,'CERTIFICATE OF EMPLOYMENT',0,1,'C');

        if($employee->userDetail->sex == 'male'){
            $sex = 'Mr.';
        }
        else{
            $sex = 'Ms.';
        }

        $full_name = $employee->userDetail->fname . ' ' . $employee->userDetail->mname . ' ' . $employee->userDetail->lname;
        $manager_full_name = $manager->fname . ' ' . $manager->mname . ' ' . $manager->lname;

        $pdf->SetFont('Arial', '', 13);
        $pdf->MultiCell( 190, 10, 'This is to certify that '. $sex .' '. $full_name .' was employed with Beulah Land Christian College Inc from ' .date('l, jS \of F Y', strtotime($employee->start_date)). ' to '.date('l, jS \of F Y', strtotime($clearance->created_at)).' as '. $employee->position .' of '.$employee->department.' department.', 0);
        $pdf->Ln(5);
        $pdf->MultiCell( 190, 10, 'This certification is issued upon the request of '.$sex.' '.$employee->userDetail->lname.' for employment purposes and is not valid for any other purpose.', 0);
        $pdf->Ln(5);
        $pdf->MultiCell( 190, 10, 'Issued on '.date('l, jS \of F Y').'.', 0);

        $pdf->Ln(20);
        $pr_sign = "signature/".$manager->login_id.".png";
        try {
            $pdf->Image($pr_sign, $pdf->GetX() + 25, $pdf->GetY() - 10, 33.78);
        } catch (\Throwable $th) {
            return false;
        }
        $pdf->SetFont('Arial', 'B', 13);
        $pdf->Cell(80,6, $manager_full_name ,0,1,'C');
        $pdf->SetFont('Arial', '', 13);
        $pdf->Cell(80,6,'Human Resources Manager',0,1,'C');

        $pdf->Output('F',"coes/coe_".$employee->userDetail->lname."(". $id .").pdf");

        coe::create([
            'employee_id' => md5(md5($id)),
            'fname' => $employee->userDetail->fname,
            'mname' => $employee->userDetail->mname,
            'lname' => $employee->userDetail->lname,
            'email' => $employee->userDetail->email,
            'username' => $employee->username,
            'path' => "coes/coe_".$employee->userDetail->lname."(". $id .").pdf"
        ]);

        return md5(md5($id));
    }

    public function coeDisplay($id){
        $coe = coe::where('employee_id',$id)->first();
        return view('pages.certificate')->with([
            'path' => $coe->path
        ]);
    }
}
