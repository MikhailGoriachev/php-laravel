<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8" http-equiv="refresh" />
    <title>ООП в PHP - трейты (примеси)</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link href="imgs/broom.png" rel="shortcut icon" type="image/x-icon" />
</head>
<body>
    <h3>Traits (примеси) в PHP</h3>
    <?php
        // объявление используемых пространств имен
        use Models\DemoClass1, Models\DemoClass2, Models\DemoClass3, Models\DemoClass4;

        spl_autoload_register();

        try {
            /*
            echo "<h4>Использование трейта <span class='green-text'>FirstTrate</span> с классом <span class='blue-text'>DemoClass1</span></h4>";

            // для DemoClass1 не определен метод __toString()
            $demo1 = new DemoClass1([random_int(-10, 10), random_int(-10, 10), random_int(-10, 10)]);
            echo $demo1->infoToString('Объект $demo1'); // вызов метода трейта
            $temp = $demo1->bar();                           // вызов метода класса
            echo $temp;
            echo "<br/>";
            // $temp = $demo1->barFirstTrait(); // вызов метода трейта по синониму
            // echo $temp;

            // для DemoClass2 определен метод __toString()
            echo "<h4>Использование трейта <span class='green-text'>FirstTrate</span> с классом <span class='blue-text'>DemoClass2</span></h4>";
            $demo2 = new DemoClass2('Значение для свойства $a');
            echo "$demo2";
            $demo2 = new DemoClass2(-300, 456);
            echo "<br/>Это еще один экземпляр класса ClassDemo2:<br/>$demo2";
            */


            // для DemoClass3 определен метод __toString()
            echo "<h4>Использование трейта <span class='green-text'>SecondTrate</span> с классом <span class='blue-text'>DemoClass3</span></h4>";
            $temp = DemoClass3::foo();          // статический метод из трейта
            $temp1 = DemoClass3::$staticData;   // статическое свойство из трейта
            echo "Значение из static-метода: $temp, прямой доступ к static-свойтсву: $temp1<br/>";
            $demo3 = new DemoClass3();
            echo "$demo3<br/>";

            // для DemoClass4 определен метод __toString()
            echo "<h4>Использование трейтов <span class='green-text'>FirstTrait, SecondTrate</span> с классом <span class='blue-text'>DemoClass4</span></h4>";
            $temp = DemoClass4::foo();
            $temp1 = DemoClass4::$staticData;

            echo "Значение из static-метода: $temp, прямой доступ к static-свойству: $temp1<br/>";
            $demo4 = new DemoClass4([14, 12, 17], -110);
            echo "$demo4<br/>";
            $demo4->method1();


            echo "<h4>Сколько статик-свойств в классах <span class='blue-text'>DemoClass3, DemoClass4</span></h4>";
            DemoClass3::$staticData = -1;
            DemoClass4::$staticData = -2;
            $temp1 = DemoClass3::$staticData;
            $temp2 = DemoClass4::$staticData;
            echo "Значение из DemoClass3: $temp1, значение из DemoClass4: $temp2<br/>";
            echo "<br/>Если значения разные, то в каждом классе свой экземпляр статик-свойства<br/>";
        } catch (Exception $ex) {
            $msg = $ex->getMessage();
            $line = $ex->getLine();
            echo "<span class='red-text'>$msg</span> в строке $line";
        } // try-catch
    ?>
</body>
</html>
