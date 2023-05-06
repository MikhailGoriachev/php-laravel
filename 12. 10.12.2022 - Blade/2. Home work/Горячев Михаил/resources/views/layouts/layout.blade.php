<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <base href="/">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- #region Стили -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="lib/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <!-- #endregion -->

    <!-- #region Скрипты -->
    <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- #endregion -->

    <!-- заголовок -->
    <title>@yield('title')</title>

    <!-- логотип -->
    <link rel="shortcut icon" type="image/x-icon" href="images/icon.svg">

    @yield('headers')
</head>
<body>
<nav class="navbar navbar-expand-sm navbar-dark bg-dark sticky-top shadow">
    <div class="container-fluid justify-content-center">

        <!-- Логотип -->
        <a class="navbar-brand mx-2" href="/">
            <img class="logo" src="images/icon.svg" alt="logo">
        </a>

        <div class="collapse navbar-collapse">
            <ul class="navbar-nav">

                <!-- Главная -->
                <li class="nav-item">
                    <a class='nav-link mx-3 {{ ($activeTab ?? '') === "index" ? 'active' : ''}}'
                       href="/">
                        Главная
                    </a>
                </li>

                <!-- Выражения -->
                <li class="nav-item">
                    <a class="nav-link mx-3 {{ ($activeTab ?? '') === "variant13" ? 'active' : ''}}"
                       href="/calculate/variant13">
                        Выражения
                    </a>
                </li>

                <!-- Массивы -->
                <li class="nav-item">
                    <a class="nav-link mx-3 {{ ($activeTab ?? '') === "array17" ? 'active' : ''}}"
                       href="/calculate/array17">
                        Массивы
                    </a>
                </li>

                <!-- Текст -->
                <li class="nav-item">
                    <a class="nav-link mx-3 {{ ($activeTab ?? '') === "text7" ? 'active' : ''}}"
                       href="/calculate/text7">
                        Текст
                    </a>
                </li>

                <!-- О разработчике -->
                <li class="nav-item">
                    <a class="nav-link mx-3 {{ ($activeTab ?? '') === "about" ? 'active' : ''}}"
                       href="/home/about">
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
