<?php

use App\Http\Controllers\Payroll\PayrollUpdateController;

Route::prefix('')->group(function () {
    // SSS UPDATE ROUTE
    Route::post('/edit_sss', [PayrollUpdateController::class, 'edit_sss']);

    // Philhealth UPDATE ROUTE
    Route::post('/edit_pagibig', [PayrollUpdateController::class, 'edit_pagibig']);

    // Philhealth UPDATE ROUTE
    Route::post('/edit_philhealth', [PayrollUpdateController::class, 'edit_philhealth']);

    // Employee Rate UPDATE ROUTE
    Route::post('/editrate', [PayrollUpdateController::class, 'editrate']);
    Route::post('/editleave', [PayrollUpdateController::class, 'editleave']);

    // overtime deny UPDATE ROUTE
    Route::post('/updateDenyOvertime', [PayrollUpdateController::class, 'updateDenyOvertime']);
    Route::post('/updateRecoverApproval', [PayrollUpdateController::class, 'updateRecoverApproval']);

    Route::post('/updateApprovalLeave', [PayrollUpdateController::class, 'updateApprovalLeave']);
    Route::post('/updateRecoverLeave', [PayrollUpdateController::class, 'updateRecoverLeave']);

    Route::post('/updateContributionInclude', [PayrollUpdateController::class, 'updateContributionInclude']);
    Route::post('/updateApprovalLeaveCashout', [PayrollUpdateController::class, 'updateApprovalLeaveCashout']);
});
