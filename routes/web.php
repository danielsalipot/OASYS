<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\CrudController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\JsonController;
use App\Http\Controllers\InsertController;
use App\Http\Controllers\UpdateController;


// Employee Routes
Route::prefix('')->group(function () {
    include 'employee.php';
});

// Payroll Routes
Route::prefix('')->group(function () {
    include 'payroll.php';
});

// Applicant Routes
Route::prefix('')->group(function () {
    include 'applicants.php';
});

// Admin Routes
Route::prefix('')->group(function () {
    include 'admin.php';
});

// Staff Routes
Route::prefix('')->group(function () {
    include 'staff.php';
});




Route::get('/payroll1', [JsonController::class,'payroll1']);
Route::get('/test', [LoginController::class,'test']);

                    /////////////////////////
                    //PDF generation ROUTES//
                    /////////////////////////
                            /////////
Route::post('/payrollPDF', [DocumentController::class, 'payrollPdf']);
Route::post('/payslipPdf', [DocumentController::class, 'payslipPdf']);

                //////////////////////////////////////
                //Json Payroll Routes for datatables//
                //////////////////////////////////////
                            //////////////
// Payroll Page JSON ROUTE
Route::get('/payrolljson', [JsonController::class,'payroll']);
Route::get('/payslipjson', [JsonController::class,'payslip']);

//Employee List JSON ROUTE
Route::get('/fetchSingleEmployee', [JsonController::class,'fetchSingleEmployee']);

// Deduction JSON ROUTE
Route::get('/deductionjson', [JsonController::class,'Deduction']);
Route::post('/insertdeduction', [InsertController::class,'InsertDeduction']);
Route::get('/employeedetailsjson', [JsonController::class,'EmployeeDetails']);

//Cash Adavance JSON ROUTE
Route::get('/cashadvancejson', [JsonController::class,'CashAdvance']);
Route::post('/insertcashadvance', [InsertController::class,'InsertCashAdvance']);

// Overtime JSON ROUTE
Route::get('/overtimejson', [JsonController::class,'Overtime']);
Route::get('/insertovertime', [InsertController::class,'InsertOvertime']);
Route::get('/getPaidOvertime', [JsonController::class,'getPaidOvertime']);

// Not yet done ROUTES for payroll
Route::get('/deductiontypejson', [JsonController::class,'DeductionType']);
Route::get('/employeelistjson', [JsonController::class,'EmployeeList']);
Route::get('/messagejson', [JsonController::class,'Message']);
Route::get('/notificationjson', [JsonController::class,'Notification']);
Route::get('/doublepayjson', [JsonController::class,'DoublePay']);
Route::get('/bonusjson', [JsonController::class,'Bonus']);


Route::post('applicant/crudsignup', [CrudController::class, 'crudsignup']);
Route::post('applicant/crudintroduce', [CrudController::class, 'crudintroduce']);
Route::post('applicant/crudapply', [CrudController::class, 'crudapply']);

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

            //////////////////////////
            //Applicant Pages Routes//
            //////////////////////////
                    /////////
// STEP 1 BACKEND ROUTE
Route::post('crudsignup', [CrudController::class, 'crudsignup']);
// STEP 2 BACKEND ROUTE
Route::post('crudintroduce', [CrudController::class, 'crudintroduce']);
// STEP 3 BACKEND ROUTE
Route::post('crudapply', [CrudController::class, 'crudapply']);

//Delete applicant's account
Route::get('deleteApplication', [CrudController::class, 'deleteApplication']);

// Update Controller for updating Employee Rates
Route::post('/editrate', [UpdateController::class, 'editrate']);

//Logout
Route::get('/logout', [PagesController::class, 'logout']);
