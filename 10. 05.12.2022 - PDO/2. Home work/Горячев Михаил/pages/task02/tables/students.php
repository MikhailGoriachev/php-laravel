<?php

use App\Task02\Task02Tables;
use Models\Task02\Student;

spl_autoload_register(fn($className) => require $fileName = '..\\..\\..\\' . $className . '.php');

ob_start();     // захват контента
    
$task = new Task02Tables();

?>
    <section class="mx-5 my-4 bg-light shadow-sm border rounded-3 min-vh-100 p-3">

        <h4 class="text-center">Студенты</h4>

        <?= $task->toTableData($task->getStudents(), Student::headerTable())?>
        
    </section>


<?php

$htmlBody = ob_get_clean();     // получение захваченного контента
$title = "Студенты";
$activeTab = "task02Tables";

require_once "../../../Infrastructure/layout.php";       // layout страницы