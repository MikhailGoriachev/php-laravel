<?php

use App\Task01\Variant12;
use App\Task01\Variant15;

spl_autoload_register(fn($className) => require $fileName = '..\\..\\' . $className . '.php');

ob_start();     // захват контента

$variant12 = new Variant12(0, 1, 3, 4);
$variant15 = new Variant15(-4, 1, 3, 4);

?>
    <section class="mx-5 my-4 bg-light shadow-sm border rounded-3 min-vh-100 p-3">

        <h4 class="text-center">Задание 1</h4>

        <?php
        // заполнение матрицы
        $variant12->fill();

        // сумма элементов в столбцах
        $sumCols = $variant12->sumCols();

        // вывод матрицы
        $variant12->showArray("Вариант 12. До обработки", fn($a) => $a !== 0 ?: 'bg-secondary text-white', null, $sumCols);

        // обраобтка по заданию
        $result = $variant12->run();

        // первая строка с положительным элементом
        $firstNullRow = $result['firstNullRow'] ?? 'Все элементы отррицательные';

        // вывод матрицы
        $variant12->showArray("Вариант 12. После обработки. Первая строка с положительным элементом: $firstNullRow (может быть удалена)",
            fn($a) => $a !== 0 ?: 'bg-secondary text-white', null, $result['sumCols']);


        // заполенение матрицы
        $variant15->fill();

        // вывод матрицы
        $variant15->showArray("Вариант 15. До обработки. Кол-во столбцов с нулевым значением: {$variant15->getCountColsNullValue()}", fn($a) => $a !== 0 ?: 'bg-secondary text-white', $variant15->getState());

        // обработка по заданию
        $result = $variant15->run();

        // первый столбец с нулевым значением
        $firstNullCol = $result['firstNullCol'] ?? 'Нет нулей';

        // вывод матрицы
        $variant15->showArray("Вариант 15. После обработки. Первый столбец с нулевым элементом: $firstNullCol; 
                                    Кол-во столбцов с нулевым значением: {$variant15->getCountColsNullValue()}",
            fn($a) => $a !== 0 ?: 'bg-secondary text-white', $variant15->getState());
        ?>

    </section>


<?php

$htmlBody = ob_get_clean();     // получение захваченного контента
$title = "Матрицы";
$activeTab = "task01Page";

require_once "../../Infrastructure/layout.php";       // layout страницы