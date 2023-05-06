<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8" http-equiv="refresh" />
    <title>PDO - доступ к базам данных</title>
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>
    <h3>Работаем с хранимыми процедурами</h3>
    <?php
        // используем класс Planet из пространства имен Models
        use Models\Planet;
        spl_autoload_register();

        //      драйвер:host=имяИмяхост;port=портMySql;dbname=имяБазыДанных;charset=имяКодировки
        $dsn = "mysql:host=localhost;port=3306;dbname=solar_system;charset=utf8";

        // параметры PDO - обработка ошибок, вид получаемых данных
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];


        // создание PDO объекта
        $pdo = new PDO($dsn, 'root', '___sP123456890...', $options);

        // обычные, явные запросы - параметры через переменные в теле запроса
        echo "<h3>query(), exec(): Планеты с буквой 'e' в названии</h3>";
        $reg_expression_name = 'e';
        $stmt = $pdo->query("call planets('{$reg_expression_name}')");

        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Models\Planet');
        while ($row = $stmt->fetch()) {
            echo "{$row->getName()} | {$row->getColor()}";
            echo "<br/>";
        }
        echo "<br/>";


        // далее будем использовать функцию для вывода результатов запроса

        // создать запрос и передать ему именованный параметр
        $stmt = $pdo->prepare("call planets(:planet_reg_exp)");
        $reg_expression_name = 'a';
        $stmt->bindParam(':planet_reg_exp', $reg_expression_name, PDO::PARAM_STR);
        $stmt->execute();

        // показать результаты
        $title = "<h3>prepare(): Планеты с буквой '{$reg_expression_name}' в названии</h3>";
        viewPlanets($title, $stmt);
        echo "<br/>";

        // повторное выполнение запроса - просто меняем значение привязанной к параметру
        // запроса переменной
        $reg_expression_name = 's';
        $stmt->execute();

        // показать результаты
        $title = "<h3>prepare(): Планеты с буквой '{$reg_expression_name}' в названии</h3>";
        viewPlanets($title, $stmt);
        echo "<br/>";
    ?>

    <hr/>

    <?php

    // подключение конфигурационного файла
    require_once 'db_config.php';

    // создание PDO объекта
    $pdo = new PDO($dsn, $user, $password, $options);

    // создать запрос и передать ему именованный параметр
    $stmt = $pdo->prepare("call planets(:planet_reg_exp)");
    $reg_expression_name = 'u';
    $stmt->bindParam(':planet_reg_exp', $reg_expression_name, PDO::PARAM_STR);
    $stmt->execute();

    // показать результаты
    $title = "<h3>prepare(): Планеты с буквой '{$reg_expression_name}' в названии</h3>";
    viewPlanets($title, $stmt);
    echo "<hr/>";

    // повторное использование запроса
    $reg_expression_name = 't';
    $stmt->execute();
    $title = "<h3>prepare(): Планеты с буквой '{$reg_expression_name}' в названии</h3>";
    viewPlanets($title, $stmt);

    // ------------------------------------------------------------------------
    //
    // выводим выборку запроса
    function viewPlanets($title, $stmt): void {
        // настроить режим вывода результата
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Models\Planet');

        echo $title;
        echo "<table><tr><th>Planet name</th><th>Planet color</th></tr>";
        while ($row = $stmt->fetch()) {
            // TODO: добавить в класс toTableRow()
            echo "<tr><td>{$row->getName()}</td><td>{$row->getColor()}</td></tr>";
        }
        echo "</table>";

        // необходимо для повторного использования запроса
        $stmt->closeCursor();
    } // view

    ?>

</body>
</html>
