<!DOCTYPE html>
<!-- Знакомимся с массивами в PHP -->
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Массивы в PHP - знакомство</title>
</head>
<body>
    <h3>Массивы - создание и вывод</h3>
	<?php

        // массив - один из способов создания
        // обычный массив - индексирование числами
        $numbers[0] = -1;
        $numbers[1] = 'Привет, мир';
        $numbers[2] = true;
        $numbers[3] = 4.56;

        // с массивами работает огромное число функций в php
        // count(массив) - размер массива
        // синтаксис for - классика, инкремент/декремент присутствуют
        echo "<ul>";
        $n = count($numbers);
        for($i = 0; $i < $n; $i++) {
            echo "<li>$numbers[$i]</li>";
        }
        echo "</ul><hr/>";

        // альтернативный синтаксис for
        echo "<ul>";
        for($i = 0; $i < count($numbers); $i++):
            echo "<li>$numbers[$i]</li>";
        endfor;
        echo "</ul><hr/>";


        // строковый массив - создание массива, добавление элементов в массив
        $strings[] = "alpha";
        $strings[] = "beta";
        $strings[] = "gamma";
        $strings[] = "omega";

        // с массивами работает огромное число функций в php
        // sizeof(массив) - размер массива
        echo "<ol>";
        // цикл типа for
        for($i = 0; $i < sizeof($strings); $i++)
            echo "<li>$strings[$i]</li>";
        echo "</ol><hr/>";


        // еще один вариант создания
        $numbers = array(5, 7, 9, 11, -5, 21);
        echo "<h3>Вывод циклом типа while</h3><ul>";
        $i = 0;    // цикл типа while
        while($i < count($numbers)) {
            echo "<li>$numbers[$i]</li>";
            ++$i;
        } // while
        echo "</ul><hr/>";

        echo "<h3>Альтернативный while</h3><ul>";
        $i = 0;    // цикл типа while
        while($i < count($numbers)):
            echo "<li>$numbers[$i]</li>";
            ++$i;
        endwhile;
        echo "</ul><hr/>";


		// удаление элемента массива
		echo "<h3>Удаление элементов массива, всего массива</h3>";
        // еще один вариант создания массива
		$arr = [31, 32, 33, 34, 35, 36, 37, 38, 39];
		print_r($arr);
        echo "<br>";
		unset($arr[1]);
		print_r($arr);

		echo "<h4>Переиндексация массива</h4>";
		$arr = array_values($arr);
		print_r($arr);

		// удаление массива (любой переменной)
		echo "<h4>Удаление массива, любой переменной</h4>";
		$length = count($arr);
		echo "<span style='color: darkgreen;'>Размер массива до удаления: $length</span><br/>";

		// удаление всего массива, будет сообщение о неопределенной переменной
		// unset($arr);
		// $length = count($arr);
		// echo "<span style='color: darkgreen;'>Размер массива после удаления: $length</span><br/>";


        echo '<h3>Ассоциативный массив</h3>';
        // Ассоциативные массивы, PHP 7.x -- русские символы - UTF-8, индексирование строками
        $persons = array(
            // ключ   => значение
            "Петров"  => "Вася",
            "Иванова" => "Оля",
            "Сидорова"=> "Тома",
            "Федоров" => "Егор",
            "Синицын" => "Артем",
            "Носов"   => "Вася"
            );

        // варианты быстрого вывода агрегатных переменных
        echo 'print_r():<br/>';
        print_r($persons);
        echo '<br/>';
        echo '<br/>var_dump():<br/>';
        var_dump($persons);

        // индексирование по ключу
        printf("<h4>Индексирование по ключу \"Федоров\"</h4>%s<br/>", $persons["Федоров"]);


        // перебор значений ассоциативного массива
        echo "<h4>Перебор ассоциативного массива, вывод значений</h4><ul>";
        // цикл типа "для каждого"
        foreach ($persons as $person) {
            echo "<li>$person</li>";
        }
        echo "</ul>";

        echo "<h4>Перебор ассоциативного массива, вывод значений/альтернативный синтаксис</h4><ul>";
        // цикл типа "для каждого"
        foreach ($persons as $person):
            echo "<li>$person</li>";
        endforeach;
        echo "</ul>";

        // запись в массив ассоциативный
        $name = "Оксана";
        $surname = "Ореховая";
        $persons[$surname] = $name;

        // имена переменных произвольны, в д.с. используем смысловую
        // нагрузку имен - ключ ($key), значение ($value)
        echo "<h4>Перебор пар ключ - значение ассоциативного массива</h4><ul>";
        foreach ($persons as $key => $value) {
            echo "<li>фамилия: $key -  имя: $value</li>";
        }
        echo "</ul>";

        echo "<hr>><h4>Перебор пар ключ - значение ассоциативного массива/альтернативный синтаксис</h4><ul>";
        foreach ($persons as $surname => $name) {
            echo "<li>фамилия: $surname  -  имя: $name</li>";
        }
        echo "</ul>";

        // удалить запись по ключу
        unset($persons["Петров"]);

        // изменить запись по ключу
        $persons["Сидорова"] = "Тамара";

        echo "<hr>><h4>Удалена запись с ключом 'Петров', изменена запись с ключом 'Сидорова'</h4><ul>";
        foreach ($persons as $surname => $name) {
            echo "<li>фамилия: $surname  -  имя: $name</li>";
        }
        echo "</ul>";


        echo "<hr/><h3>Сортировка массивов</h3>";
        $systems = array(
            "Windows 2000", "Windows XP", "Windows 7", "Windows 95", "Windows 8",
            "Windows 11", "Windows 10");
        print_r($systems);
        echo "<br/>";

        asort($systems);  // сортировка

        echo "asort: ";
        // foreach применим и для обычных массивов
        foreach ($systems as $value) {
            echo "$value  ";
        }
        echo "<br/>";

        // "правильная" сортировка
        natsort($systems);

        echo "natsort: ";
        foreach ($systems as $value) {
            echo "$value  ";
        }
        echo "<br/><br/>";

        // по ключу
        ksort($persons);
        echo "ksort:<br/>";
        echo "<br/>Ассоциативный массив отсортирован по ключам - фамилиям<br/><ul>";
        foreach ($persons as $key => $value) {
            echo "<li>$key $value</li>";
        }
        echo "</ul>";

        // TODO: сортировка массива ассоциативного по значениям - самостоятельно


        $a = array(15, 16, -25, 18, 12, -19, 99, -59, 92, 92, 27);
        echo "Исходный массив: ";
        foreach ($a as $value) {
            echo "$value | ";
        }
        echo "<br/>";

        // Классическая пользовательская сортировка с компаратором
        // компаратор для usort() - анонимная функция, альтернативный синтаксис условного
        // оператора с else if
        $compare = function ($a, $b) {
            if ($a < $b):
                $result = -1;
            elseif ($a > $b):
                $result = 1;
            else:
                $result = 0;
            endif;
            return $result;
        }; // compare

        usort($a, $compare);

        // вывод массива, альтернативный синтаксис цикла
        echo "usort (возрастание, классика): ";
        foreach ($a as $value):
            echo "$value  | ";
        endforeach;
        echo "<br/>";


        // пример использования оператора <=> в компараторе при сортировке
        // PHP7
        // $a <=> $b
        //   $a <  $ b: -1
        //   $a == $ b:  0
        //   $a >  $ b:  1
        $a = array(15, 16, -25, 18, 12, -19, 99, -59, 92, 92, 27);

        // использование анонимной функции
        usort($a, function($a, $b) { return $a <=> $b; });
        echo "usort (возрастание, оператор <=>): ";
        foreach ($a as $value) {
            echo "$value  | ";
        }
        echo "<br/>";

        // пример стрелочной функции - лямбда-выражения
        // fn(параметры) => выражение
        usort($a, fn($a, $b) => $b <=> $a);
        echo "usort (убывание, оператор <=>, стрелочная функция): ";
        foreach ($a as $value) {
            echo "$value  | ";
        }
        echo "<br/><br/>";


        // примеры использования функций для обработки массивов
        // array_merge()
        // array_slice()
        print("<h3>Функция array_merge()</h3>");
        $a = [5, 6, 8, 1, 9, 2, 7];
        $b = [-3, -4, -2];
        echo "<span style='color: blue;'>Исходные массивы:</span><br/>";
        echo "Массив a: "; print_r($a); echo "<br/>";
        echo "Массив b: "; print_r($b); echo "<br/><br/>";

        $a = array_merge($a, $b);
        echo "<span style='color: blue;'>Массивы после применения функции".
             " \$a = array_merge(\$a, \$b):</span><br/>";
        echo "Массив a: "; print_r($a); echo "<br/>";
        echo "Массив b: "; print_r($b); echo "<br/><br/>";

       
        print("<h3>Функция array_slice()</h3>");
        // вернуть массив из 5и элементов массива $a, начиная с индекса 1
        $arr = array_slice($a, 1, 5);
        echo "<span style='color: blue;'>Массивы после применения функции".
             " \$arr = array_slice(\$a, 1, 5):</span><br/>";
        echo 'Массив $arr: '; print_r($arr); echo '<br>';
        echo 'Массив $a: '; print_r($arr);
        echo "<br/><hr/>";
	?>
	
	<h3>Многомерные массивы</h3>
    <?php
        $matrix = [];  // матрица - массив массивов, т.е. м.б. зубчатым массивом
        const ROWS = 5;  // строк в матрице
        const COLS = 7;  // столбцов в матрице

        // создание матрицы
        for ($i = 0; $i < ROWS; $i++) {
            // создаем массив строк матрицы
            $matrix[$i] = [];  // добавить ссылку на строку матрицы

            // заполняем строку элементами
    	    for($j = 0; $j < COLS; $j++) {
                $matrix[$i][$j] = random_int(-100, 100);
            } // for $j
        } // for $i

        echo "<h3>Матрица - классический вывод</h3><table>";
        for ($i = 0; $i < ROWS; $i++) {
    	    echo "<tr>";
            for($j = 0; $j < COLS; $j++)
                echo "<td style='width: 60px; text-align: right;'>".$matrix[$i][$j]."</td>";
    	    echo "</tr>";
        } // for $i
        echo "</table>";

        echo "<h3>Матрица - вывод циклами 'для каждого'</h3><table>";
        foreach ($matrix as $row) {
    	    echo "<tr>";
            foreach($row as $item)
                echo "<td style='width: 60px; text-align: right;'>$item</td>";
    	    echo "</tr>";
        }
        echo "</table>";

        // заполнение одномерного массива через array_xxxx()
        // array_pad — Дополнить размер массива определенным значением до заданной величины
        // array_map — Применяет callback-функцию ко всем элементам указанных массивов
        $n = 23;
        $data = array_map(fn() => rand(-100, 100), array_pad([], $n, 0));

        echo "<h3>Массив заполнен случайными числами:</h3>";
        echo "<table cellpadding='6px'><tr>";
        foreach ($data as $datum): echo "<td>$datum</td>"; endforeach;
        echo "</tr></table>";

        echo "<h4>Статистика по массиву:</h4>";
        // размер массива, количество положительных элементов массива,
        // суммма положительных элеменитов массива
        $lenData = count($data);
        $positives = array_filter($data, fn($datum) => $datum >= 0);
        $sumPositives = array_sum($positives);
        echo "<ul> 
            <li>Всего элементов: <b>$lenData</b></li>
            <li>Всего положительных элементов: <b>".count($positives)."</b></li>
            <li>Суммма элементов: <b>$sumPositives</b></li>
        </ul>";
    ?>
</body>
</html>
