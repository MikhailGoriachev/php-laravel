<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8" http-equiv="refresh" />
    <title>PDO - PHP Data Objects - доступ к БД</title>
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>
    <?php

        /*
         * В php.ini открыть расширение
         * extension=pdo_mysql
         * Описание соединения
         * После созданиз базы данных определим DSN (Data Source Name) — сведения
         *  для подключения к базе данных, представленные в виде строки.
         * Синтаксис описания отличается в зависимости от используемой СУБД.
         * В примере работаем с MySQL/MariaDB, поэтому указываем:
         *     тип драйвера;
         *     имя хоста, где расположена СУБД;
         *     порт (необязательно, если используется стандартный порт 3306);
         *     имя базы данных;
         *     кодировку (необязательно).
         * Строка DSN в этом случае выглядит следующим образом:
         * драйвер:host=имяИмяхост;port=портMySql;dbname=имяБазыДанных;charset=имяКодировки
         * "mysql:host=localhost;port=3306;dbname=solar_system;charset=utf8"
        */
        //      драйвер:host=имяИмяхост;port=портMySql;dbname=имяБазыДанных;charset=имяКодировки
        $dsn = "mysql:host=localhost;port=3306;dbname=solar_system;charset=utf8";

        // параметры PDO - обработка ошибок, вид получаемых данных
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,      // при ошибках выбрасывать исключение
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC  // запрос возвращает ассоциативный массив
        ];

        // создание PDO объекта
        $pdo = new PDO($dsn, 'root', '___sP123456890...', $options);


        /*
        echo "<h3>Выборка данных с параметрами, заданными при подключении к БД (PDO::FETCH_ASSOC)</h3>";
        $stmt = $pdo->query("select * from planets");
        while ($row = $stmt->fetch()) {
            echo var_export($row)."<br>";
        }
        echo "<br>";
        */

        /*
        // PDO::FETCH_NUM
        echo "<h3>PDO::FETCH_NUM - индексирование строки выборки числами</h3>";
        $stmt = $pdo->query("select * from planets");
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            var_export($row);
            echo "<br>";
        }
        echo "<br>";
        */

        /*
        // Определение метода выборки по умолчанию
        // PDO::FETCH_BOTH Режим по умолчанию.
        // Результат выборки индексируется как номерами (начиная с 0),
        // так и именами столбцов:
        echo "<h3>PDO::FETCH_BOTH - индексирование строки выборки числами и именами</h3>";
        $stmt = $pdo->query("select * from planets");
        while ($row = $stmt->fetch(PDO::FETCH_BOTH)) {
            var_export($row);
            echo "<br/>";
        }
        echo "<br/>";
        */


        /*
        // PDO::FETCH_COLUMN выбоорка одного столбца
        echo "<h3>PDO::FETCH_COLUMN - выборка одного столбца</h3>";
        $stmt = $pdo->query("select name from planets");

        while ($row = $stmt->fetch(PDO::FETCH_COLUMN)) {
            var_export($row);
            echo "<br/>";
        }
        echo "<br/>";
        */


        /*
        // PDO::FETCH_ASSOC
        echo "<h3>PDO::FETCH_ASSOC - индексирование строки выборки ассоциативно, ключ - имя столбца</h3>";
        $stmt = $pdo->query("select * from planets");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            var_export($row);
            echo "<br/>";
        }
        echo "<br/>";
        */


        /*
        // PDO::FETCH_KEY_PAIR - пары ключ - значение, допустимы дубликаты ключей
        echo "<h3>PDO::FETCH_KEY_PAIR - пары ключ-значение, ключ - столбец</h3>";
        $stmt = $pdo->query("select name, color from planets");   // name -> color
        // $stmt = $pdo->query("select color, name from planets");   // color -> name
        // $stmt = $pdo->query("select id, name, color from planets");  // error!!! > 2 columns
        while ($row = $stmt->fetch(PDO::FETCH_KEY_PAIR)) {
            var_export($row);
            echo "<br/>";
        }
        echo "<br/>";
        */

        /*
        // PDO::FETCH_OBJ  == PDO::FETCH_ASSOC
        echo "<h3>PDO::FETCH_OBJ - объект, столбец - свойство</h3>";
        $stmt = $pdo->query("select id, name, color from planets");
        while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
            var_export($row);
            echo "<br/>";
        }
        echo "<br/>";
        */


        // сущность для planets - имя полей совпадают с именами столбцов
        class Planet {
            private $name;
            private $color;

            public function getName() {
                return $this->name;
            }

            public function setName($name): void {
                $this->name = $name;
            }


            public function getColor() {
                return $this->color;
            }

            public function setColor($color): void {
                $this->color = $color;
            }

            public function __toString() {
                return "$this->name: $this->color";
            }

        } // class Planet



        /*
        // PDO::FETCH_CLASS
        echo "<h3>PDO::FETCH_CLASS - создаются объекты класса</h3>";
        // пример на использование параметров
        // $color1 = 'red';
        // $color2 = 'stripes';
        // $stmt = $pdo->query("select name, color from planets where color in ('$color1', '$color2')");
        $stmt = $pdo->query("select name, color from planets");
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Planet');
        while ($row = $stmt->fetch()) {
            // var_export($row);
            // echo "{$row->getName()} | {$row->getColor()}";
            echo "$row";  // работает __toString()
            echo "<br/>";
        }
        echo "<br/>";
        */


        // подготовленный запрос
        // pdo->prepare()  подготовка
        // pdo->query()    выполнение запроса, не меняющего данные
        // pdo->execute()  выполнение запроса, меняющего данные
        $stmt = $pdo->prepare("delete from planets where id > ?");
        $stmt->execute([3]);  // выполнить запрос с массивом параметров
        // $stmt = $pdo->prepare("delete from planets where id > ? and color in (?, ?)");
        // $stmt->execute([3, 'red', 'green']);
        echo "<h3>После удаления</h3>";
        $stmt = $pdo->query("select name, color from planets");
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Planet');
        while ($row = $stmt->fetch()) {
            // var_export($row);
            echo "{$row->getName()} | {$row->getColor()}";
            echo "<br/>";
        }
        echo "<br/>";

        // именованные параметры
        $stmt = $pdo->prepare("insert into planets(name, color) values(:name, :color)");
        $stmt->execute(['name'=> 'saturn', 'color'=>'silver']);

        echo "<h3>После вставки</h3>";
        $stmt = $pdo->query("select name, color from planets");
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Planet');
        while ($row = $stmt->fetch()) {
            // var_export($row);
            echo "{$row->getName()} | {$row->getColor()}";
            echo "<br/>";
        }
        echo "<br/>";


        // методы bindValue()
        // https://www.php.net/manual/en/pdostatement.bindvalue.php#example-986
        $stmt = $pdo->prepare("insert into planets(name, color) values(?, ?)");
        $name = 'neptune';
        $color = 'blue';
        $stmt->bindValue(1, $name, PDO::PARAM_STR);
        $stmt->bindValue(2, $color, PDO::PARAM_STR);
        $stmt->execute();

        echo "<h3>После вставки при помощи bindValue() для ?</h3>";
        $stmt = $pdo->query("select name, color from planets");
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Planet');
        while ($row = $stmt->fetch()) {
            var_export($row);
            echo "<br/>";
        }
        echo "<br/>";


        // !!! привязка переменных к параметрам запроса !!!
        $stmt = $pdo->prepare("insert into planets(name, color) values(:name, :color)");
        $name = 'uranus';
        $color = 'blue';
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':color', $color, PDO::PARAM_STR);
        $stmt->execute();

        echo "<h3>После вставки при помощи bindParam() для именованных параметров</h3>";
        $result = $pdo->query("select name, color from planets");
        $result->setFetchMode(PDO::FETCH_CLASS, 'Planet');
        while ($row = $result->fetch()) {
            var_export($row);
            echo "<br/>";
        }
        echo "<br/>";

        // Повторное использование параметров - задать новые значения переменным и выполнить запрос
        // благодаря привязке будут использованы новые значения переменных
        $name = 'neptune';
        $color = 'white';
        $stmt->execute();
        $result = $pdo->query("select name, color from planets");

        echo "<h3>bindParam: после повторного использования запроса вставки для именованных параметров</h3>";
        $result->setFetchMode(PDO::FETCH_CLASS, 'Planet');
        while ($row = $result->fetch()) {
            // можно вывести в строку, а затем вывести эту строку
            $str = var_export($row);
            echo "$str<br/>";
        }
        echo "<br/>";


        // изменение записи, завершаем CRUD
        $stmt = $pdo->prepare("update planets set name=:name, color=:color where id > :id");
        $name = 'nibiru';
        $color = 'gold';
        $id = 3;
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':color', $color, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        // получение данных из таблицы и вывод данных
        echo "<h3>После изменения при помощи bindParam() для именованных параметров</h3>";
        $stmt = $pdo->query("select name, color from planets");
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Planet');
        while ($row = $stmt->fetch()) {
            $str = var_export($row);
            echo "$str<br/>";
        }
        echo "<br/>";

    ?>
</body>
</html>
