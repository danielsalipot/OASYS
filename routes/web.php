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
Route::get('/about', [PagesController::class, 'about']);
Route::get('/features', [PagesController::class, 'features']);

//Login routes
Route::get('/login', [PagesController::class, 'login']);
Route::post('crudlogin', [LoginController::class, 'crudlogin']);


//Create User Routes
Route::post('crudsignup', [CrudController::class, 'crudsignup']);
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

//HR Admin Routes
Route::get('/adminhome', [PagesController::class, 'adminhome']);
Route::get('/attendance', [PagesController::class, 'attendance']);
Route::get('/performance', [PagesController::class, 'performance']);
Route::get('/peopleorientation', [PagesController::class, 'peopleorientation']);
Route::get('/moduleorientation', [PagesController::class, 'moduleorientation']);
Route::get('/peopletraining', [PagesController::class, 'peopletraining']);
Route::get('/moduletraining', [PagesController::class, 'moduletraining']);
Route::get('/peoplecorrection', [PagesController::class, 'peoplecorrection']);
Route::get('/modulecorrection', [PagesController::class, 'modulecorrection']);
Route::get('/adminmessage', [PagesController::class, 'adminmessage']);
Route::get('/adminnotification', [PagesController::class, 'adminnotification']);

//HR Staff Routes
Route::get('/staffhome', [PagesController::class, 'staffhome']);
Route::get('/onboarding', [PagesController::class, 'onboarding']);
Route::get('/termination', [PagesController::class, 'termination']);
Route::get('/offboarding', [PagesController::class, 'offboarding']);
Route::get('/schedules', [PagesController::class, 'schedules']);
Route::get('/interview', [PagesController::class, 'interview']);
Route::get('/department', [PagesController::class, 'department']);
Route::get('/position', [PagesController::class, 'position']);
Route::get('/staffmessage', [PagesController::class, 'staffmessage']);
Route::get('/staffnotification', [PagesController::class, 'staffnotification']);


//Employee Routes
Route::get('/employeehome', [PagesController::class, 'employeehome']);
Route::get('/employeeorientation', [PagesController::class, 'employeeorientation']);
Route::get('/employeetraining', [PagesController::class, 'employeetraining']);
Route::get('/employeecorrection', [PagesController::class, 'employeecorrection']);
Route::get('/employeemessage', [PagesController::class, 'employeemessage']);
Route::get('/employeeprofile', [PagesController::class, 'employeeprofile']);


//Applicants Routes
Route::get('/introduce', [PagesController::class, 'introduce']);
Route::get('/signup', [PagesController::class, 'signup']);
Route::get('/application', [PagesController::class, 'application']);
Route::get('/applying', [PagesController::class, 'applying']);
Route::get('/applicanthome', [PagesController::class, 'applicanthome']);

//Logout 
Route::get('/logout', [PagesController::class, 'logout']);

//Test
Route::get('/test', [CrudController::class, 'test']);