<?php

require_once '../infrastructure/utils.php';

// Задача 1. Обработка одномерных массивов. В одномерном массиве, состоящем из n вещественных чисел выполнить:
// •	Заполнение массива случайными числами
// •	Вычислить количество элементов массива, равных нулю 
// •	Вычислить количество отрицательных элементов массива
// •	Вычислить сумму элементов массива, расположенных после минимального элемента
// •	Вычислить сумму модулей элементов массива, расположенных после минимального по модулю элемента
// •	Упорядочить элементы массива по возрастанию модулей
// •	Упорядочить элементы массива по убыванию
// •	Упорядочить элементы массива по правилу «отрицательные в начало массива»
// •	Заменить все отрицательные элементы массива их квадратами и упорядочить элементы массива по возрастанию
// •	Заполнить массив новым набором случайных чисел, содержащих в том числе и отрицательные значения. Вывести
//      сформированный массив. Удалить из массива все отрицательные элементы массива
// •	После первого элемента и перед последними элементом массива вставить элемент со значением -ддмм, где дд – цифры
//      текущей даты, мм – цифры текущего месяца. Так, для 31 октября это будет 3110; для 3 ноября - 311.
// При решении как можно шире используйте стандартные функции для работы с массивами (возможно, с callback-функциями),
// минимизируйте использование циклов.

// вывод массива
function showArray(array &$array, string $title, $isActive = null): void
{
    $isActive = $isActive ?: fn() => ""; 
    $html = array_reduce($array,
        fn($prev, $a) => $prev . sprintf(
            "<div class='border mx-2 p-2 shadow-sm col text-center rounded {$isActive($a)}'>%.3f</div>", $a),
        ''
    );

    if (count($array) <= 0)
        $html = "<h4>Нет данных</h4>";

    echo "<div class='m-3 p-3 border shadow rounded'><h5>$title</h5><div class='row mt-3'>" . $html . '</div></div>';
}

// заполнение массива случайными числами
function init(array &$array, int $n = 10, int $zeroCount = 0): void
{
    $array = [
        ...array_map(fn() => random_float(-50, 50), array_pad($array, $n - $zeroCount, 0)),
        ...$zeroCount > 0 ? array_fill(0, $zeroCount, 0) : []
    ];
    
    shuffle($array);
}


// вычислить количество элементов массива, равных нулю
function point01(array &$array): int
{
    return count(array_filter($array, fn($a) => abs($a) < 1e-7));
}

// вычислить количество отрицательных элементов массива
function point02(array &$array): int
{
    return count(array_filter($array, fn($a) => $a < 0));
}

// вычислить сумму элементов массива, расположенных после минимального элемента
function point03(array &$array): float
{
    return array_sum(array_slice($array, array_search(min($array), $array) + 1));
}

// вычислить сумму модулей элементов массива, расположенных после минимального по модулю элемента
function point04(array &$array): float
{
    $moduleArray = array_map(fn($a) => abs($a), $array);
    return array_sum(array_slice($moduleArray, array_search(min($moduleArray), $moduleArray) + 1));
}

// упорядочить элементы массива по возрастанию модулей
function point05(array &$array): void
{
    usort($array, fn($a, $b) => abs($a) <=> abs($b));
}

// упорядочить элементы массива по убыванию
function point06(array &$array): void
{
    rsort($array);
}

// упорядочить элементы массива по правилу «отрицательные в начало массива»
function point07(array &$array): void
{
    usort($array, fn($a, $b) => $a < 0 && $b < 0 ? 0 : ($a < 0 && $b >= 0 ? -1 : 1));
}

// заменить все отрицательные элементы массива их квадратами и упорядочить элементы массива по возрастанию
function point08(array &$array): void
{
    array_walk($array, fn(&$a) => $a = $a < 0 ? $a ** 2 : $a);
    sort($array);
}

// заполнить массив новым набором случайных чисел, содержащих в том числе и отрицательные значения. Вывести
// сформированный массив. Удалить из массива все отрицательные элементы массива
function point09(array &$array): void
{
    $n = count($array);

    for ($i = 0; $i < $n; $i++)
        if ($array[$i] < 0)
            unset($array[$i]);

    $array = array_values($array);
}

// после первого элемента и перед последними элементом массива вставить элемент со значением -ддмм, где дд – цифры
// текущей даты, мм – цифры текущего месяца. Так, для 31 октября это будет 3110; для 3 ноября - 311.
function point10(array &$array): void
{
    $count = count($array);

    if ($count <= 0)
        return;

    $date = getdate(time());
    $value = -($date['mday'] * 100) + $date['mon'];
    $array = [$array[0], $value, ...array_slice($array, 1, $count - 1), $value, $array[$count - 1]];
}