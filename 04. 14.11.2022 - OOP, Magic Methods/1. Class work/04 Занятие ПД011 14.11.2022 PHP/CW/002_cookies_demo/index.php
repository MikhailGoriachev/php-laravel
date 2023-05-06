<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8" />
    <title>Cookies в PHP</title>
    <link href="styles.css" rel="stylesheet">
</head>
<body>
    <h3>Cookies в PHP</h3>
	<?php
        // переменная для доступа к куки 
        $var1 = 100;

		// $_COOKIE - глобальный массив для куки
        if (isset($_COOKIE["var1"])):
            // чтение куки
            $var1 = $_COOKIE["var1"];
            $var1 += 10;
			// Куки уже определен - изменение куки
            setcookie("var1", $var1);
        else:
			// Куки еще не определен - создание, установка куки
            setcookie("var1", $var1, time()+3600);
            echo "<span style='color: darkblue;'>Куки <b>var1</b> создан</span><br/>";
        endif;

        echo "Значение куки <b>var1</b> равно $var1<br/>";

        // проверим наличие еще одной куки
		if (!isset($_COOKIE["docs/var2"])):
			echo "<p>Куки var2 не доступна или не установлена</p>";
		endif;
	?>
    <br /><br />
    <a href="second.php">Это ссылка на вторую часть - показывает куки</a><br/>
    <a href="third.php">Это ссылка на третью часть - удаляет куки</a><br/>
    <a href="docs/fourth.php">Это ссылка на четвертую часть - изменяет куки</a><br/>
</body>
</html>
