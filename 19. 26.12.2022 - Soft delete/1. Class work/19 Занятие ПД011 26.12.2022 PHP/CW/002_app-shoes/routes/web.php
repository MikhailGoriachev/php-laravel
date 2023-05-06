<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShoesController;
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

Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index']);
Route::get('/home/index', [HomeController::class, 'index']);
Route::get('/about', [HomeController::class, 'about']);

// /shoes/index: вывод всех записей таблицы
Route::get('/shoes/index', [ShoesController::class, 'index']);

// /shoes/create-form: форма с валидацией для добавление пары обуви
Route::get('/shoes/create-form', [ShoesController::class, 'createForm']);

// /shoes/create-handle: обработчик формы добавления пары обуви (с валидацией)
Route::get('/shoes/create-handle', [ShoesController::class, 'createHandle']);

// /shoes/edit/{code}: форма для редактирования пары обуви,
//                    по коду товара
Route::get('/shoes/edit/{code}', [ShoesController::class, 'editForm']);

// /shoes/edit-handle/{code}: обработчик формы для редактирования пары обуви,
//                    по коду товара
Route::get('/shoes/edit-handle/{code}', [ShoesController::class, 'editHandle']);

// /shoes/show/{name}: выводит пары обуви заданного наименования
Route::get('/shoes/show/{name}', [ShoesController::class, 'show']);
