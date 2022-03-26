<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\CrudController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\DB;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [PagesController::class, 'index']);

//Login routes
Route::get('/login', [PagesController::class, 'login']);
Route::post('crudlogin', [LoginController::class, 'crudlogin']);


//Create User Routes
Route::post('add', [CrudController::class, 'crudsignup']);
Route::post('crudintroduce', [CrudController::class, 'crudintroduce']);
Route::post('crudapply', [CrudController::class, 'crudapply']);

//Delete applicant's account
Route::get('deleteApplication', [CrudController::class, 'deleteApplication']);

//Payroll Manager Routes
Route::get('/deductiontype', [PagesController::class, 'deductiontype']);
Route::get('/message', [PagesController::class, 'message']);
Route::get('/notification', [PagesController::class, 'notification']);
Route::get('/cashadvance', [PagesController::class, 'cashadvance']);
Route::get('/overtime', [PagesController::class, 'overtime']);
Route::get('/deduction', [PagesController::class, 'deduction']);
Route::get('/employeelist', [PagesController::class, 'employeelist']);
Route::get('/payroll', [PagesController::class, 'payroll']);

//Applicants Routes
Route::get('/introduce', [PagesController::class, 'introduce']);
Route::get('/signup', [PagesController::class, 'signup']);
Route::get('/application', [PagesController::class, 'application']);
Route::get('/applying', [PagesController::class, 'applying']);
Route::get('/applicanthome', [PagesController::class, 'applicanthome']);

//Logout 
Route::get('/logout', [PagesController::class, 'logout']);