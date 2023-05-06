<?php

//$pathToRoot = '../../../../';

ob_start();     // захват контента

?>
    <section class="mx-5 my-4 bg-light shadow-sm border rounded-3 min-vh-100 p-3">

        <h4 class="text-center">Персоны
            <button class="btn btn-primary" id="updateBtnId">Обновить</button>
        </h4>

        <div id="containerId"></div>

    </section>


<?php

$htmlBody = ob_get_clean();     // получение захваченного контента
$title = "Персоны";
$activeTab = "task01Tables";

$headers = '<script src="/src/scripts/task01/tables/people.js"></script>';

require_once "../../../../Infrastructure/layout.php";       // layout страницы