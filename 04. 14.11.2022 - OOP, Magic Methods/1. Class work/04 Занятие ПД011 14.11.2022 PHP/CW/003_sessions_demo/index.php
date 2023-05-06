<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8" />
    <title>Сессии в PHP</title>
    <link href="styles.css" rel="stylesheet">
</head>
<body>
    <h3>Использование Сессий в PHP</h3>
    <?php
        /*
         * Набор переменных, $_SESSION - массив для хранения таких переменных,
         * хранится на сервере, и часть - на клиенте
         *
         * запись переменной в сессию
         * $_SESSION['имяПеременной'] = $имяПеременной;
         *
         * чтение переменной из сессии
         * $имяПеременной = $_SESSION['имяПеременной'];
         *
         * */

        session_name("PD011");     // назначить имя сессии
        session_start();            // начало сессии - при первом вызове
        $id = session_id();         // ид сессии - в куки PHPSESSID

        $name = session_name();     // получить новое имя сессии
        echo "ИД сессии: <b>'$id</b>'; Имя сессии: '<b>$name</b>'<br/>";

        // сформировать данные
        $v1 = time();
        $v2 = random_int(-100, 100);
        echo '<br/>$v1 = '.$v1.'; $v2 = '.$v2.'<br/>';

        // сохранить данные в сессии
        $_SESSION["timeNow"] = $v1;
        $_SESSION["number"]  = $v2;
    ?>

   <br /><br />
    <a href="docs/page02.php">Просмотр данных сессии</a><br/>
    <a href="docs/page03.php">Изменение данных сессии</a><br/>
    <a href="docs/page04.php">Удаление данных сессии - ключ <b>timeNow</b></a><br/>
    <a href="docs/exit.php">Выход - удаление/завершение сессии</a>

    <?php
        // необходимо для удаления сессии 
        // $_SESSION = [];
        // if (session_id() != "" || isset($_COOKIE[session_name()]))
        //     setcookie(session_name(), '', time()-20000000, '/');
        // session_destroy();
    ?>
</body>
</html>
