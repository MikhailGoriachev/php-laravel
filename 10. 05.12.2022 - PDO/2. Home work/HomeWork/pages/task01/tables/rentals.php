<?php

use App\Task01\Task01Queries;
use App\Task01\Task01Tables;
use Models\Task01\Rental;

spl_autoload_register(fn($className) => require $fileName = '..\\..\\..\\' . $className . '.php');

ob_start();     // захват контента

$queries = new Task01Queries();

if (isset($_POST['add']))
    $queries->query08(random_int(1, 5), random_int(1, 5), '2021/11/' . random_int(1, 10), random_int(1, 10));

else if (isset($_POST['edit']))
    $queries->query09($_POST['edit'], random_int(1, 5), random_int(1, 5), '2021/11/' . random_int(1, 10), random_int(1, 10));

$tables = new Task01Tables();

?>
    <section class="mx-5 my-4 bg-light shadow-sm border rounded-3 min-vh-100 p-3">

        <h4 class="text-center">Аренды</h4>

        <?= $tables->toTableData($tables->getRentals(), Rental::headerTable()) ?>

    </section>


<?php

$htmlBody = ob_get_clean();     // получение захваченного контента
$title = "Аренды";
$activeTab = "task01Tables";

require_once "../../../Infrastructure/layout.php";       // layout страницы