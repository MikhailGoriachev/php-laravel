<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hello, PHP</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>It works! Это работает! </h1>
    <?php
        // комментарий строчный
        // phpinfo();

        # комментарий строчный
        echo "<h3>Привет мир!</h3>";
        /* блочный комментарий */
    ?>

    <!-- краткая форма серверного тега PHP -->
    <?
        echo "<h4 id='out1'>Еще один привет!</h4>";
        echo '<h5>Еще один привет!</h5>';
    ?>

    <!-- форма тега для вывода выраений -->
    <h4><?= "Текстовая строка - выражение" ?></h4>

    <script>
        // исполнение на стороне клиента
        setTimeout(() => document.querySelector('#out1').innerHTML = "Текст, сформированный в JS", 3_000);
    </script>
</body>
</html>
