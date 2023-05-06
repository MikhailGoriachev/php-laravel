<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8" />
    <title>Сессии в PHP</title>
</head>
<body>
    <h3>Завершение сессии</h3>

    <?php
        session_name("PD011");
        session_start();           // начало сессии - при первом вызове, присоединение - при последующих
        $id = session_id();
        $name = session_name();    // получить имя сессии
        echo "ИД сессии: '<b>$id</b>'; Имя сессии: <b>'$name</b>'<br/><br/>";

        $v1 = $_SESSION["timeNow"];
        $v2 = $_SESSION["number"];
        echo "<br/>переменные сессии timeNow = $v1 и number = $v2<br/><br/>";

         // для удаления сессии необходимо
         $_SESSION = [];
         if (session_id() != "" || isset($_COOKIE[session_name()]))
             setcookie(session_name(), '', time()-10, '/');
         session_destroy(); // удаление данных сессии на сервере
    ?>
    <h3>Сессия завершена</h3>

    <br/>
    <br/>
    <br/>
    <a href="../index.php">Вход</a>
</body>
</html>
