<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Самообрабатывающаяся форма</title>

    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <h3>Самообрабатывающаяся форма, безопасная, метод GET, данные в строке запроса</h3>
    <div>
        <p>Тестовый ввод для имени и пароля</p>
        <ul>
            <li>&lt;script&gt;alert()&lt;/script&gt;&lt;i&gt;привет&lt;/i&gt;</li>
            <li>&lt;b&gt;Это текст!&lt;/b&gt;</li>
        </ul>
        <?php
        // проверка ввода переменных
        if(isset($_GET['login']) && isset($_GET['password'])){
            // получить значения переменных, strip_tags($str) - удаление HTML-тегов из строки
            $login = strip_tags($_GET['login']);
            $password = strip_tags($_GET['password']);
        } else {
            $login="не задан";
            $password = "не задан";
        } // if
        ?>
    </div>
    <h3>Вход на сайт</h3>
    <form method="get">
        <label for id="login">Логин:</label>
        <input type="text" name="login" value="<?= $login=='не задан'?'':$login ?>"/><br/><br/>
        <label for id="password">Пароль:</label>
        <input type="text" name="password"  value="<?= $password=='не задан'?'':$password ?>"/><br/><br/>
        <input type="submit" value="Отправить">
    </form>
    <h3>Данные пользователя:</h3>
    <ul>
        <li>Логин: <b><?= $login ?></b></li>
        <li>Пароль: <b><?= $password ?></b></li>
    </ul>
    <br/>
    <a href="../index.php">На главную</a>
</body>
</html>
