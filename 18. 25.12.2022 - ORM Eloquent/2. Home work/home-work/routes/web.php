<?php

use App\Http\Controllers\CarRentalsController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// главная
Route::get('/', [HomeController::class, 'index']);

// о разработчике
Route::get('/about', [HomeController::class, 'about']);

#region Таблицы

// модели
Route::get('/tables/brands', [CarRentalsController::class, 'brands']);

// цвета
Route::get('/tables/colors', [CarRentalsController::class, 'colors']);

// клиенты
Route::get('/tables/clients', [CarRentalsController::class, 'clients']);

// автомобили
Route::get('/tables/cars', [CarRentalsController::class, 'cars']);

// прокаты
Route::get('/tables/rentals', [CarRentalsController::class, 'rentals']);

#endregion

#region Запросы

// запрос 1
Route::get('/queries/query01', [CarRentalsController::class, 'query01Form']);
Route::post('/queries/query01', [CarRentalsController::class, 'query01']);

// запрос 2
Route::get('/queries/query02', [CarRentalsController::class, 'query02Form']);
Route::post('/queries/query02', [CarRentalsController::class, 'query02']);

// запрос 3
Route::get('/queries/query03', [CarRentalsController::class, 'query03Form']);
Route::post('/queries/query03', [CarRentalsController::class, 'query03']);

// запрос 4
Route::get('/queries/query04', [CarRentalsController::class, 'query04Form']);
Route::post('/queries/query04', [CarRentalsController::class, 'query04']);

// запрос 5
Route::get('/queries/query05', [CarRentalsController::class, 'query05Form']);
Route::post('/queries/query05', [CarRentalsController::class, 'query05']);

// запрос 6
Route::get('/queries/query06', [CarRentalsController::class, 'query06']);

#endergion

#region CRUD

// добавление прокат
Route::get('add/rental', [CarRentalsController::class, 'addRentalForm']);
Route::post('add/rental', [CarRentalsController::class, 'addRental']);

// изменение проката
Route::get('edit/rental/{id}', [CarRentalsController::class, 'editRentalForm']);
Route::post('edit/rental', [CarRentalsController::class, 'editRental']);

// удаление проката
Route::get('remove/rental/{id}', [CarRentalsController::class, 'removeRental']);

#endregion
