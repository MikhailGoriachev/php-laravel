<?php

require_once "SessionManager.php";

// функция для определения активной вкладки
function activeClass(string $activeTab, string $linkName): string
{
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
                    <a class='nav-link mx-3 <?= activeClass($activeTab, "index")?>' href="../index.php">
                        Главная
                    </a>
                </li>
                
                <!-- Задание 1 -->
                <li class="nav-item">
                    <a class="nav-link mx-3 <?= activeClass($activeTab, "task01Page") ?>" 
                    href="../pages/task01/inputForm.php">
                    Фигуры
                    </a>
                </li>

                <!-- Задание 2 -->
                <li class="nav-item">
                    <a class="nav-link mx-3 <?= activeClass($activeTab, "task02Page") ?>" href="../pages/task02Page.php">
                    Файл
                    </a>
                </li>

                <!-- Задание 3 -->
                <li class="nav-item">
                    <a class="nav-link mx-3 <?= activeClass($activeTab, "task03Page") ?>" href="../pages/task03Page.php">
                    Планеты
                    </a>
                </li>

                <!-- Вход -->
                <li class="nav-item">
                    <?php if (SessionManager::IsLogged()) { ?>
                    <form method="post">
                        <button type="submit" class="btn btn-warning mx-3" name="login" value="out">
                            Выход
                        </button>
                    </form>
                    <?php } else { ?>
                    <form method="post">
                        <button type="submit" class="btn btn-success mx-3" name="login" value="in">
                            Вход
                        </button>
                    </form>
                    <?php } ?>
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