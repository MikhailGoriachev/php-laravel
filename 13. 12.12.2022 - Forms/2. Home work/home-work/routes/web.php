<?php

use App\Http\Controllers\CalculateController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// главная
Route::get('/', [HomeController::class, 'index']);

// о разработчике
Route::get('/about', [HomeController::class, 'about']);

// форма для ввода данных выражений
Route::get('/evaluateForm/{a?}/{b?}/{m?}/{n?}', [CalculateController::class, 'evaluateForm']);

// выражения
Route::post('/evaluate', [CalculateController::class, 'evaluate']);

// форма для ввода данных массива
Route::get('/arrayForm/{min?}/{max?}', [CalculateController::class, 'arrayForm']);

// массивы
Route::post('/array/{n?}', [CalculateController::class, 'array']);

// форма для ввода данных текста
Route::get('/textForm/{text?}/{length?}', [CalculateController::class, 'textForm']);

// текст
Route::post('/text', [CalculateController::class, 'text']);
