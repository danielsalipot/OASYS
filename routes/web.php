<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PagesController;



Route::get('/test',[PagesController::class,'test']);

Route::get('/display_resume', [PagesController::class, 'display_resume']);


// Employee Routes
Route::prefix('')->group(function () {
    include 'Employee/employee.php';
});
Route::prefix('')->group(function () {
    include 'Employee/insert.php';
});



// Payroll Routes
Route::prefix('')->group(function () {
    include 'Payroll/payroll.php';
});
// Json
Route::prefix('')->group(function () {
    include 'Payroll/JsonRoutes.php';
});
// Insert
Route::prefix('')->group(function () {
    include 'Payroll/InsertRoutes.php';
});
// Delete
Route::prefix('')->group(function () {
    include 'Payroll/DeleteRoutes.php';
});
// Delete
Route::prefix('')->group(function () {
    include 'Payroll/UpdateRoutes.php';
});
// PDF
Route::prefix('')->group(function () {
    include 'Payroll/PDFRoutes.php';
});





// Applicant Routes
Route::prefix('')->group(function () {
    include 'Applicant/applicants.php';
});

Route::prefix('')->group(function () {
    include 'Applicant/SignUpRoutes.php';
});


// Admin Routes
Route::prefix('')->group(function () {
    include 'Admin/admin.php';
});

// Staff Routes
Route::prefix('')->group(function () {
    include 'Staff/staff.php';
});
Route::prefix('')->group(function () {
    include 'Staff/json.php';
});
Route::prefix('')->group(function () {
    include 'Staff/insert.php';
});
Route::prefix('')->group(function () {
    include 'Staff/update.php';
});
Route::prefix('')->group(function () {
    include 'Staff/delete.php';
});


Route::get('/message', [MessageController::class, 'message']);
Route::get('/notification', [MessageController::class, 'notification']);
Route::get('/notification/views', [PagesController::class, 'view_notif']);
Route::get('/sendmessage',[MessageController::class,'InsertMessage']);
Route::post('/sendnotification',[MessageController::class,'InsertNotification']);

Route::get('/notification_acknowledgement_insert', [PagesController::class, 'notification_acknowledgement_insert']);

// Landing Pages
Route::get('/change_picture', [PagesController::class, 'change_picture']);
Route::post('/submit_change_picture', [PagesController::class, 'submit_change_picture']);

                ////////////////////////
                //Landing Pages routes//
                ////////////////////////
                        ///////
// Landing Pages
Route::get('/', [PagesController::class, 'index']);
Route::get('/about', [PagesController::class, 'about']);
Route::get('/features', [PagesController::class, 'features']);

                //////////////////////
                //Login Pages routes//
                //////////////////////
                        //////
//Login routes
Route::get('/login', [PagesController::class, 'login']);
Route::post('crudlogin', [LoginController::class, 'crudlogin']);


//Logout
Route::get('/logout', [PagesController::class, 'logout']);
