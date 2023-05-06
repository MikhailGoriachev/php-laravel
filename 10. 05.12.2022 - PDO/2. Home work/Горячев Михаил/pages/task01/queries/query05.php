<?php

use App\Task01\Task01Queries;
use Models\Task01\Car;

spl_autoload_register(fn($className) => require $fileName = '..\\..\\..\\' . $className . '.php');

ob_start();     // захват контента

$task = new Task01Queries();

$minInsurance = random_int(2, 4) * 1e6;
$maxInsurance = random_int(5, 12) * 1e6;

?>
    <section class="mx-5 my-4 bg-light shadow-sm border rounded-3 min-vh-100 p-3">

        <h4 class="text-center">Запрос 05 (Диапазон страховой стоимости: <?= $minInsurance ?> — <?= $maxInsurance ?>)</h4>

        <?= $task->toTableData($task->query05($minInsurance, $maxInsurance), Car::headerTable()) ?>

    </section>

<?php

$htmlBody = ob_get_clean();     // получение захваченного контента
$title = "Запрос 05";
$activeTab = "task01Queries";

require_once "../../../Infrastructure/layout.php";       // layout страницы