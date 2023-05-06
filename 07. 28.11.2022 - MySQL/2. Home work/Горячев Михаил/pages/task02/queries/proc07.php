<?php

use App\Task02;

spl_autoload_register(fn($className) => require $fileName = '..\\..\\..\\' . $className . '.php');

ob_start();     // захват контента

$task = new Task02();

?>
    <section class="mx-5 my-4 bg-light shadow-sm border rounded-3 min-vh-100 p-3">
        
        <h4 class="text-center">Запрос 07</h4>

        <?= $task->toTableProc07($task->proc07()) ?>

    </section>


<?php

$htmlBody = ob_get_clean();     // получение захваченного контента
$title = "Запрос 07";
$activeTab = "task02Queries";

require_once "../../../Infrastructure/layout.php";       // layout страницы