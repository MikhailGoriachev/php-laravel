<?php

use App\Task02;

spl_autoload_register(fn($className) => require $fileName = '..\\..\\..\\' . $className . '.php');

ob_start();     // захват контента
    
$task = new Task02();

// удаление записи
if (isset($_POST['deleteId'])) 
    $task->removeAppointment($_POST['deleteId']);

// добавление/редактирование записи
if (isset($_POST['appointmentForm'])) {

    $data = [$_POST['appointmentDate'], $_POST['idPatient'], $_POST['idDoctor']];
    
    // добавление записи
    if ($_POST['appointmentForm'])
        $task->addAppointment(...$data);
    
    // редактирование
    else 
        $task->editAppointment($_POST['id'], ...$data);
}

?>
    <section class="mx-5 my-4 bg-light shadow-sm border rounded-3 min-vh-100 p-3">

        <h4 class="text-center">Приёмы</h4>

        <?= $task->toTableAppointments($task->getAppointments())?>
        
    </section>


<?php

$htmlBody = ob_get_clean();     // получение захваченного контента
$title = "Приёмы";
$activeTab = "task02Tables";

require_once "../../../Infrastructure/layout.php";       // layout страницы