<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8" http-equiv="refresh" />
    <title>ООП в PHP - magic-методы и исключения</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
	<link href="imgs/broom.png" rel="shortcut icon" type="image/x-icon" />
</head>
<body>
    <h3>Magic-методы в PHP</h3>
	<?php
        require_once("models/MagicDemo.php");

        $foo = new MagicDemo();

        $foo->prop = "свойство";     // явно определенное свойство
        $foo->coffee = "американо";  // явно определенное свойство

        // Примеры доступа к неявно определенному свойству, при помощи __get(), __set()
        // пример работы сеттера __set()
        $foo->n = 1;       // неявно определенные свойство n
        $foo->b = 123;     // неявно определенные свойство b
        $foo->c = "Это новая строка";
        $foo->a = 100;     // неявно определенные свойство a
        $foo->none = 42;     // отсутствующее свойство none

		echo "<h4>Демонстрация метода __toString()</h4>";
		echo "$foo<br/>";

        echo "<h4>Инкремент</h4>";
        $foo->a++;
        echo "<hr/>";


        echo "<h4>Перед выводом неявных свойств в echo</h4>";
        // демонстрация работы волшебного метода __get() --
        echo "Свойство a = $foo->a; Свойство b = $foo->b; Свойство c = $foo->c; Свойство n = $foo->n<br/>";
        echo "<hr/>";

        echo "<h4>Обращение к свойству, котрого нет...</h4>";
        $foo->z++;         // такое свойство отсутствует

		echo "<h4>Демонстрация метода __toString()</h4>";
		$foo->coffee = "капучино";
		echo "<p>foo: $foo</p>";

        echo "<hr/>";
        var_dump($foo);
		echo "<hr/>";


        echo "<br/><hr/><h3>Вызов обычного метода</h3><br/>";
        $foo->method();
        echo "<br/><hr/><h3>Перегруженный вызов методов - вызываем метод __call() вместо отсутствующих методов</h3><br/>";

        // Перегруженный вызов методов - вызываем метод __call() вместо
        // отсутствующих методов
        // Методов example(), test(), bar() в классе нет, но краха не происходит
        // список параметров упаковывается в массив, массив передается методу __call()
        $foo->example(1, 2, 3, 4);
        echo "<hr>";

        // список параметров упаковывается в массив, массив передается методу __call()
        $foo->test("один", "два", "три");
        echo "<hr>";

        // список параметров упаковывается в массив, массив передается методу __call()
        $y = $foo->bar(1, false, "три", 6.8, "FW AB");
        echo"<br><hr><br>";
        print_r($y);
        echo"<br><hr>";


        // Итератор для открытых свойств объекта
        $foo->prop = -4.67;
		$foo->coffee = "кофе из буфета за 20 руб.";

        echo "<h3>Итератор для открытых свойств объекта</h3><br/>";
        echo "<table><tr><th>Имя свойства</th><th>Значение свойства</th></tr>";
        foreach ($foo as $key=>$value) {
            echo "<tr><td>$key</td><td>$value</td></tr>";
        } // foreach
        echo"</table><hr><br>";


        // Возможно указание типа объекта при объявлении функции
        // ! Функция возвращает объект !
        function bar(MagicDemo $obj) {
            echo "bar - начало<br/>";
            $obj->method();
            echo "<ul>";
            foreach ($obj as $key => $value) {
                echo "<li><b>$key</b> => <i><u>$value</u></i></li>";
            }
            echo "</ul>bar - конец<br/>";

            return $obj;
        } // bar

        // примеры вызова функции, параметром которой является объект
        echo "<br>";
        bar($foo);
        var_dump($foo);
        echo "<br>";


        // Можно разыменовывать объект, возвращаемый из метода
        // разыменовать - применить операцию ->
		// функция bar() возвращает ссылку на существующий объект,
		// в д.с. это $foo, т.к. именно его передали в функцию
        // bar($foo)->coffee = "эспрессо";

        $ret = bar($foo);
        $ret->coffee = "эспрессо";
        $ret->a = 1122;
        echo "<br>";
        var_dump($foo);  // новое значение "эспрессо" записано в свойство coffee
        echo "<br>";

    ?>
</body>
</html>
