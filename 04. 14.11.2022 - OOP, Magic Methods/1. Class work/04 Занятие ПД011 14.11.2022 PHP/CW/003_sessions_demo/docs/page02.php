<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8" />
    <title>Сессии в PHP</title>
</head>
<body>
    <h3>Использование Сессий в PHP - страница 2</h3>
    <?php
		// начало сессии - при первом вызове, присоединение при последующих вызовах
        // при имени сессии PHPSESSID
        session_name("PD011");
        session_start();

        $id = session_id();
        $name = session_name();    // получить имя сессии
        echo "ИД сессии: '<b>$id</b>'; Имя сессии: <b>'$name</b>'<br/><br/>";

		echo "</h3>Данные прочитаны из сессии</h3>";
        $var1 = $_SESSION["timeNow"];
        $var2 = $_SESSION["number"];
        echo "<br/>Переменные сессии timeNow = $var1 и number = $var2<br/><br/>";
    ?>
    <a href="../index.php">На главную</a>
</body>
</html>
