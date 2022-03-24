<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\CrudController;


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
Route::get('/login', [PagesController::class, 'login']);

//Applicants Routes
Route::get('/signup', [PagesController::class, 'signup']);
Route::get('/application', [PagesController::class, 'application']);
<<<<<<< HEAD
Route::get('/user', [CrudController::class, 'index']);
Route::post('add',[CrudController::class, 'add']);
=======
Route::get('/introduce', [PagesController::class, 'introduce']);
Route::get('/applying', [PagesController::class, 'applying']);
Route::get('/applicanthome', [PagesController::class, 'applicanthome']);
>>>>>>> 5eaf0a1ff6ce106888ac813446f773e2af67f5d6
