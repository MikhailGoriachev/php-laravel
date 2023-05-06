<?php

// Задача 2. В ассоциативном массиве требуется хранить названия стран (ключи) и население этих стран (по данным
// Википедии, например 😊). Выполните следующие обработки массива:
// •	вывод неупорядоченного массива
// •	вывод массива, упорядоченного по ключам
// •	вывод массива, упорядоченного по значениям 

// инициализация массива
function init(): array
{
    return array(
        'Украина' => 41,
        'Италия' => 58,
        'Швейцария' => 8.5,
        'Германия' => 83,
        'Великобритания' => 67,
        'Фарнция' => 68,
        'Нидерланды' => 17.6,
        'Соединённые Штаты Америки' => 336,
        'Финляндия' => 5.5,
        'Литва' => 2.7
    );
}

// вывод массива
function showArray(array &$array, string $title): void
{
    $html = '';
    $n = 1;
    foreach ($array as $key => $value) {
        $html .= sprintf("<tr><td>%d</td><td>$key</td><td>%.1f млн. чел.</td></tr>", $n++, $value);
    }

    if (count($array) <= 0)
        $html = "<h4>Нет данных</h4>";

    echo "<div class='m-3 p-3 border shadow rounded'>
            <h5 class='text-center'>$title</h5>
            <table class='table table-striped'>
                <thead>
                    <tr>
                        <th>№</th>
                        <th>Страна</th>
                        <th>Население</th>
                    </tr>
                </thead>
                <tbody>
                    $html
                </tbody>
            </table>
            </div>";
}

// вывод массива, упорядоченного по ключам
function orderByKey(array &$array): void {
    ksort($array);    
}


// вывод массива, упорядоченного по значениям
function orderByValue(array &$array): void {
    natcasesort($array);
}