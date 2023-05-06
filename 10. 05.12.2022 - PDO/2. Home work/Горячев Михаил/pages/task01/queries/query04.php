<?php

use App\Task01\Task01Queries;
use Models\Task01\Rental;

spl_autoload_register(fn($className) => require $fileName = '..\\..\\..\\' . $className . '.php');

ob_start();     // захват контента

$task = new Task01Queries();

$dateStart = '2021/11/' . random_int(1, 10);

?>
    <section class="mx-5 my-4 bg-light shadow-sm border rounded-3 min-vh-100 p-3">

        <h4 class="text-center">Запрос 04 (Дата начала проката: <?= $dateStart ?>)</h4>

        <?= $task->toTableData($task->query04($dateStart), Rental::headerTable()) ?>

    </section>

<?php

$htmlBody = ob_get_clean();     // получение захваченного контента
$title = "Запрос 04";
$activeTab = "task01Queries";

require_once "../../../Infrastructure/layout.php";       // layout страницы