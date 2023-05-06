<?php

require_once "../infrastructure/layout.php";    // layout страницы
require_once "../infrastructure/utils.php";     // утилиты
require_once "../app/task.php";                 // решение задания

// разметка
$html = <<<EOF

<section class="mx-5 my-4 bg-light shadow-sm border rounded-3 min-vh-100 p-3">
    <h4 class="text-center">Равносторонние треугольники. Proc4
        <button class="btn btn-outline-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false"
              aria-controls="collapseExample">Спецификация</button>
    </h4>    
    
    <!-- Спецификация -->
    <div class="collapse" id="collapseExample">
        <div class="card card-body">
            <p>
                <b>Proc4</b>. Описать функцию trianglePS(a, p, s), вычисляющую по стороне a равностороннего треугольника
                его периметр p = 3·a и площадь s = a2· sqrt(3)/4 (a — входной, p и s — выходные параметры). С помощью
                этой функции найти периметры и площади трех равносторонних треугольников с данными сторонами.
            </p>
        </div>
    </div>
    
    <hr>
    
    <!-- Таблица -->
    <table class="table table-borderless table-striped">
        <thead>
            <tr>
                <th>№</th>
                <th>Сторона A</th>
                <th>Сторона B</th>
                <th>Сторона C</th>
                <th>Периметр</th>
                <th>Площадь</th>
            </tr>
        </thead>
        <tbody>
EOF;

// обработка и вывод в строку таблицы по заданию
function calcAndRowTable(float $a): void
{
    static $n = 0;
    global $html;

    $n++;
    
    // периметр и площадь
    $p = 0.;
    $s = 0.;

    // вычисление данных
    trianglePS($a, $p, $s);

    // округление дробной части
    $p = round($p, 5);
    $s = round($s, 5);
    
    $html .= <<<EOF
        <tr>
            <td>$n</td>
            <td>$a</td>
            <td>$a</td>
            <td>$a</td>
            <td>$p</td>
            <td>$s</td>
        </tr>
    EOF;
}

// вычисление и вывод в строку разметки таблицы
calcAndRowTable(random_float(10, 40));
calcAndRowTable(random_float(10, 40));
calcAndRowTable(random_float(10, 40));

// окончание блока разметки
$html .= <<<EOF
            </tbody>    
        </table>
    </section>
    EOF;


// рендеринг страницы с layout
renderLayout("proc4", $html, "Равносторонние треугольники");