<?php

require_once "../infrastructure/layout.php";    // layout страницы
require_once "../infrastructure/utils.php";     // утилиты
require_once "../app/task.php";                 // решение задания

// разметка
$html = <<<EOF

<section class="mx-5 my-4 bg-light shadow-sm border rounded-3 min-vh-100 p-3">
    <h4 class="text-center">Диапазон. Proc11
        <button class="btn btn-outline-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false"
              aria-controls="collapseExample">Спецификация</button>
    </h4>    
    
    <!-- Спецификация -->
    <div class="collapse" id="collapseExample">
        <div class="card card-body">
            <p>
                <b>Proc11</b>. Описать функцию minMax(x, y), записывающую в переменную x минимальное из значений x и y,
                а в переменную y — максимальное из этих значений (x и y — вещественные параметры, являющиеся
                одновременно входными и выходными). Используя четыре вызова этой функции, найти минимальное и
                максимальное из данных чисел a, b, c, d.
            </p>
        </div>
    </div>
    
    <hr>
    
    <!-- Таблица -->
    <table class="table table-borderless table-striped">
        <thead>
            <tr>
                <th>Число A</th>
                <th>Число B</th>
                <th>Число C</th>
                <th>Число D</th>
                <th>Минимум</th>
                <th>Максимум</th>
            </tr>
        </thead>
        <tbody>
EOF;


// генерация данных
$a = random_float(10, 40);
$b = random_float(10, 40);
$c = random_float(10, 40);
$d = random_float(10, 40);

// вывод a, b, c, d
$html .= <<<EOF
        <tr>
            <td>$a</td>
            <td>$b</td>
            <td>$c</td>
            <td>$d</td>
    EOF;

// поиск минимального и максимального элементов
minMax($a, $b);
$min = $a;

minMax($b, $c);
$min = min($b, $min);

minMax($c, $d);
$min = min($c, $min);

minMax($a, $d);
$min = min($a, $min);

// вывод минимального и максимальное значение
$html .= <<<EOF
            <td>$min</td>    
            <td>$d</td>    
        </tr>  
    EOF;

// окончание блока разметки
$html .= <<<EOF
            </tbody>    
        </table>
    </section>
    EOF;


// рендеринг страницы с layout
renderLayout("proc11", $html, "Диапазон");