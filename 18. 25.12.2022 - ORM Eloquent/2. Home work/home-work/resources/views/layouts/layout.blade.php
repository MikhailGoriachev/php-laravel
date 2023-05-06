<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <base href="/">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- #region Стили -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('lib/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <!-- #endregion -->

    <!-- #region Скрипты -->
    <script src="{{ asset('lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- #endregion -->

    <!-- заголовок -->
    <title>@yield('title')</title>

    <!-- логотип -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/icon.svg') }}">

    @yield('headers')
</head>
<body>
<nav class="navbar navbar-expand-sm navbar-dark bg-dark sticky-top shadow">
    <div class="container-fluid justify-content-center">

        <!-- Логотип -->
        <a class="navbar-brand mx-2" href="/">
            <img class="logo" src="{{ asset('images/icon.svg')}}" alt="logo">
        </a>

        <div class="collapse navbar-collapse">
            <ul class="navbar-nav">

                <!-- Главная -->
                <li class="nav-item">
                    <a class='nav-link mx-3 @yield('indexActive')'
                       href="/">
                        Главная
                    </a>
                </li>

                <!-- Задание 1. Таблицы -->
                <li class="nav-item dropdown">
                    <a class="nav-link mx-3 dropdown-toggle @yield('tablesActive')"
                       role="button" data-bs-toggle="dropdown" aria-expanded="false" href="#">
                        Задание 1. Таблицы
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark">
                        <li><a class="dropdown-item" href="/tables/brands">Модели</a></li>
                        <li><a class="dropdown-item" href="/tables/colors">Цвета</a></li>
                        <li><a class="dropdown-item" href="/tables/cars">Автомобили</a></li>
                        <li><a class="dropdown-item" href="/tables/clients">Клиенты</a></li>
                        <li><a class="dropdown-item" href="/tables/rentals">Аренды</a></li>
                    </ul>
                </li>

                <!-- Задание 1. Запросы -->
                <li class="nav-item dropdown">
                    <a class="nav-link mx-3 dropdown-toggle @yield('queriesActive')"
                       role="button" data-bs-toggle="dropdown" aria-expanded="false" href="#">
                        Задание 1. Запросы
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark">
                        <li><a class="dropdown-item" href="/queries/query01">Запрос 01</a></li>
                        <li><a class="dropdown-item" href="/queries/query02">Запрос 02</a></li>
                        <li><a class="dropdown-item" href="/queries/query03">Запрос 03</a></li>
                        <li><a class="dropdown-item" href="/queries/query04">Запрос 04</a></li>
                        <li><a class="dropdown-item" href="/queries/query05">Запрос 05</a></li>
                        <li><a class="dropdown-item" href="/queries/query06">Запрос 06</a></li>
                    </ul>
                </li>

                <!-- О разработчике -->
                <li class="nav-item">
                    <a class="nav-link mx-3 @yield('aboutActive')"
                       href="/about">
                        О разработчике
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

@yield('content')

<footer class="bg-dark shadow fs-6 text-white-50 p-5 pb-2">
    <p>
        Разработчик:
        <a href="https://github.com/MikhailGoriachev" target="_bank">
            <b>Горячев Михаил</b>
        </a>
    </p>
    <p>Группа: <b>ПД011</b></p>
    <p>Город: <b>Донецк</b></p>
    <p>Год создания: <b>2022</b></p>
    <p>
        Поддержка:
        <a href="mailto:goriachevmichael@gmail.com">
            <b>goriachevmichael@gmail.com</b>
        </a>
    </p>

</footer>
</body>
</html>
