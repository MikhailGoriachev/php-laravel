<?php

require_once "../infrastructure/layout.php";    // layout страницы
require_once "../infrastructure/utils.php";     // утилиты
require_once "../app/task.php";                 // решение задания

// разметка
$html = <<<EOF

<section class="mx-auto my-4 bg-light shadow-sm border rounded-3 min-vh-100 p-3 w-50">
    <h4 class="text-center">Сортировка. Proc12
        <button class="btn btn-outline-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false"
              aria-controls="collapseExample">Спецификация</button>
    </h4>    
    
    <!-- Спецификация -->
    <div class="collapse" id="collapseExample">
        <div class="card card-body">
            <p>
                <b>Proc12</b>. Описать функцию sortInc3(a, b, c), меняющую содержимое переменных a, b, c таким образом,
                чтобы их значения оказались упорядоченными по возрастанию (a, b, c — вещественные параметры, являющиеся
                одновременно входными и выходными). С помощью этой функции упорядочить по возрастанию два данных набора
                из трех чисел: (a1, b1, c1) и (a2, b2, c2).
            </p>
        </div>
    </div>
    
    <hr>
    
    <!-- Таблица -->
    <table class="table table-borderless table-striped mx-auto">
        <thead>
            <tr>
                <th>Число A</th>
                <th>Число B</th>
                <th>Число C</th>
            </tr>
        </thead>
        <tbody>
EOF;

// генерация данных
$a1 = random_float(10, 40);
$b1 = random_float(10, 40);
$c1 = random_float(10, 40);

$a2 = random_float(10, 40);
$b2 = random_float(10, 40);
$c2 = random_float(10, 40);

sortAndToTable($a1, $b1, $c1);

sortAndToTable($a2, $b2, $c2);

// соротировка и вывод данных
function sortAndToTable(float $a, float $b, float $c): void
{
    global $html;

    // вывод a, b, c, d
    $html .= <<<EOF
        <tr>
            <th colspan="3" class="text-center">Исходная последовательность</th>
        </tr>
        <tr>
            <td>$a</td>
            <td>$b</td>
            <td>$c</td>
        </tr>
    EOF;

    // сортировка
    sortInc3($a, $b, $c);

    // вывод минимального и максимальное значение
    $html .= <<<EOF
            <tr>
                <th class="text-center" colspan="3">Отсортированные данные</th>
            </tr>
            <tr>
                <td>$a</td>
                <td>$b</td>
                <td>$c</td>
            </tr>    
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
renderLayout("proc12", $html, "Сортировка");