<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8" http-equiv="refresh" />
    <title>Пространство имен, загрузчик классов</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css" />
    <link href="../imgs/broom.png" rel="shortcut icon" type="image/x-icon" />
</head>
<body>
    <h3>Пространство имен, загрузчик классов</h3>
    <?php
        // объявление используемых пространств имен
        use Models\A, Models\B, Models\Toy;

        try {
            // больше не нужны...
            // require_once "Models\A.php";
            // require_once "Models\B.php";

            // система/интерпретатор PHP будет использовать стандартный загрузчик классов spl_autoload()
            spl_autoload_register();

            // функция загрузчик классов
            // $className - пространство имен входит в имя класса
            // function myAutoloader($className) {
            //     require_once $className.".php";
            // }

            // имя функции загрузчика
            // spl_autoload_register('myAutoloader');


            // функция загрузчика
            // spl_autoload_register(function($className) {
            //     require_once $className.".php";
            // });

            // класс A доступен - работа автозагрузчика
            $a = new A(-100, "привет!");
            $str = serialize($a);
            echo "сериализация объекта: <b>$str</b><br/>";
            $b = unserialize($str);
            echo var_export($b)."<br/>$b<br/>";

            // класс B доступен - работа автозагрузчика
            $b = new B(101, "пока!");
            echo "$b<br/>";

            // класс Toy доступен - работа автозагрузчика
            $toy = new Toy("мяч резиновый", 5, 60);
            echo "<p>$toy</p>";
        } catch (Exception $ex) {
            $msg = $ex->getMessage();
            $line = $ex->getLine();
            echo "<span class='red-text'>$msg</span> в строке $line";
        } // try-catch
    ?>
</body>
</html>