<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8" />
    <title>Сессии в PHP</title>
</head>
<body>
    <h3>Использование Сессий в PHP - страница 3</h3>
    <?php
        session_name("PD011");
        session_start();           // начало сессии - при первом вызове
        $id = session_id();
        $name = session_name();    // получить имя сессии
        echo "ИД сессии: '<b>$id</b>'; Имя сессии: <b>'$name</b>'<br/><br/>";

		echo "<h3>Прочитано из сессии</h3>";
        $v1 = $_SESSION["timeNow"];
        $v2 = $_SESSION["number"];
        echo "<br/>переменные сессии timeNow = $v1 и number = $v2<br/><br/>";

		echo "<h3>Новые значения в сессию</h3>";
        $v2 += 100;
        $v1 /= 1000000;
        $_SESSION["timeNow"] = $v1;
        $_SESSION["number"] = $v2;
        echo "<br/>Новые значения переменных сессии timeNow = $v1 и number = $v2<br/><br/>";
    ?>
    <a href="page02.php">На вторую страницу</a><br/>
    <a href="../index.php">На главную</a>
</body>
</html>
