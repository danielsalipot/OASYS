<?php

namespace App\Http\Controllers;

use App\Models\EmployeeDetail;
use App\Observer;
use App\Spiders\BIRWebSpider;
use App\Spiders\LaravelDocsSpider;
use App\Spiders\PagibigWebSpider;
use App\Spiders\PhilHealthWebSpider;
use RoachPHP\Roach;
use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfReader;
use Spatie\Crawler\Crawler;

class TestController extends Controller
{
    //Medyo tapos na
    // create form na iaask lahat ng di mo alam
    public function editTest(){
        $employees = EmployeeDetail::with('UserDetail')->get();

        $pdf = new Fpdi();
        $pageCount = $pdf->setSourceFile('SSSForms_Employment_Report.pdf');
        for ($a=1; $a <= $pageCount; $a++) {
            $pageId = $pdf->importPage($a, PdfReader\PageBoundaries::MEDIA_BOX);
            if($a == 1){
                $pdf->addPage('L');
                $pdf->useImportedPage($pageId, 0, 5, 300);

                $y = 67;
                for ($i=0; $i < count($employees); $i++) {
                    $y += 5.2;
                    $this->printEmployeeDetail($employees[$i],$y,$pdf);

                    if(count($employees) > 13  && $i > 13){
                        $y = 67;
                        $pdf->addPage('L');
                        $pdf->useImportedPage($pageId, 0, 5, 300);

                        for ($j=$i + 1; $j < count($employees); $j++) {
                            $y += 5.2;
                            $this->printEmployeeDetail($employees[$j],$y,$pdf);
                        }
                        break;
                    }
                }
            }elseif($a == 2){
                $pdf->addPage('L');
                $pdf->useImportedPage($pageId, 0, 5, 300);
            }else{
                $pdf->addPage();
                $pdf->useImportedPage($pageId, 0, 5,200);
            }
        }

        $pdf->Output('I', 'generated.pdf');
    }

    function printEmployeeDetail($employee,$y,$pdf){
        //SS number
        $pdf->SetFont('Arial','b');
        $pdf->SetFontSize(8);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(5.5, $y);
        $pdf->Write(0, "1   1   1   0   0   0   0   0   0   0");

        //Name
        $pdf->SetFontSize(8);
        $pdf->SetFont('Arial');
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(47, $y);

        $name = '';

        $name .= $employee->userDetail->lname;
        for ($j = strlen($name); $j < 20 ; $j++) {
            $name .= ' ';
        }

        $name .= $employee->userDetail->fname;
        for ($j = strlen($name); $j <40 ; $j++) {
            $name .= ' ';
        }

        $name .= $employee->userDetail->mname;
        for ($j = strlen($name); $j <40 ; $j++) {
            $name .= ' ';
        }

        $pdf->Write(0, $name);

        //Birthday
        $date = date(('mdY'),strtotime($employee->userDetail->bday));
        $bday = '';

        for ($date_count=0; $date_count < strlen($date); $date_count++) {
            $bday .= $date[$date_count];
            $bday .= '   ';
        }

        $pdf->SetFontSize(7.8);
        $pdf->SetFont('Arial');
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(124, $y);

        $pdf->Write(0, $bday);

        //Date of Employmet

        $sdate = date(('mdY'),strtotime($employee->start_date));
        $sday = '';

        for ($sdate_count=0; $sdate_count < strlen($sdate); $sdate_count++) {
            $sday .= $sdate[$sdate_count];
            $sday .= '   ';
        }

        $pdf->SetFontSize(7.8);
        $pdf->SetFont('Arial');
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(154.5, $y);

        $pdf->Write(0, $sday);

        //Monthly Salary
        $pdf->SetFontSize(8);
        $pdf->SetFont('Arial');
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(215, $y);
        $pdf->Write(0, number_format(round($employee->rate * 730.001)).'.00 php');

        //Position
        $pdf->SetFontSize(5);
        $pdf->SetFont('Arial');
        $pdf->SetTextColor(0,0,0);
        $pdf->SetXY(238, $y);
        $pdf->Write(0, $employee->position);

    }

    public function PhilHealthform(){
        $employees = EmployeeDetail::with('UserDetail')->get();

        $pdf = new Fpdi();
        $pageCount = $pdf->setSourceFile('philhealth-compressed.pdf');

        $y = 61;
        for ($a=1; $a <= $pageCount; $a++) {
            $pageId = $pdf->importPage($a, PdfReader\PageBoundaries::MEDIA_BOX);
            if($a == 1){
                $pdf->addPage('L');
                $pdf->useImportedPage($pageId, 15, -2, 270);

                foreach ($employees as $key => $employee) {
                    //Philhealth Number number
                    $pdf->SetFont('Arial','b');
                    $pdf->SetFontSize(10);
                    $pdf->SetTextColor(0,0,0);
                    $pdf->SetXY(21, $y);
                    $pdf->Write(0, "00-000000000-0");

                    //Name
                    $pdf->SetFont('Arial',);
                    $pdf->SetFontSize(10);
                    $pdf->SetTextColor(0,0,0);
                    $pdf->SetXY(55, $y);
                    $pdf->Write(0, $employee->userDetail->fname . ' ' . $employee->userDetail->mname . ' ' . $employee->userDetail->lname);

                    //Position
                    $pdf->SetFont('Arial',);
                    $pdf->SetFontSize(7);
                    $pdf->SetTextColor(0,0,0);
                    $pdf->SetXY(118, $y);
                    $pdf->Write(0, $employee->position);

                    //Salary
                    $pdf->SetFont('Arial',);
                    $pdf->SetFontSize(7);
                    $pdf->SetTextColor(0,0,0);
                    $pdf->SetXY(158, $y);
                    $pdf->Write(0, number_format(round($employee->rate * 730.001)).'.00 php');

                    //Salary
                    $pdf->SetFont('Arial',);
                    $pdf->SetFontSize(8);
                    $pdf->SetTextColor(0,0,0);
                    $pdf->SetXY(183, $y);
                    $pdf->Write(0, $employee->start_date);

                    $y += 6.2;
                }

                //total count
                $pdf->SetFont('Arial',);
                $pdf->SetFontSize(30);
                $pdf->SetTextColor(0,0,0);
                $pdf->SetXY(100, 189);
                $pdf->Write(0, 20);

            }else{
                $pdf->addPage();
                $pdf->useImportedPage($pageId, 0, 5,200);
            }
        }

        $pdf->Output('I', 'generated.pdf');
    }

    public function PSPDFTest(){
        // shit works
        Roach::startSpider(BIRWebSpider::class);
        $items = Roach::collectSpider(BIRWebSpider::class);
        echo $items[0]->get('html');
    }
}
