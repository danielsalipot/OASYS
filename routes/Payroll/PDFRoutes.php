<?php

use App\Http\Controllers\Payroll\PayrollPAYROLLPDFController;
use App\Http\Controllers\Payroll\PayrollPAYSLIPPDFController;
use App\Http\Controllers\Payroll\PayrollBONUSPDFController;
use App\Http\Controllers\Payroll\ApprovalPDFController;
use App\Http\Controllers\Payroll\JsonControllers\PDFJsonController;

Route::prefix('')->group(function () {
    // Payroll PDF ROUTE
    Route::post('/payrollPDF', [PayrollPAYROLLPDFController::class, 'payrollPdf'])->middleware('prevent-back-history');

    // Payslip PDF ROUTE
    Route::post('/payslipPdf', [PayrollPAYSLIPPDFController::class, 'payslipPdf'])->middleware('prevent-back-history');

    //Bonus PDF ROUTE
    Route::get('/bonusPdf', [PayrollBONUSPDFController::class,'bonusPdf'])->middleware('prevent-back-history');

    // Payroll Page JSON ROUTE
    Route::get('/payrollPdfjson', [PDFJsonController::class,'payrollpdf'])->middleware('prevent-back-history');

    //Approval PDF ROUTE
    Route::post('/ApprovalPdf', [ApprovalPDFController::class,'Approval'])->middleware('prevent-back-history');



});
