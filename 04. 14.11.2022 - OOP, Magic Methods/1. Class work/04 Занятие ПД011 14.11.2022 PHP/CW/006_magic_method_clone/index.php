<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8" http-equiv="refresh" />
    <title>ООП в PHP - magic-метод клонирования</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link href="imgs/broom.png" rel="shortcut icon" type="image/x-icon" />	
</head>
<body>
    <h3>Magic-методы в PHP</h3>
    <?php
        require_once ("models/MagicDemo.php");

        // клонирование объектов - два шага:
        // в классе должно быть реализован метод клонирования __clone()
        // использование ключевого слова clone
        echo "<hr/><h3>Клонирование объектов</h3>";
        $foo = new MagicDemo("кофе", "американо");
        echo "<b>Создан объект:</b> $foo<br/>";

        $foo1 = clone $foo;
        echo "<b>Клон объекта:</b> $foo1<br/><br/>";

        // для контроля - запишем разные значения в поля исходного объекта и клона
        $foo1->setProp('Клон объекта $foo');
        $foo->setProp("Исходный объект") ;

        $foo1->setBeveridge('эспрессо');
        $foo->setBeveridge("капуччино") ;

        // вывод объектов
        echo "<b>Исходный объект изменен:</b> $foo<br/>";
        echo "<b>Клон объекта изменен:</b> $foo1<br/><br/>";

        echo "<h4>Присваивание</h4>";
        $foo1 = $foo;  // теперь две ссылки на один объект
        $foo1->setProp('Объект $foo1');
        $foo->setProp('Объект $foo') ;

        $foo1->setBeveridge('чай черный');
        $foo->setBeveridge("чай красный") ;

        echo "<b>foo:</b> $foo<br/>";
        echo "<b>foo1:</b> $foo1<br/>";

    ?>
</body>
</html>
