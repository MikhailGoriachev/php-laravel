<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductsController;
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


// сюжетно не важны... но кусть будут, для примера использования маршрута
Route::get('/', [HomeController::class, 'index']);
Route::get('/about', [HomeController::class, 'about']);

// демонстрация операций чтения - выборки данных из таблиц categories, products
Route::get('/read-data', [CategoriesController::class, 'readData']);

// выборка данных из таблицы products
Route::get('/products', [ProductsController::class, 'index']);

// добавление записи в таблицу products
Route::get('/products/insert', [ProductsController::class, 'insert']);

// изменение записи по идентификатору в таблице products
Route::get('/products/update/{id}', [ProductsController::class, 'update']);

// удаление записи по идентификатору в таблице products
Route::get('/products/delete/{id}', [ProductsController::class, 'delete']);
