<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\PagesController;



Route::get('/test/{x}/{y}',[PagesController::class,'test']);

// Employee Routes
Route::prefix('')->group(function () {
    include 'Employee/employee.php';
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
