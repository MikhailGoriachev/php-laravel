<?php


use App\Task01\Task01Queries;
use App\Task01\Task01Tables;
use Models\Task01\Exam;

spl_autoload_register(fn($className) => require $fileName = '..\\..\\..\\..\\' . $className . '.php');

$queries = new Task01Queries('../../../../db_config.php');

if (isset($_POST['add']))
    $queries->query09(random_int(1, 5), random_int(1, 5), random_int(1, 5),'2021/11/' . random_int(1, 10), random_int(1, 10));

else if (isset($_POST['delete']))
    $queries->query10($_POST['delete']);

$tables = new Task01Tables('../../../../db_config.php');

ob_start();     // захват контента

?>
    <section class="mx-5 my-4 bg-light shadow-sm border rounded-3 min-vh-100 p-3">

        <h4 class="text-center">Экзамены
            <button class="btn btn-primary" id="updateBtnId">Обновить</button>
        </h4>

        <div id="containerId"></div>
        
    </section>

<?php

$htmlBody = ob_get_clean();     // получение захваченного контента
$title = "Экзамены";
$activeTab = "task01Tables";

$headers = '<script src="/src/scripts/task01/tables/exams.js"></script>';

require_once "../../../../Infrastructure/layout.php";       // layout страницы