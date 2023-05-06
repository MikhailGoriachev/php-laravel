<?php

use App\Http\Controllers\FileOperationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PersonController;
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

// сюжетно не важны...
Route::get('/', [HomeController::class, 'index']);
Route::get('/about', [HomeController::class, 'about']);

// примеры на работу с файлами
Route::get('/write', [FileOperationController::class, 'write']);
Route::get('/read', [FileOperationController::class, 'read']);

// ---------------------------- 17/12/2022 ----------------------------------------

// загрузка файла на сервер
Route::get('/upload-file', [FileOperationController::class, 'uploadFile']);
Route::post('/handle-upload-file', [FileOperationController::class, 'upload']);

// скачаивание файла  с сервера
Route::get('/download-file', [FileOperationController::class, 'downloadFile']);

// ------------------------------------------------------------------------------------

// примеры на работу с моделью и файлами
Route::get('/person', [PersonController::class, 'demo']);

// вывод формы добавления объекта класса Person
Route::get('/add-person', [PersonController::class, 'getAddPerson']);

// обработка формы добавления объекта класса Person
Route::post('/handle-add-person', [PersonController::class, 'handleAddPerson']);
