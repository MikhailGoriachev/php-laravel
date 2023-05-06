<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8" http-equiv="refresh" />
    <title>сериализация/десериализация в PHP</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link href="imgs/broom.png" rel="shortcut icon" type="image/x-icon" />
</head>
<body>
    <h3>Сериализация/десериализация в PHP</h3>
    <?php

        try {
            require_once "Models/A.php";

            // сериализация скалярной переменной в строку
            $a = 123;
            $str = serialize($a);
            echo '$a = '.$a.', сериализация: '.$str.'<br/>';

            // десериализация скалярной переменной из строки с
            $b = unserialize($str);
            echo '$b = '.$b.'<br><br>';

            // сериализация массива
            $arr = [1, 3, 4, -7];
            $str = serialize($arr);
            echo "сериализация массива: $str<br>";

            // десериализция массива
            $b = unserialize($str);
            echo var_export($b)."<br><br>";

            // сериализация объекта
            $a = new A(-100, "привет!");
            $str = serialize($a);
            echo "сериализация объекта: <b>$str</b><br>";

            // десериализация объекта
            $b = unserialize($str);
            echo var_export($b)."<br>$b<br>";

        } catch (Exception $ex) {
            $msg = $ex->getMessage();
            $line = $ex->getLine();
            echo "<span class='red-text'>$msg</span> в строке $line";
        } // try-catch

        // можно и в JSON
        // https://www.php.net/manual/ru/jsonserializable.jsonserialize.php
    ?>
</body>
</html>