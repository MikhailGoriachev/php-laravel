<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Работа со строками</title>
	<meta charset="utf-8">
    <link href="styles.css" rel="stylesheet">
</head>

<body>
    <h3>Функции strpos(), mb_strpos(), strlen()</h3>
    <?php
        $input1 = 'This is the end';
        $search1 = 'is';
        $position = strpos($input1, $search1); // 2
        if($position !== false) {
            echo "strpos: Позиция подстроки '$search1' в строке '$input1': $position<br/>";
        }

        $input2 = 'Кот ломом колол слона';
        $search2 = 'ло';
        $position = strpos($input2, $search2); // 2
        if($position !== false) {
            echo "strpos: Позиция подстроки '$search2' в строке '$input2': $position<br/>";
        }

        // раскомментировать в php.ini для корректной работы с кириллицей
        // ;extension=mbstring;
        // !!! нужна перезагрузка !!!
        $position = mb_strpos($input1, $search1); // 2
        if($position !== false) {
            echo "mb_strpos: Позиция подстроки '$search1' в строке '$input1': $position<br/>";
        }
        $position = mb_strpos($input2, $search2); // 2
        if($position !== false) {
            echo "mb_strpos: Позиция подстроки '$search2' в строке '$input2': $position<br/>";
        }

        echo "<hr/>Длина строки strlen(): '$input1': ".strlen($input1)."<br/>";
        echo "Длина строки strlen(): '$input2': ".strlen($input2)."<br/>";
        echo "Длина строки mb_strlen(): '$input2': ".mb_strlen($input2)."<br/>";
    ?>

    <h3>Функции strrpos(), mb_strrpos() - поиск с конца строки</h3>
    <?php
        $input1 = 'This is the end, only is?';
        $search1 = 'is';
        $position = strrpos($input1, $search1); // 2
        if($position !== false) {
            echo "strrpos: Позиция подстроки '$search1' в строке '$input1': $position<br/>";
        }

        $input2 = 'Кот ломом колол слона';
        $search2 = 'ло';

        $position = mb_strrpos($input1, $search1); // 2
        if($position !== false) {
            echo "mb_strrpos: Позиция подстроки '$search1' в строке '$input1': $position<br/>";
        }
        $position = mb_strrpos($input2, $search2); // 2
        if($position !== false) {
            echo "mb_strrpos: Позиция подстроки '$search2' в строке '$input2': $position<br/>";
        }
    ?>

    <h3>Изменение регистра strtolower(), strtoupper(), mb_strtolower(), mb_strtoupper()</h3>
    <?php
        $input1 = 'This is the end is only';
        $input2 = strtoupper($input1);
        echo "strtoupper: '$input2'<br/>";

        $input1 = 'Кот ломом колол слона';
        $input2 = strtoupper($input1);
        echo "strtoupper: '$input2'<br/>";

        $input1 = 'This is the end is only';
        $input2 = mb_strtoupper($input1);
        echo "mb_strtoupper: '$input2'<br/>";

        $input1 = 'Кот ломом колол слона';
        $input2 = mb_strtoupper($input1);
        echo "mb_strtoupper: '$input2'<br/>";

        $input1 = mb_strtolower($input2);
        echo "mb_strtolower: '$input1'<br/>";

    ?>

    <h3>Получение подстроки substr(), mb_substr()</h3>
    <?php
        $input1 = 'This is the end is only';
        // substr(string, startIndex [, length])
        $input2 = substr($input1, 5);
        echo "substr: '$input2'<br/>";

        $input2 = substr($input1, 0, 4);
        echo "substr: '$input2'<br/>";

        $input1 = 'Кот ломом колол слона';
        // mb_substr(string, startIndex [, length])
        $input2 = mb_substr($input1, 4);
        echo "mb_substr: '$input2'<br/>";

        $input2 = mb_substr($input1, 4, 5);
        echo "mb_substr: '$input2'<br/>";
    ?>

    <h3>Замена одной подстроки на другую str_replace()</h3>
    <?php
        $input1 = 'This is the end is only';
        $input2 = str_replace("is", "are", $input1);
        echo "str_replace: '$input2'<br/>";

        $input1 = 'Кот ломом колол слона';
        $input2 = str_replace("ло", "ло-ЛО-OL-", $input1);
        echo "str_replace: '$input2'<br/>";

        $input2 = str_replace("ло", "", $input1);
        echo "str_replace: '$input2'<br/>";
    ?>

    <h3>Удаление ведущих и хвостовых пробелов trim()</h3>
    <?php
        $input1 = '   This   is   the    end   is   only   ';
        echo "source:<pre>'$input1'</pre><br/>";
        $input2 = trim($input1);
        echo "trim: <pre>'$input2'</pre><br/>";

        $input1 = '        Кот  ломом    колол   слона      ';
        echo "source:<pre>'$input1'</pre><br/>";
        $input2 = trim($input1);
        echo "trim: <pre>'$input2'</pre><br/>";
    ?>
    <p>
        <a href="regexp.php">Введение в регулярные выражения</a>
    </p>
</body>
</html>
