
<html lang="ru">
<head>
    <meta charset="utf-8"/>
    <title>Типы данных PHP</title>

    <link rel="stylesheet" href="style.css">
</head>
<body>
    <ul>
        <?php  // это серверные теги, ограничивающие скрипт PHP
            echo "<li>Hello, мир! Элемент генерирован в коде</li>";
            # это еще один стиль строчного комментария
            echo "<li>Привет, World! сгенерирован в коде</li>";
            /*
            Расмус Лердорф, Дания, 1994 - создание PHP: "PHP-Tools for Personal Home Page"
            */
        ?>
        <li>Dark energy - задан в разметке</li>
        <li>Dark matter - <? echo "ее 75% во Вселенной" ?> задан в разметке</li>
        <li>Dark matter - <?= "ее 75% во Вселенной" ?> задан в разметке</li>
        <li>Dark matter - <?= 39 + 3 ?> н в разметке</li>
    </ul>
    <hr/>

    <!-- основные типы данных -->
    <?php
	    // имена переменных $стандартныеПравилаИменования
        $a = "Вася";      // string
        $b = "Марина";
        $salary = 12300;  // integer
        $bonus = true;    // boolean, выводится в разметку как 1,
                          //          false вообще не выводится
        $coefficient = 3.123;    // float/double
        // В PHP есть десять базовых типов данных:
        // int (целые числа)
        // float (дробные числа)
        // bool (логический тип)
        // string (строки)
        // array (массивы)
        // object (объекты)
        // callable (функции)
        // mixed (любой тип)
        // resource (ресурсы)
        // null (отсутствие значения)
        // --------------------------------------------
        // пользовательские типы - классы
    ?>
    <br/>
    <br/>
    <!-- вывод значений переменных в HTML-разметке -->
    <h3>Вывод переменных в разметке</h3>
    <table>
        <tr>
            <td><?php var_dump($b); ?></td>
            <td><?php print_r($b); ?></td>
        </tr>
        <tr>
            <td><?php printf("a: %s", $a); ?></td>
            <td><?php printf("b: %s", $b); ?></td>
        </tr>
        <tr>
            <td><?php echo $salary; ?> </td>
            <td><?php echo $bonus; ?></td>
        </tr>
        <tr>
            <!-- echo "текст $имя текст"; -- вывод значения переменной $имя -->
            <td><?php echo "Имя: $b"; ?> </td>
            <td><?php echo "Коэффициент: $coefficient"; ?> </td>
        </tr>
        <tr>
            <!--
            echo 'текст $имя текст'; -- при одиночных кавычках
            переменные не выводятся
            -->
            <td><?php echo 'Имя: $b'; ?> </td>
            <td><?php echo 'Коэффициент: $coefficient'; ?> </td>
        </tr>
    </table>
    <hr/>

    <!-- вывод HTML-разметки в PHP-коде -->
    <?php
	// echo "текст $имя текст"; -- вывод значения переменной $имя
	// echo 'текст $имя текст'; -- вывод строки $имя
    // {} -- ограничение имени переменной
        echo "
            <br/>
            <br/>
            <h3>Вывод разметки в строку PHP</h3>
            <table>
            <tr>
                <td>$a</td>
                <td>{$b}__</td>
            </tr>
            <tr>
                <td>$salary</td>
                <td>$bonus</td>
            </tr>
        </table>";

        // heredoc-синтаксис задания строки, можно не экранировать ни ', ни "
        // интерполирует значения переменных
        $str = <<<EOT
            <br/>
            <br/>
            <h3>Heredoc-синтаксис</h3>
            <table>
            <tr>
                <td>$a</td>
                <td>$b</td>
            </tr>
            <tr>
                <td>$salary</td>
                <td>$bonus</td>
            </tr>
            <tr>
                <td>Имя: $salary</td>
                <td>Коэффициент: $coefficient</td>
            </tr>
        </table>
        EOT; // конец heredoc-строки

    echo $str;

    // nowdoc-синтаксис задания строки, можно не экранировать ни ', ни ",
    // не интерполирует значения переменных
    $str = <<<'EOT'
            <br/>
            <br/>
            <h3>Nowdoc-синтаксис</h3>
            <table>
            <tr>
                <td>$a</td>
                <td>$b</td>
            </tr>
            <tr>
                <td>$salary</td>
                <td>$bonus</td>
            </tr>
            <tr>
                <td>Имя: $salary</td>
                <td>Коэффициент: $coefficient</td>
            </tr>
        </table>
        EOT; // конец nowdoc-строки
    echo $str;
    ?>
</body>
</html>
