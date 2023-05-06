<?php

use App\Task02;

spl_autoload_register(fn($className) => require $fileName = '..\\..\\..\\' . $className . '.php');

ob_start();     // захват контента

$task = new Task02();

?>
    <section class="mx-5 my-4 bg-light shadow-sm border rounded-3 min-vh-100 p-3">
        
        <h4 class="text-center">Запрос 06</h4>

        <?= $task->toTableProc06($task->proc06()) ?>

    </section>


<?php

$htmlBody = ob_get_clean();     // получение захваченного контента
$title = "Запрос 06";
$activeTab = "task02Queries";

require_once "../../../Infrastructure/layout.php";       // layout страницы