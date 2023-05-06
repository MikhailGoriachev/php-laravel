<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8" />
    <title>Сессии в PHP</title>
</head>
<body>
    <h3>Использование Сессий в PHP - страница 4 - удаление данных сессии</h3>
    <?php
        session_name("PD011");
        session_start();           // начало сессии - при первом вызове, присоединение - при последующих
        $id = session_id();
        $name = session_name();    // получить имя сессии
        echo "ИД сессии: '<b>$id</b>'; Имя сессии: <b>'$name</b>'<br/><br/>";

        $v1 = $_SESSION["timeNow"];
        $v2 = $_SESSION["number"];
        echo "<br/>переменные сессии timeNow = $v1 и number = $v2<br/><br/>";

        // удаление данных из сессии - как и удаление переменной при помощи unset()
        unset($_SESSION["timeNow"]);
        if (isset($_SESSION["timeNow"]))
            echo "<span style='color: blue;'>Переменная сессии <b>timeNow</b> определена и равна ".$_SESSION["timeNow"]."</span>";
        else
            echo "<span style='color: red;'>Переменная сессии <b>timeNow</b> не определена</span>";
    ?>
    <br/><br />
    <a href="page02.php">На вторую страницу</a><br/>
    <a href="../index.php">На главную</a>
</body>
</html>
