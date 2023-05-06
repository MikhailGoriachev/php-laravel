<?php

use App\Http\Controllers\CarRentalsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShoesController;
use Illuminate\Support\Facades\Route;

// главная
Route::redirect('/', 'home/index');
Route::get('/home/index', [HomeController::class, 'index']);

// о разработчике
Route::get('/about', [HomeController::class, 'about']);


#region Таблицы

// обувь
Route::get('/shoes/index', [ShoesController::class, 'shoes']);
Route::redirect('/tables/shoes', '/shoes/index');

// выборка обуви по типу
Route::post('/shoes/show', [ShoesController::class, 'show']);

// производители
Route::get('/tables/manufactures', [ShoesController::class, 'manufactures']);

// типы обуви
Route::get('/tables/shoes-types', [ShoesController::class, 'shoesTypes']);

#endregion


#region CRUD

// добавление обуви
Route::get('/shoes/create', [ShoesController::class, 'createShoesForm']);
Route::post('/shoes/create', [ShoesController::class, 'createShoes']);

// редактирование обуви
Route::get('/shoes/edit/{code}', [ShoesController::class, 'editShoesForm']);
Route::post('/shoes/edit', [ShoesController::class, 'editShoes']);

// удаление обуви
Route::get('/shoes/delete/{code}', [ShoesController::class, 'deleteShoes']);

#endregion
