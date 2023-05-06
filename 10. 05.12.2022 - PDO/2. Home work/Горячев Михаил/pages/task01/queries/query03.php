<?php

use App\Task01\Task01Queries;
use Models\Task01\Rental;

spl_autoload_register(fn($className) => require $fileName = '..\\..\\..\\' . $className . '.php');

ob_start();     // захват контента

$task = new Task01Queries();

$number = random_int(1, 9);

?>
    <section class="mx-5 my-4 bg-light shadow-sm border rounded-3 min-vh-100 p-3">

        <h4 class="text-center">Запрос 03 (Первая цифра паспорта: <?= $number ?>)</h4>

        <?= $task->toTableData($task->query03($number), Rental::headerTable()) ?>

    </section>

<?php

$htmlBody = ob_get_clean();     // получение захваченного контента
$title = "Запрос 03";
$activeTab = "task01Queries";

require_once "../../../Infrastructure/layout.php";       // layout страницы