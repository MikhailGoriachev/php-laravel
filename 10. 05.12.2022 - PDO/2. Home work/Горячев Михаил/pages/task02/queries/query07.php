<?php

use App\Task02\Task02Queries;
use App\Task02\Task02Tables;
use Models\Task02\Examiner;

spl_autoload_register(fn($className) => require $fileName = '..\\..\\..\\' . $className . '.php');

ob_start();     // захват контента

$queries = new Task02Queries();

?>
    <section class="mx-5 my-4 bg-light shadow-sm border rounded-3 min-vh-100 p-3">

        <h4 class="text-center">Запрос 07</h4>

        <?= $queries->toTableQuery07($queries->query07()) ?>

    </section>

<?php

$htmlBody = ob_get_clean();     // получение захваченного контента
$title = "Запрос 07";
$activeTab = "task02Queries";

require_once "../../../Infrastructure/layout.php";       // layout страницы