<?php

use App\Http\Controllers\CalculateController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WorkersController;
use Illuminate\Support\Facades\Route;

// главная
Route::get('/', [HomeController::class, 'index']);

// о разработчике
Route::get('/about', [HomeController::class, 'about']);

// работники
Route::get('/workers/allData', [WorkersController::class, 'allData']);

// работники с максимальным окладом
Route::get('/workers/selectByMaxSalary', [WorkersController::class, 'selectByMaxSalary']);

// работники с минимальным окладом
Route::get('/workers/selectByMinSalary', [WorkersController::class, 'selectByMinSalary']);

// работники со стажем больше заданного
Route::post('/workers/selectByOverExperience', [WorkersController::class, 'selectByOverExperience']);

// удаление работника
Route::get('/workers/delete/{id?}', [WorkersController::class, 'delete']);

// добавление работника
Route::get('/workers/addForm', [WorkersController::class, 'addForm']);

// добавление работника
Route::post('/workers/add', [WorkersController::class, 'add']);

// форма изменение работника
Route::get('/workers/editForm/{id}', [WorkersController::class, 'editForm']);

// изменение работника
Route::post('/workers/edit', [WorkersController::class, 'edit']);
