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
    if (isset($_COOKIE["var1"])) {
        // показать значение куки
		$var1 = $_COOKIE["var1"];
        echo "Куки <b>var1</b> равен $var1<br/>";

		// удалить куки - надо просто задать время expire до текущего момента
        setcookie("var1", 0, time()-10);
        echo "Куки <b>var1</b> удален<br/>";
    } else {
        echo "<span style='color: red;'>Куки <b>var1</b> не установлен</span><br/>";
    } // if
    ?>

    <br /><br />
    <a href="index.php">Это ссылка на первую часть</a>
</body>
</html>
