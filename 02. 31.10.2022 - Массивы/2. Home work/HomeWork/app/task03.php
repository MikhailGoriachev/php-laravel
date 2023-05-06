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
function showArray(array &$array, string $title, $isActive = null, array $rightCol = null,
                   array $bottomRow = null, string $content = ''): void
{
    $isActive = $isActive ?: fn() => "";

    $html = '';

    $rows = count($array);
    $cols = count($array[0]);

    for ($i = 0; $i < $rows; $i++) {
        $html .= '<div class="row">';
        for ($k = 0; $k < $cols; $k++) {
            $val = $array[$i][$k];
            $html .= "<div class='border m-2 p-2 shadow-sm col text-center rounded {$isActive($val)}'>$val</div>";
        }
        if ($rightCol)
            $html .= "<div class='border m-2 p-2 shadow-sm col text-center rounded bg-light-green'>$rightCol[$i]</div>";
        $html .= '</div>';
    }

    if ($bottomRow) {
        $html .= '<div class="row">' .
            array_reduce($bottomRow, fn($prev, $a) => $prev . "<div class='border m-2 p-2 shadow-sm col text-center rounded bg-light-green'>$a</div>")
            . '</div>';
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
        $result[] = min($array[$i]) < 0 ? array_sum($array[$i]) : null;
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

        $result[] = max($column) >= 0 ? array_sum($column) : null;
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

    $result = [];

    for ($i = 0; $i < $cols; $i++) {
        $col = array_column($array, $i);
        $result[] = $sumFunc($col);
    }

    return $result;
}

// •	Характеристикой строки назовем количество положительных четных элементов. Переставляя строки матрицы,
//      расположить их по возрастанию характеристик. Вывести матрицу и массив характеристик
function point05(array &$array): array
{
    $rows = count($array);

    // получить количество положительных четных элементов
    $countFunc = fn(array &$arr) => count(array_filter($arr, fn($a) => $a > 0 && ($a & 1) === 0));

    // перебираем массив
    for ($j = 0; $j < $rows - 1; $j++) {
        for ($i = 0; $i < $rows - $j - 1; $i++) {
            if ($countFunc($array[$i]) > $countFunc($array[$i + 1])) {
                [$array[$i], $array[$i + 1]] = [$array[$i + 1], $array[$i]];
            }
        }
    }

    $result = [];

    for ($i = 0; $i < $rows; $i++) {
        $result[] = $countFunc($array[$i]);
    }

    return array_map($countFunc, $array);
}

// •	Удалить строки матрицы с минимальной и максимальной характеристиками
function point06(array &$array): array
{
    // массив сумм строк
    $sumArr = array_map(fn($row) => array_sum($row), $array);

    // минимальное и максимальное значения строк
    $minSum = min($sumArr);
    $maxSum = max($sumArr);

    // поиск индекса минимальной и максимальной строк
    $minRow = array_search($minSum, $sumArr);
    $maxRow = array_search($maxSum, $sumArr);

    // удаление строк из матрицы
    unset($array[$minRow], $array[$maxRow]);

    $array = array_values($array);

    return $sumArr;
}