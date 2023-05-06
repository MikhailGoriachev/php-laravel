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
        $variant12->fill();
        $variant12->showArray("Вариант 12. До обработки", fn($a) => $a !== 0 ?: 'bg-secondary text-white');
        $result = $variant12->run();
        $firstNullRow = $result['firstNullRow'] ?? 'Нет нулей';
        $variant12->showArray("Вариант 12. После обработки. Первая строка с нулевым элементом: $firstNullRow (может быть удалена)",
            fn($a) => $a !== 0 ?: 'bg-secondary text-white');
        
        $variant15->fill();
        $variant15->showArray("Вариант 15. До обработки", fn($a) => $a !== 0 ?: 'bg-secondary text-white', $variant15->getState());
        $result = $variant15->run();
        $firstNullCol = $result['firstNullCol'] ?? 'Нет нулей';
        $variant15->showArray("Вариант 15. После обработки. Первый столбец с нулевым элементом: $firstNullCol",
            fn($a) => $a !== 0 ?: 'bg-secondary text-white', $variant15->getState());
        ?>

    </section>


<?php

$htmlBody = ob_get_clean();     // получение захваченного контента
$title = "Задание 1";
$activeTab = "task01Page";

require_once "../../Infrastructure/layout.php";       // layout страницы