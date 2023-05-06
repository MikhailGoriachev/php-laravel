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
		// перепишем значение куки в переменную - для удобства 
        $var1 = $_COOKIE["var1"];
        echo "Значение куки <b>var1</b> в переменной равно $var1<br/>";
    } else {
        echo "<span style='color: red;'>Куки <b>var1</b> не установлен</span><br/>";   
    } // if
    ?>
    <br /><br />
    <a href="index.php">Это ссылка на первую часть</a>
</body>
</html>
