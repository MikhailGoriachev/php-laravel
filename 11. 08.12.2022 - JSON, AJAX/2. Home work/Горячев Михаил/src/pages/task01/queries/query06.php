<?php

ob_start();     // захват контента

?>
    <section class="mx-5 my-4 bg-light shadow-sm border rounded-3 min-vh-100 p-3">

        <h4 class="text-center">Запрос 06</h4>

        <div id="containerId"></div>

    </section>

<?php

$htmlBody = ob_get_clean();     // получение захваченного контента
$title = "Запрос 06";
$activeTab = "task01Queries";

$headers = '<script src="/src/scripts/task01/queries/query06.js"></script>';

require_once "../../../../Infrastructure/layout.php";       // layout страницы