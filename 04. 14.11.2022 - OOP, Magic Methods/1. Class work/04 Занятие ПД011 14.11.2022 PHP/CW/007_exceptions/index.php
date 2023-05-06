<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8" http-equiv="refresh" />
    <title>ООП в PHP - исключения</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link href="imgs/broom.png" rel="shortcut icon" type="image/x-icon" />	
</head>
<body>
    <h3>Исключения в PHP</h3>
    <?php
        require_once ("models/MagicDemo.php");
        require_once ("models/MyClassException.php");

        $foo = new MagicDemo("кофе", "американо");

    //////////////////////////////////////////////////////////////////////
        echo "<hr><h3>Исключения</h3>";
        // unset($foo);

        // Модель обработки ошибок - исключения
        // Исключения - объекты классов, наследуемые от Exception
        try {
            // пример на выброс исключения - экземпляр класса MyClassException
            // throw new Exception("Возникли какие-то проблемы. Серьезно.");
            echo "<h3>$foo</h3>";
            bar();
        } catch (MyClassException $ex) {
            $msg = $ex->getMessage();
            echo "<span style='color:red;'><b><i>$msg</i></b></span><br>";
            // такой конструкции нет
            // throw;
        } catch (Exception $ex) {
            $msg = $ex->getMessage();
            $file = $ex->getFile();
            $line = $ex->getLine();
            $trace = $ex->getTraceAsString();
            echo "<span style='color:firebrick;'><b><i>$msg</i></b></span><br>";
            echo "<span style='color:firebrick;'><b><i>$file</i></b></span><br>";
            echo "<span style='color:firebrick;'><b><i>$line</i></b></span><br>";
            echo "<span style='color:firebrick;'><b><i>$trace</i></b></span><br>";
        } finally {
            echo "<br><h5>try-catch блок завершен</h5><br>";
        }// try-catch-finally

        // пример вызова исключения в функции
        function bar() {
            echo "<h5>bar: выброс исключения в функции</h5>";
            // throw new Exception("Ошибка возникла в функции bar()");
            throw new MyClassException("Ошибка возникла в функции bar()");
        } // bar
    ?>
</body>
</html>
