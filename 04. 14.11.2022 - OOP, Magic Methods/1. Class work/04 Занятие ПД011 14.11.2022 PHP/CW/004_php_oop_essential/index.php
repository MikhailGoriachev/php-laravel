<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8"/>
    <title>ООП в PHP: введение</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="imgs/broom.png" rel="shortcut icon" type="image/x-icon" />
</head>
<body>
    <h3>ООП в PHP - первая часть ООП в PHP</h3>
    <?php
        /*
         * Java-style:
         * class Name {}
         * interface IName {}
         * class Name extends Base implements IName1, IName2, ..., INameN {}
         *
         * */

        // Создание класса - тип данных
        class Person  {
            // по умолчанию действует доступ public

            // свойства класса - поля класса - члены класса
            // а) доступ к свойству в классе $this->имяСвойства
            // б) доступ к свойству вне класса $имяОбъекта->имяСвойства
            public  $id = 0;      // начиная с 7.4 можно использовать типы, nullable-типы (?тип)
            public  $name = "";   // public int $age; или public ?int $age;
            private $age = 1;     // м.б. также protected

            // статические свойства класса - то же, как в других ООП-языках
            // в одном экземпляре
            // доступ к ним
            // а) в классе   self::$имяСтатическогоСвойства
            // б) вне класса Класс::$имяСтатическогоСвойства
            public static $count = 0;

            // Константные свойства класса, константы в классе
            // доступ к ним
            // а) в классе self::ИМЯ_КОНСТАНТЫ или ИмяКласса::ИМЯ_КОНСТАНТЫ
            // б) вне класса ИмяКласс::ИМЯ_КОНСТАНТЫ
            const MIN_ID = 1;
            const MAX_AGE = 999;
            const DEF_AGE = 21;
            const DEF_NAME = "Неизвестный Н.Н.";


            // конструктор класса - единственный
            // можно использовать значения по умолчанию
            function __construct($name = self::DEF_NAME, $age = Person::DEF_AGE) {
                echo "<h4 style='color: blue'>Работает конструктор</h4>";
                $this->id = ++self::$count;  // self::$имя - доступ в классе к статическому свойству
                $this->name = $name;
                $this->age = $age;
            } // __construct


            // деструктор класса - единственный - только для закрытия ресурсов
            // !!! вызывается после обработки файла php - после обработки
            // !!! последней строки файла php
            function __destruct() {
                echo "<span style='color: red'><b>Вызван деструктор Person($this->name)</b></span><br/>";
            } // __destruct


            // методы класса
            // а) доступ в классе $this->имяМетода(параметры)
            // б) доступ вне класса $объект->имяМетода(параметры)
            function getId() { return $this->id; }

            function getAge() {
                // $temp = $this->getId();
                return $this->age;
            }
            function setAge($age) {
                $this->age = $age < 0 || $age > self::MAX_AGE?self::DEF_AGE:$age;
            }


            // статический метод класса - работа со статическими членами класса
            // а) доступ в классе $self::имяМетода(параметры)
            // б) доступ вне класса ИмяКласса::имяМетода(параметры)
            static function getCount() { return self::$count; }
        } // class Person


        // создание объекта класса Person
        echo "<h4>Создание объекта класса Person:</h4>";
        // создание объекта конструктором по умолчанию - можно не указывать ()
        $person1 = new Person;
        // $person1 = new Person();
        print_r($person1); // вывести объект в читабельном виде (в виде ассоциативного массива свойство => значение)
        echo "<br/><hr/>";

        // пример использования сеттеров и полей (свойств) класса класса
        echo "<h4>Изменение:</h4>";
        $person1->setAge(39);
        $person1->name = "Наталья Романофф";
        print_r($person1);
        echo "<br/><hr/>";


        // пример использования поля класса и геттера
        echo "<p>Возраст $person1->name в годах: $person1->getAge()</p>"; // !! вызвов метода не работает в интерполяционной строке !!
        echo "<p>Возраст $person1->name в годах: ".$person1->getAge().".</p>";

        // при использовании сложного синтаксиса {выражение доступа} вызов метода работает
        echo "<p>Возраст {$person1->name} в годах: {$person1->getAge()}.</p>";

        // Создание еще одного экземпляра класса
        echo "<h4>Создание еще одного объекта класса Person:</h4>";
        $person2 = new Person("Иван Помидоров", 34); // вызов конструктора с параметрами
        print_r($person2);
        echo "<br/>";


        // Доступ к константам класса
        echo "<hr/><h4>Константы класса/Константные свойства класса:</h4>"
            ."<ul>"
            ."<li>Person::MAX_AGE = ".Person::MAX_AGE.";</li>"  // !! интерполяция не работает для констант !!
            ."<li>Person::MIN_ID = ".Person::MIN_ID.";</li>"
            ."<li>Person::DEF_NAME = ".Person::DEF_NAME.";</li>"
            ."</ul>";


        echo "<hr/><h4>Статические свойства и методы классов</h4>";
        // Доступ к статическому свойству класса
        Person::$count = 42;
        echo "<p>Статическое свойство класса: ".Person::$count."</p>";

        // интерполяция статических свойств не поддерживается
        // echo "<p>Статическое свойство класса: {Person::$count}</p>";

        // Вызов статического метода класса Person::getCount()
        echo "<p>Счетчик равен: ".Person::getCount()."</p><br/>";


        // Работа с массивом объектов
        echo "<h4>Массив объектов</h4>";
        $persons = [
            new Person("Радион Раскольников", 21),
            new Person("Соня Мармеладова", 28),
            new Person("Федор Достоевский", 57)
        ];
        var_dump($persons);

        echo "<br><h4>Массив объектов класса Person - for, indexing</h4><ul>";
        for($i = 0; $i < count($persons); $i++)
            echo "<li>Имя: {$persons[$i]->name}; возраст {$persons[$i]->getAge()}</li>";
        echo "</ul>";

        echo "<br><h4>Массив объектов класса Person - foreach</h4><ul>";
        foreach($persons as $item)
            echo "<li>Имя: {$item->name}; возраст {$item->getAge()}</li>";
        echo "</ul>";

    ?>
    <hr/> <!-- деструктор вызывается после обработки последней строки файла  -->
</body>
</html>
