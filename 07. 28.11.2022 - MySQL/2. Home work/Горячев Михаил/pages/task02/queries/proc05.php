<?php

use App\Task02;

spl_autoload_register(fn($className) => require $fileName = '..\\..\\..\\' . $className . '.php');

ob_start();     // захват контента

$task = new Task02();

?>
    <section class="mx-5 my-4 bg-light shadow-sm border rounded-3 min-vh-100 p-3">
        
        <h4 class="text-center">Запрос 05</h4>

        <?= $task->toTableProc05($task->proc05()) ?>

    </section>


<?php

$htmlBody = ob_get_clean();     // получение захваченного контента
$title = "Запрос 05";
$activeTab = "task02Queries";

require_once "../../../Infrastructure/layout.php";       // layout страницы