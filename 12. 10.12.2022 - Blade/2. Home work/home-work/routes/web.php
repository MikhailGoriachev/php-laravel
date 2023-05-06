<?php

use App\Http\Controllers\CalculateController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

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

// главная
Route::get('/', [HomeController::class, 'index']);

// о разработчике
Route::get('/home/about', [HomeController::class, 'about']);

// выржения
Route::get('/calculate/variant13', [CalculateController::class, 'variant13']);

// массивы
Route::get('/calculate/array17', [CalculateController::class, 'array17']);

// текст
Route::get('/calculate/text7', [CalculateController::class, 'text7']);
