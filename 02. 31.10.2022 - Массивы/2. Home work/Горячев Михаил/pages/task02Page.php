<?php
require_once "../infrastructure/layout.php";       // layout страницы
require_once "../app/task02.php";               // обработка по заданию
ob_start();     // захват контента
?>
    <section class="mx-5 my-4 bg-light shadow-sm border rounded-3 min-vh-100 p-3">
        <h4 class="text-center">Задание 2. Ассоциативные массивы</h4>

        <?php

        // генерация массива
        $array = init();

        // исходные данные
        showArray($array, 'Исходные данные');

        // упорядоченного по ключам
        orderByKey($array);
        showArray($array, 'Упорядочивание по ключам');

        // упорядоченного по значениям
        orderByValue($array);
        showArray($array, 'Упорядочивание по значениям');

        ?>
    </section>

<?php
$html = ob_get_clean();     // получение захваченного контента
renderLayout("task02Page", $html, "Ассоциативные массивы");        // рендеринг страницы с layout