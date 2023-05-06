<?php

use App\Task01\Task01Queries;

spl_autoload_register(fn($className) => require $fileName = '..\\..\\..\\' . $className . '.php');

ob_start();     // захват контента

$task = new Task01Queries();

?>
    <section class="mx-5 my-4 bg-light shadow-sm border rounded-3 min-vh-100 p-3">

        <h4 class="text-center">Запрос 06</h4>

        <?= $task->toTableQuery06($task->query06()) ?>

    </section>

<?php

$htmlBody = ob_get_clean();     // получение захваченного контента
$title = "Запрос 06";
$activeTab = "task01Queries";

require_once "../../../Infrastructure/layout.php";       // layout страницы