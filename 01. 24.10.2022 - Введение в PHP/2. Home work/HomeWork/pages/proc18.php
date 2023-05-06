<?php

require_once "../infrastructure/layout.php";    // layout страницы
require_once "../infrastructure/utils.php";     // утилиты
require_once "../app/task.php";                 // решение задания

// разметка
$html = <<<EOF

<section class="mx-auto my-4 bg-light shadow-sm border rounded-3 min-vh-100 p-3 w-50">
    <h4 class="text-center">Площадь круга. Proc18
        <button class="btn btn-outline-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false"
              aria-controls="collapseExample">Спецификация</button>
    </h4>    
    
    <!-- Спецификация -->
    <div class="collapse" id="collapseExample">
        <div class="card card-body">
            <p>
                <b>Proc18</b>. Описать функцию circleS(r), находящую площадь круга радиуса r (r — вещественное). С
                помощью этой функции найти площади трех кругов с радиусами – случайными числами. Площадь круга радиуса R
                вычисляется по формуле S = π·R2.
            </p>
        </div>
    </div>
    
    <hr>
    
    <!-- Таблица -->
    <table class="table table-borderless table-striped mx-auto">
        <thead>
            <tr>
                <th>№</th>
                <th>Радиус</th>
                <th>Площадь</th>
            </tr>
        </thead>
        <tbody>
EOF;

// обработка и вывод в таблицу
calcAndToTable(random_float(10, 40));
calcAndToTable(random_float(10, 40));
calcAndToTable(random_float(10, 40));

// соротировка и вывод данных
function calcAndToTable(float $r): void
{
    static $n = 0;
    global $html;

    $n++;
    $s = round(circleS($r), 5);
    
    // вывод a, b, c, d
    $html .= <<<EOF
        <tr>
            <td>$n</td>
            <td>$r</td>
            <td>$s</td>
        </tr>
    EOF;
}


// окончание блока разметки
$html .= <<<EOF
            </tbody>    
        </table>
    </section>
    EOF;


// рендеринг страницы с layout
renderLayout("proc18", $html, "Площадь круга");