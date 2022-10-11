<?php

use App\Http\Controllers\Admin\AdminPDFController;

Route::prefix('')->group(function () {
    Route::GET('/employeeActivityPDF', [AdminPDFController::class, 'employeeActivityPDF'])->middleware('prevent-back-history');
});
