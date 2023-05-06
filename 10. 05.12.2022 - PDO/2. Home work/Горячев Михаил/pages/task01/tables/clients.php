<?php

use App\Task01\Task01Tables;
use Models\Task01\Client;

spl_autoload_register(fn($className) => require $fileName = '..\\..\\..\\' . $className . '.php');

ob_start();     // захват контента
    
$task = new Task01Tables();

?>
    <section class="mx-5 my-4 bg-light shadow-sm border rounded-3 min-vh-100 p-3">

        <h4 class="text-center">Клиенты</h4>

        <?= $task->toTableData($task->getClients(), Client::headerTable())?>
        
    </section>


<?php

$htmlBody = ob_get_clean();     // получение захваченного контента
$title = "Клиенты";
$activeTab = "task01Tables";

require_once "../../../Infrastructure/layout.php";       // layout страницы