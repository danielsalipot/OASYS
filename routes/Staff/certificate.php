<?php

use App\Http\Controllers\Staff\CertificateController;

Route::prefix('')->group(function () {
    Route::get('/employmentCertificate', [CertificateController::class, 'employmentCertificate']);
    Route::get('/certificate/employment/{id}', [CertificateController::class, 'coeDisplay']);
});
