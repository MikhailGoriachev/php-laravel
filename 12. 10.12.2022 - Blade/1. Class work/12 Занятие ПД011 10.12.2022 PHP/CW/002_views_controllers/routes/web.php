<?php

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

// Action-синтаксис (не забудьте импортировать класс контроллера)
// действует с Laravel 8.0, подробнее тут
// https://laravel.demiart.ru/target-class-does-not-exist-in-laravel-8/

// путь к действию index контроллера home
Route::get('/home', [ HomeController::class, 'index' ]);

// путь к действию about  контроллера home
Route::get('/home/about', [ HomeController::class, 'about' ]);

// путь к действию directHtml контроллера home
Route::get('/home/direct', [ HomeController::class, 'directHtml' ]);

// путь к действию someValues  контроллера home
Route::get('/home/some_values', [ HomeController::class, 'someValues' ]);

// параметр маршрута для метода действия класса
Route::get('/home/param/{id}', [ HomeController::class, 'getParam' ]);

// пути к отдельным страницам, без контроллеров
Route::get('/', fn() => view('welcome'));
Route::get('/hello', fn() => view('hello'));
