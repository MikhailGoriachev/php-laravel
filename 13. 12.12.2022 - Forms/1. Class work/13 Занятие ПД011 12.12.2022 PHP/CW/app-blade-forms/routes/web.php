<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;


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

Route::get('/', [HomeController::class, 'index']);
Route::get('/home/about', [HomeController::class, 'about']);

// --------------------------------- GET ----------------------------

// отображение формы по /form1
Route::get('/form1', [PostController::class, 'form1']);

// обработка формы, отображенной по /form1
Route::get('/handle1', [PostController::class, 'handle1']);
// отображение формы по /form1

// --------------------------------- POST ----------------------------

// отображение формы по /form2
Route::get('/form2', [PostController::class, 'form2']);

// обработка формы, отображенной по /form2
Route::post('/handle2/{id?}', [PostController::class, 'handle2']);


