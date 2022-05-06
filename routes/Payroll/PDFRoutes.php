<?php

use App\Http\Controllers\Payroll\PayrollPAYROLLPDFController;
use App\Http\Controllers\Payroll\PayrollPAYSLIPPDFController;
use App\Http\Controllers\Payroll\PayrollBONUSPDFController;
use App\Http\Controllers\Payroll\JsonControllers\PDFJsonController;

Route::prefix('')->group(function () {
    // Payroll PDF ROUTE
    Route::post('/payrollPDF', [PayrollPAYROLLPDFController::class, 'payrollPdf']);

    // Payslip PDF ROUTE
    Route::post('/payslipPdf', [PayrollPAYSLIPPDFController::class, 'payslipPdf']);

    //Bonus PDF ROUTE
    Route::get('/bonusPdf', [PayrollBONUSPDFController::class,'bonusPdf']);

    // Payroll Page JSON ROUTE
    Route::get('/payrollPdfjson', [PDFJsonController::class,'payrollpdf']);


});
