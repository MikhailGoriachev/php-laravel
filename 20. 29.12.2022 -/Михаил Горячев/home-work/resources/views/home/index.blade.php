﻿@extends('layouts/layout')

@section('title', 'Главная')

@section('indexActive', 'active')

@section('content')
    <section class="mx-5 my-4 bg-light shadow-sm border rounded-3 min-vh-100 p-3">
        <div>
            <button class="btn btn-outline-primary my-2" data-bs-toggle="collapse" href="#collapseTheory" role="button"
                    aria-expanded="false"
                    aria-controls="collapseTheory">
                <span class="h5">Теоретическая часть</span>
            </button>
            <div class="collapse show" id="collapseTheory">
                <ul>
                    <li>Обработка исключений в Laravel</li>
                    <li>Создание пользовательских представлений для обработчиков исключений</li>
                    <li>Обработка стандартных состояний ошибок HTTP</li>
                    <li>Редирект на маршрут</li>
                    <li>Редирект на метод действия контроллера</li>
                </ul>
            </div>
        </div>
        <!-- #endregion -->

        <!-- #region Практическая часть -->
        <div>
            <button class="btn btn-outline-primary my-2" data-bs-toggle="collapse" href="#collapsePractice"
                    role="button" aria-expanded="false"
                    aria-controls="collapsePractice">
                <span class="h5">Практическая часть</span>
            </button>

            <div class="collapse show" id="collapsePractice">

                <!-- #region Задание 1 -->
                <p>
                    <b>Задание 1 (итоговое по PHP).</b> Разработайте приложение <b>Видеотека</b> на PHP (фреймворк
                    Laravel и система управления базами данных (СУБД) MySQL). В базе данных (БД) хранится информация о
                    домашней видеотеке: фильмы, актеры, режиссеры. Разработайте миграции, контроллеры и представления.
                    Требуется добавлять данные режиссеров и фильмов в базу данных при помощи форм (с валидацией).
                    Реализуйте мягкое удаление сведений о фильмах.
                </p>

                <p>Для фильмов необходимо хранить:</p>

                <ul>
                    <li>название;</li>
                    <li>сведения о режиссере (принимаем, что у фильма только один режиссер – братья/сестры Вачевски
                        будут проходить, как одна запись 😊);
                    </li>
                    <li>дату выхода;</li>
                    <li>жанр фильма;</li>
                    <li>бюджет фильма;</li>
                    <li>картинку – афишу фильма (картинку хранить в каталоге хранилища файлов приложения, загружать на
                        сервер, при загрузке новой картинки старая удаляется)
                    </li>
                    <li>страну, в которой выпущен фильм.</li>
                </ul>

                <p>Для режиссеров необходимо хранить:</p>

                <ul>
                    <li>фамилию;</li>
                    <li>имя;</li>
                    <li>отчество;</li>
                    <li>
                        фото режиссера (хранить в каталоге хранилища файлов приложения, загружать на сервер, при
                        загрузке нового фото старое удаляется);
                    </li>
                    <li>дату рождения.</li>
                </ul>

                <p>
                    Структура базы данных – по Вашему выбору. Выводите фильмы в виде карточек на главной странице.
                    Предусмотрите страницы для:
                </p>

                <ul>
                    <li>добавления, редактирования и удаления сведений о фильмах (реализуйте табличное представление
                        фильмов)
                    </li>
                    <li>добавления и редактирования сведений о режиссерах (реализуйте вывод режиссеров на карточках)
                    </li>
                    <li>
                        выполнения запросов и вывода их результатов:
                        <ul>
                            <li>все жанры и фильмы этих жанров.</li>
                            <li>фильмы, вышедшие на экран в текущем и прошлом году.</li>
                            <li>вывести все фильмы, дата выхода которых была более заданного числа лет назад.</li>
                            <li>режиссеры, снимавшие фильмы заданного жанра.</li>
                            <li>вывести режиссеров из заданной страны.</li>
                            <li>вывести всех режиссеров и количество фильмов, которые они снимали.</li>
                        </ul>
                    </li>
                    <li>
                        выгрузки всех таблиц в файлы в формате JSON в папку хранилища файлов приложения
                    </li>
                    <li>
                        очистки всех таблиц и загрузка данных в таблицы из файлов в формате JSON из папки хранилища
                        файлов приложения
                    </li>
                </ul>
                <!-- #endregion -->
            </div>
        </div>
        <!-- #endregion -->

        <!-- #region Дополнительно -->
        <div>
            <div>
                <button class="btn btn-outline-primary my-2" data-bs-toggle="collapse" href="#collapseAdditionally"
                        role="button" aria-expanded="false"
                        aria-controls="collapseAdditionally">
                    <span class="h5">Дополнительно</span>
                </button>

                <div class="collapse show" id="collapseAdditionally">
                    <p>
                        Материалы занятия и задачник – в этом же архиве. Запись занятия можно скачать
                        <a href="https://cloud.mail.ru/public/6EYU/x3iFfUXbV" target="_blank">по этой ссылке</a>.
                    </p>
                </div>
            </div>
        </div>
        <!-- #endregion -->
    </section>

@endsection
