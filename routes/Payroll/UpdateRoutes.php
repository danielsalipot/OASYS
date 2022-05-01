<?php

use App\Http\Controllers\Payroll\PayrollUpdateController;

Route::prefix('')->group(function () {
    // SSS UPDATE ROUTE
    Route::post('/edit_sss', [PayrollUpdateController::class, 'edit_sss']);

    // Employee Rate UPDATE ROUTE
    Route::post('/editrate', [PayrollUpdateController::class, 'editrate']);

});
