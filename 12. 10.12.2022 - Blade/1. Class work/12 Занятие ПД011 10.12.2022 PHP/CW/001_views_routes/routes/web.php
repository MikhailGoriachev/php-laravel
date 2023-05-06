<?php

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

// стандартный маршрут, возвращающий представление welcome.blade.php
Route::get('/', function () {
    return view('welcome');
});

// маршрут, возвращающий строку
Route::get('/hello', function() {
    return "Привет, Laravel";
});

// еще маршрут, возвращающий строку
Route::get('/hallo', fn() => "Еще привет, Laravel. Это лямбда-выражение");

// маршрут, возвращающий представление hi.blade.php
Route::get('/hi', fn() => view('hi'));

// введение в парамтеры маршрутов
// Один параметр, обязательный, совпадение имн параметров - не обязательно
Route::get('/test/{name}', fn($name) => "Получено имя: $name");

// Более одного параметра, обязательных, совпадение имн параметров - не обязательно
Route::get('/test/{name}/{age}', fn($name, $age) => "Получено имя: $name, возраст: $age");

// Более одного параметра, два обязательных, третий не обязательный; совпадение имн параметров - не обязательно
// не забвываем значения по умолчанию для необязатеьных параметров
Route::get('/employee/{name}/{age}/{salary?}', fn($name, $age, $salary=23000) => "Получено имя: $name, возраст: $age, оклад: $salary");
