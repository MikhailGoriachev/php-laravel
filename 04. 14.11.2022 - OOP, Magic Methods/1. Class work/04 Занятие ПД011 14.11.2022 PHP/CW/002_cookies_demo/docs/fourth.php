<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Cookies в PHP</title>
</head>
<body>
    <h3>Cookies в PHP</h3>
    <?php
	// Куки var2 доступна только в папке docs
    if (isset($_COOKIE["var2"])) {
        $var2 = $_COOKIE["var2"];
        echo "Куки <b>var2</b> равен $var2<br/>";
        $var2 *= 2;

        // приводит к созданию куки в текущей папке - т.к. файл скрипта в отдельной папке
        // setcookie("var2", $var2, time() + 3600);
        setcookie("var2", $var2, time() + 3600, "./docs");
        // setcookie("var2", $var2, time() + 3600, "/docs");
    } else {
		$var2 = 42;
        echo "<span style='color: red;'>Куки <b>var2</b> еще не установлен</span>, устанавливаем...<br/>";
		setcookie("var2", $var2, time() + 3600, "./docs");
		// setcookie("var2", $var2, time() + 3600, "/docs");
    } // if

    echo "Новое значение куки <b>var2</b> установлено в <span style='color: green;'>$var2</span><br/><br/>";

    // доступ к куки var1
    if (isset($_COOKIE["var1"])) {
		// перепишем значение куки в переменную - для удобства
        $var1 = $_COOKIE["var1"];
        echo "Значение куки <b>var1</b> в переменной равно $var1<br/>";
    } else {
        echo "<span style='color: red;'>Куки <b>var1</b> не установлен</span><br/>";
    } // if
    ?>

    <br /><br />
    <a href="../index.php">Это ссылка на первую часть</a>
</body>
</html>
