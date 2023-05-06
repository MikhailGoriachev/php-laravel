<?php

use App\Http\Controllers\FilmsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShoesController;
use Illuminate\Support\Facades\Route;

// главная
Route::redirect('/', 'home/index');
Route::redirect('/home/index', '/tables/films/true');
//Route::get('/home/index', [HomeController::class, 'index']);

// о разработчике
Route::get('/about', [HomeController::class, 'about']);


#region Таблицы

// фильмы
Route::get('/tables/films/{isTitles?}', [FilmsController::class, 'films']);

// жанры
Route::get('/tables/genres', [FilmsController::class, 'genres']);

// режиссёры
Route::get('/tables/producers', [FilmsController::class, 'producers']);

// страны
Route::get('/tables/countries', [FilmsController::class, 'countries']);

#endregion


#region CRUD

// добавление режиссёра
Route::get('/add/producer', [FilmsController::class, 'addProducerForm']);
Route::post('/add/producer', [FilmsController::class, 'addProducer']);

// редактирование режиссёра
Route::get('/edit/producer/{id}', [FilmsController::class, 'editProducerForm']);
Route::post('/edit/producer', [FilmsController::class, 'editProducer']);

// удаление режиссёра
Route::get('/delete/producer/{id}', [FilmsController::class, 'removeProducer']);

// добавление фильма
Route::get('/add/film', [FilmsController::class, 'addFilmForm']);
Route::post('/add/film', [FilmsController::class, 'addFilm']);

// редактирование фильма
Route::get('/edit/film/{id}', [FilmsController::class, 'editFilmForm']);
Route::post('/edit/film', [FilmsController::class, 'editFilm']);

// удаление фильма
Route::get('/delete/film/{id}', [FilmsController::class, 'removeFilm']);

#endregion


#region Фильтры

// фильмы, вышедшие на экран в текущем и прошлом году
Route::get('/tables/films/by-current-and-last-year', [FilmsController::class, 'filmsByCurrentAndLastYear']);

// фильмы, дата выхода которых была более заданного числа лет наза
Route::post('/tables/films/by-over-years-last', [FilmsController::class, 'filmsByOverYearsLast']);

// режиссеры, снимавшие фильмы заданного жанра
Route::post('/tables/producers/by-genre', [FilmsController::class, 'producersByGenre']);

// режиссеры, снимавшие фильмы заданного жанра
Route::post('/tables/producers/by-country', [FilmsController::class, 'producersByCountry']);

#endregion

// загрузить данные на сервер
Route::get('/tables/upload-data', [FilmsController::class, 'uploadDataForm']);
Route::post('/tables/upload-data', [FilmsController::class, 'uploadData']);

// скачать данные с сервера
Route::get('/tables/download-data', [FilmsController::class, 'downloadData']);
