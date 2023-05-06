<!DOCTYPE html>
<!-- Самообрабатывающаяся, небезопасная форма -->
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Самообрабатывающаяся форма</title>

    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <h3>Самообрабатывающаяся форма, небезопасная - есть JavaScript, HTML</h3>
    <div>
        <p>Тестовый ввод для имени и пароля</p>
        <ul>
            <li>&lt;script&gt;alert()&lt;/script&gt;&lt;i&gt;привет&lt;/i&gt;</li>
            <li>&lt;b&gt;Это текст!&lt;/b&gt;</li>
        </ul>

        <?php
            // проверка выполнен или еще не выполнен ввод переменных
            if(isset($_POST['login']) and isset($_POST['password'])){
                // получить значения переменных
                $login=$_POST['login'];
                $password = $_POST['password'];
            } else {
                $login="не задан";
                $password = "не задан";
            } // if
        ?>
    </div>

    <h3>Вход на сайт</h3>

    <!-- по submit обработка в этом же файле, т.к. action не указан -->
    <form method="post">
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
