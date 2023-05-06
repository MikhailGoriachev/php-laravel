<?php

// Задача 3. Обработка многомерных массивов. В прямоугольной матрице выполните:
// •	Заполнение матрицы случайными целыми числами
// •	Вычислить сумму элементов в тех строках, которые содержат хотя бы один отрицательный элемент, вывести матрицу
//      с этими суммами
// •	Вычислить сумму элементов в тех столбцах, которые содержат хотя бы один положительный элемент, вывести матрицу
//      с этими суммами
// •	Индексы строк и столбцов всех седловых точек матрицы. Элемент матрицы Aij является седловой точкой, если он
//      минимальный в i-й строке и максимальный в j-м столбце
// •	Характеристикой столбца назовем сумму модулей его отрицательных нечетных элементов. Переставляя столбцы матрицы,
//      расположить их по убыванию характеристик. Вывести матрицу и массив характеристик
// •	Характеристикой строки назовем количество положительных четных элементов. Переставляя строки матрицы,
//      расположить их по возрастанию характеристик. Вывести матрицу и массив характеристик
// •	Удалить строки матрицы с минимальной и максимальной характеристиками


// •	Заполнение матрицы случайными целыми числами
function init(int $rows = 6, int $cols = 8): array
{
    return array_map(fn() => array_map(fn() => random_int(-5, 20),
        array_pad([], $cols, 0)),
        array_pad([], $rows, 0));
}

// вывод массива
function showArray(array &$array, string $title, $isActive = null, string $content = ''): void
{
    $isActive = $isActive ?: fn() => "";

    $html = '';
    foreach ($array as $row) {

        $html .= '<div class="row">';
        foreach ($row as $col) {
            $html .= "<div class='border m-2 p-2 shadow-sm col text-center rounded {$isActive($col)}'>$col</div>";
        }
        $html .= '</div>';
    }

    if (count($array) <= 0)
        $html = "<h4>Нет данных</h4>";

    echo "<div class='m-3 p-3 border shadow rounded'><h5 class='text-center'>$title</h5>$html$content</div>";
}

// •	Вычислить сумму элементов в тех строках, которые содержат хотя бы один отрицательный элемент, вывести матрицу
//      с этими суммами
function point01(array &$array): array
{
    $result = [];

    $rows = count($array);

    for ($i = 0; $i < $rows; $i++) {
        if (min($array[$i]) < 0)
            $result[] = ["row" => $i, "sum" => array_sum($array[$i])];
    }

    return $result;
}

// •	Вычислить сумму элементов в тех столбцах, которые содержат хотя бы один положительный элемент, вывести матрицу
//      с этими суммами
function point02(array &$array): array
{
    $result = [];

    $count = count($array[0]);

    for ($i = 0; $i < $count; $i++) {
        $column = array_column($array, $i);

        if (max($column) >= 0)
            $result[] = ["col" => $i, "sum" => array_sum($column)];
    }

    return $result;
}

// •	Индексы строк и столбцов всех седловых точек матрицы. Элемент матрицы Aij является седловой точкой, если он
//      минимальный в i-й строке и максимальный в j-м столбце
function point03(array &$array): array
{
    $result = [];

    $rows = count($array);
    $cols = count($array[0]);

    for ($i = 0; $i < $rows; $i++) {

        $minRow = min($array[$i]);

        for ($j = 0; $j < $cols; $j++) {
            $maxCol = max(array_column($array, $j));

            $val = $array[$i][$j];

            if ($val === $minRow && $val === $maxCol)
                $result[] = ['row' => $i, 'col' => $j, 'value' => $val];
        }
    }

    return $result;
}

// •	Характеристикой столбца назовем сумму модулей его отрицательных нечетных элементов. Переставляя столбцы матрицы,
//      расположить их по убыванию характеристик. Вывести матрицу и массив характеристик
function point04(array &$array): array
{
    $result = [];

    $count = count($array[0]);

    $cols = count($array[0]);
    $rows = count($array);

    // получить сумму отрицательных нечётных элементов столбца
    $sumFunc = fn(array &$arr) => array_sum(array_map(fn($a) => abs($a), array_filter($arr, fn($a) => $a < 0 && ($a & 1) === 1)));

    // перебираем массив
    for ($j = 0; $j < $cols - 1; $j++) {
        for ($i = 0; $i < $cols - $j - 1; $i++) {
            $colA = array_column($array, $i);
            $colB = array_column($array, $i + 1);

            // если текущий элемент больше следующего
            if ($sumFunc($colA) < $sumFunc($colB)) {

                for ($k = 0; $k < $rows; $k++) {
                    [$array[$k][$i], $array[$k][$i + 1]] = [$array[$k][$i + 1], $array[$k][$i]];
                }
            }
        }
    }

    return $result;
}

// •	Характеристикой строки назовем количество положительных четных элементов. Переставляя строки матрицы,
//      расположить их по возрастанию характеристик. Вывести матрицу и массив характеристик
function point05(array &$array): array
{
    $result = [];

    $count = count($array[0]);

    $cols = count($array[0]);
    $rows = count($array);

    // получить сумму отрицательных нечётных элементов столбца
    $sumFunc = fn(array &$arr) => array_sum(array_map(fn($a) => abs($a), array_filter($arr, fn($a) => $a > 0 && ($a & 1) === 0)));

    // перебираем массив
    for ($j = 0; $j < $cols - 1; $j++) {
        for ($i = 0; $i < $cols - $j - 1; $i++) {
            $colA = array_column($array, $i);
            $colB = array_column($array, $i + 1);

            // если текущий элемент больше следующего
            if ($sumFunc($colA) > $sumFunc($colB)) {

                for ($k = 0; $k < $rows; $k++) {
                    [$array[$k][$i], $array[$k][$i + 1]] = [$array[$k][$i + 1], $array[$k][$i]];
                }
            }
        }
    }

    return $result;
}

// •	Удалить строки матрицы с минимальной и максимальной характеристиками
 