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
                    <li>Создание и настройка моделей <b>ORM Eloquent</b></li>
                    <li>Использование моделей в контроллерах для <b>CRUD</b>-операций</li>
                    <li>Создание связей между моделями</li>
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
                    Разработайте приложение Laravel для выполнения запросов к базе данных при помощи <b>ORM Eloquent</b>.
                    Параметры запросов создавайте формами
                </p>

                <table class="table table-bordered bg-white">
                    <tbody>
                    <tr>
                        <td><i>База данных <b>«Прокат автомобилей»</b></i></td>
                    </tr>
                    <tr>
                        <td>
                            <b>Описание предметной области</b><br>
                            Фирма выдает напрокат автомобили. При этом фиксируется информация о клиенте, информация
                            об
                            автомобиле, дата начала проката и количество дней проката. Стоимость одного дня проката
                            является фиксированной для каждого автомобиля. В случае аварии клиент выплачивает фирме
                            возмещение в размере, равном некоторому проценту от страховой стоимости автомобиля. <br>
                            Стоимость проката автомобиля определяется как
                            <b>Стоимость одного дня проката * Количество дней проката</b>. <br>
                            Фирма ежегодно страхует автомобили, выдаваемые клиентам. Страховой взнос, выплачиваемый
                            фирмой, равен 10 процентам от страховой стоимости автомобиля. <br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>
                                <i>
                                    База данных должна включать как минимум таблицы КЛИЕНТЫ, АВТОМОБИЛИ, ПРОКАТ,
                                    содержащие следующую информацию:
                                </i>
                            </b>
                        </td>
                    </tr>
                    <tr>
                        <td>Фамилия клиента</td>
                    </tr>
                    <tr>
                        <td>Имя клиента</td>
                    </tr>
                    <tr>
                        <td>Отчество клиента</td>
                    </tr>
                    <tr>
                        <td>Серия, номер паспорта клиента</td>
                    </tr>
                    <tr>
                        <td>Модель автомобиля</td>
                    </tr>
                    <tr>
                        <td>Цвет автомобиля</td>
                    </tr>
                    <tr>
                        <td>Год выпуска автомобиля</td>
                    </tr>
                    <tr>
                        <td>Госномер автомобиля</td>
                    </tr>
                    <tr>
                        <td>Страховая стоимость автомобиля</td>
                    </tr>
                    <tr>
                        <td>Стоимость одного дня проката</td>
                    </tr>
                    <tr>
                        <td>Дата начала проката</td>
                    </tr>
                    <tr>
                        <td>Количество дней проката</td>
                    </tr>
                    </tbody>
                </table>

                <p>Кроме исходных базовых таблиц база данных должна содержать следующие объекты:</p>

                <table class="table table-bordered bg-white">
                    <thead class="align-middle">
                    <tr>
                        <th colspan="3" class="text-center">Запросы</th>
                    </tr>
                    <tr>
                        <th>Номер запросы</th>
                        <th>Тип запроса</th>
                        <th>Какую задачу решает запрос</th>
                    </tr>
                    </thead>
                    <tbody class="align-middle">
                    <tr>
                        <td>1</td>
                        <td>Хранимая процедура</td>
                        <td>
                            Выбирает информацию об автомобилях, стоимость одного дня проката которых меньше заданной
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Хранимая процедура</td>
                        <td>
                            Выбирает информацию об автомобилях, страховая стоимость которых находится в заданном
                            диапазоне значений
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Хранимая процедура</td>
                        <td>
                            Выбирает информацию о клиентах, серия-номер паспорта которых начинается с заданной
                            параметром цифры. Включает поля <b>Код клиента, Паспорт, Дата начала проката, Количество
                                дней проката, Модель автомобиля</b>
                        </td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Хранимая процедура</td>
                        <td>
                            Выбирает информацию о клиентах, бравших автомобиль напрокат в некоторый определенный день.
                        </td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Хранимая процедура</td>
                        <td>
                            Выбирает информацию об автомобилях, для которых значение в поле <b>Страховая стоимость</b>
                            автомобиля попадает в некоторый заданный интервал.
                        </td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>Хранимая процедура</td>
                        <td>
                            Вычисляет для каждого автомобиля величину выплачиваемого страхового взноса. Включает поля
                            <b>Госномер автомобиля, Модель автомобиля, Год выпуска автомобиля, Страховая стоимость
                                автомобиля, Страховой взнос</b>. Сортировка по полю <b>Год выпуска автомобиля</b>
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td>Запрос на добавление</td>
                        <td>Добавить факт проката автомобиля</td>
                    </tr>
                    <tr>
                        <td>8</td>
                        <td>Запрос на изменение</td>
                        <td>Измените длительность выбранного факта проката автомобиля</td>
                    </tr>
                    <tr>
                        <td>9</td>
                        <td>Запрос на удаление</td>
                        <td>Удалите выбранный факт проката автомобиля</td>
                    </tr>
                    </tbody>
                </table>
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
                        <a href="https://cloud.mail.ru/public/2obU/WWkT7vtbh" target="_blank">по этой ссылке</a>.
                    </p>
                </div>
            </div>
        </div>
        <!-- #endregion -->
    </section>

@endsection
