<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RedirectDemoController;
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

// --------------------------------------------------------------------------------------------

// сюжетно не важны... но кусть будут, для примера использования маршрута
Route::get('/', [HomeController::class, 'index']);
Route::get('/about', [HomeController::class, 'about']);

// --------------------------------------------------------------------------------------------

// вывод страницы с кнопками для выброса исключений
Route::get('/error-generator', [\App\Http\Controllers\ErrorGeneratorController::class, 'index']);
Route::get('/error-generator/index', [\App\Http\Controllers\ErrorGeneratorController::class, 'index']);

// переход на генерацию исключения для примера стандартной обработки
Route::get('/error-generator/standard-handling',
    [\App\Http\Controllers\ErrorGeneratorController::class, 'standardHandling']);

// переход на генерацию исключения для примера пользовательской обработки
Route::get('/error-generator/custom-handling',
    [\App\Http\Controllers\ErrorGeneratorController::class, 'customHandling']);

// переход на генерацию исключения HTTP для стандартной обработки
Route::get('/error-generator/http-standard-handling',
    [\App\Http\Controllers\ErrorGeneratorController::class, 'httpStandardHandling']);

// переход на генерацию исключения HTTP для пользовательской обработки
Route::get('/error-generator/http-custom-handling',
    [\App\Http\Controllers\ErrorGeneratorController::class, 'httpCustomHandling']);


// --------------------------------------------------------------------------------------------
// вывод страницы с кнопками для демонстрации редиректа
Route::get('/redirect-demo', [RedirectDemoController::class, 'index']);
Route::get('/redirect-demo/index', [RedirectDemoController::class, 'index']);

// демонстрация редиректа по маршруту
Route::get('/redirect-demo/redirect1', [RedirectDemoController::class, 'redirect1']);

// демонстрация редиректа на метод действия
Route::get('/redirect-demo/redirect2', [RedirectDemoController::class, 'redirect2']);

// прямой маршрут на страницу
Route::get('/redirect-demo/handler/{param}', [RedirectDemoController::class, 'handler']);
