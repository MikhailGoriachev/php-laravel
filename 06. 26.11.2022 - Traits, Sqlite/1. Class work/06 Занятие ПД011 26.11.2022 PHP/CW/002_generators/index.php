<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8" http-equiv="refresh"/>
    <title>генераторы</title>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
    <link href="imgs/broom.png" rel="shortcut icon" type="image/x-icon"/>
</head>
<body>
<h3>Генераторы в PHP</h3>
<?php

try {
    // простейший генератор
    function getRange($max = 10)
    {
        for ($i = 1; $i <= $max; $i++) {
            yield $i;
        }

        // не всегда нужен цикл :)
        yield 1;
        yield 3;
        yield 1;
        yield 5;
        yield -1;
    } // getRange

    // использование генератора
    foreach (getRange() as $item) {
        echo "Данные {$item} <br>";
    }
    echo "<hr/>";

    // еще один вариант использования генератора
    $generator = getRange(32);
    foreach ($generator as $item) {
        echo "Данные {$item} <br>";
    }
    echo "<hr/>";

    // ---------------------------------------------------
    // возврат пар ключ => значение из генератора
    function getPair($max = 10)
    {
        for ($i = 0; $i < $max; $i++) {
            $value = mt_rand(1, 1000);

            //    ключ => значения
            yield $i => $value;
        }
    }


    foreach (getPair() as $key => $value) {
        echo "Пара $key => $value   <br>";
    }
    echo "<hr/>";

    // ---------------------------------------------------
    // отправка значений генератору
    function getRangeReceiver($max = 10) {
        for ($i = 1; $i < $max; $i++) {
            // прием отправленных генератору данных - в переменную $inject
            $inject = yield $i;
            if ($inject === 'stop') break;
        }
    }

    $generator = getRangeReceiver(PHP_INT_MAX);

    foreach ($generator as $range) {
        // если значение, полученное из генератора == 12
        // передать генератору сообщение - команду завершения
        if ($range === 12) {
            // посылаем сообщение генератору
            $generator->send('stop');
        }
        print "Значение {$range} <br>";
    }

} catch (Exception $ex) {
    $msg = $ex->getMessage();
    $line = $ex->getLine();
    echo "<span class='red-text'>$msg</span> в строке $line";
} // try-catch
?>
</body>
</html>
