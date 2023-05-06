<?php

// функция для определения активной вкладки
function activeClass(string $activeTab, string $linkName): string {
    return $linkName === $activeTab ? "active" : "";
}

$activeTab = $activeTab ?? '';
$title = $title ?? '';
$htmlBody = $htmlBody ?? '';

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <base href="/">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- #region Стили -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../lib/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../styles/styles.css">
    <!-- #endregion -->

    <!-- #region Скрипты -->
    <script src="../lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- #endregion -->

    <!-- заголовок -->
    <title><?= $title ?></title>

    <!-- логотип -->
    <link rel="shortcut icon" type="image/x-icon" href="../images/icon.svg">
</head>
<body>
<nav class="navbar navbar-expand-sm navbar-dark bg-dark sticky-top shadow">
    <div class="container-fluid justify-content-center">

        <!-- Логотип -->
        <a class="navbar-brand mx-2" href="../index.php">
            <img class="logo" src="../images/icon.svg" alt="logo">
        </a>

        <div class="collapse navbar-collapse">
            <ul class="navbar-nav">

                <!-- Главная -->
                <li class="nav-item">
                    <a class='nav-link mx-3 <?= activeClass($activeTab, "index") ?>'
                       href="../index.php">
                        Главная
                    </a>
                </li>

                <!-- Задание 1. Таблицы -->
                <li class="nav-item dropdown">
                    <a class="nav-link mx-3 dropdown-toggle <?= activeClass($activeTab, "task01Tables") ?>"
                       role="button" data-bs-toggle="dropdown" aria-expanded="false" href="#">
                        Задание 1. Таблицы
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark">
                        <li><a class="dropdown-item" href="../pages/task01/tables/brands.php">Модели</a></li>
                        <li><a class="dropdown-item" href="../pages/task01/tables/colors.php">Цвета</a></li>
                        <li><a class="dropdown-item" href="../pages/task01/tables/cars.php">Автомобили</a></li>
                        <li><a class="dropdown-item" href="../pages/task01/tables/clients.php">Клиенты</a></li>
                        <li><a class="dropdown-item" href="../pages/task01/tables/rentals.php">Аренды</a></li>
                    </ul>
                </li>
                
                <!-- Задание 1. Запросы -->
                <li class="nav-item dropdown">
                    <a class="nav-link mx-3 dropdown-toggle <?= activeClass($activeTab, "task01Queries") ?>"
                       role="button" data-bs-toggle="dropdown" aria-expanded="false" href="#">
                        Задание 1. Запросы
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark">
                        <li><a class="dropdown-item" href="../pages/task01/queries/query01.php">Запрос 01</a></li>
                        <li><a class="dropdown-item" href="../pages/task01/queries/query02.php">Запрос 02</a></li>
                        <li><a class="dropdown-item" href="../pages/task01/queries/query03.php">Запрос 03</a></li>
                        <li><a class="dropdown-item" href="../pages/task01/queries/query04.php">Запрос 04</a></li>
                        <li><a class="dropdown-item" href="../pages/task01/queries/query05.php">Запрос 05</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="../pages/task01/queries/query06.php">Запрос 06</a></li>
                        <li><a class="dropdown-item" href="../pages/task01/queries/query07.php">Запрос 07</a></li>
                    </ul>
                </li>
                <!-- Задание 2. Таблицы -->
                <li class="nav-item dropdown">
                    <a class="nav-link mx-3 dropdown-toggle <?= activeClass($activeTab, "task02Tables") ?>"
                       role="button" data-bs-toggle="dropdown" aria-expanded="false" href="#">
                        Задание 2. Таблицы
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark">
                        <li><a class="dropdown-item" href="../pages/task02/tables/people.php">Персоны</a></li>
                        <li><a class="dropdown-item" href="../pages/task02/tables/students.php">Студенты</a></li>
                        <li><a class="dropdown-item" href="../pages/task02/tables/examiners.php">Экзаменаторы</a></li>
                        <li><a class="dropdown-item" href="../pages/task02/tables/academicSubjects.php">Учебные предметы</a></li>
                        <li><a class="dropdown-item" href="../pages/task02/tables/examTypes.php">Типы экзаменов</a></li>
                        <li><a class="dropdown-item" href="../pages/task02/tables/exams.php">Экзамены</a></li>
                    </ul>
                </li>
                
                <!-- Задание 2. Запросы -->
                <li class="nav-item dropdown">
                    <a class="nav-link mx-3 dropdown-toggle <?= activeClass($activeTab, "task02Queries") ?>"
                       role="button" data-bs-toggle="dropdown" aria-expanded="false" href="#">
                        Задание 2. Запросы
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark">
                        <li><a class="dropdown-item" href="../pages/task02/queries/query01.php">Запрос 01</a></li>
                        <li><a class="dropdown-item" href="../pages/task02/queries/query02.php">Запрос 02</a></li>
                        <li><a class="dropdown-item" href="../pages/task02/queries/query03.php">Запрос 03</a></li>
                        <li><a class="dropdown-item" href="../pages/task02/queries/query04.php">Запрос 04</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="../pages/task02/queries/query05.php">Запрос 05</a></li>
                        <li><a class="dropdown-item" href="../pages/task02/queries/query06.php">Запрос 06</a></li>
                        <li><a class="dropdown-item" href="../pages/task02/queries/query07.php">Запрос 07</a></li>
                        <li><a class="dropdown-item" href="../pages/task02/queries/query08.php">Запрос 08</a></li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</nav>

<?php echo $htmlBody ?>

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