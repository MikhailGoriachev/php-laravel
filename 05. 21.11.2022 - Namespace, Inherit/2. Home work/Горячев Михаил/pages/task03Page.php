<?php

use Infrastructure\SessionManager;
use App\Task03;

spl_autoload_register(fn($className) => require $fileName = '..\\' . $className . '.php');
//$df = new task03Neww();
//use App\Task01;
//use App\task03;


//new Task01();

ob_start();     // захват контента

if (isset($_POST['login'])) {
    $_POST['login'] === 'in' ? SessionManager::Login() : SessionManager::Logout();
}

if (!SessionManager::IsLogged())
    echo '<section class="min-vh-100">' . SessionManager::getAlertErrorMessage() . '</section>';
else {
    
    $task = new Task03();

    // удаление
    if (isset($_POST['remove'])) {
        $task->planetList->removeItem(+$_POST['remove']);
    }
    
    ?>
    <section class="mx-5 my-4 bg-light shadow-sm border rounded-3 min-vh-100 p-3">

        <h4 class="text-center">Планеты</h4>

        <?php     
            // генерация исключения
            if (isset($_POST['generateException'])) {
                echo $task->exceptionDemo();
            } else { 
        ?>
            <form method="post" class="m-3">
                <button type="submit" name="generateException" value="0" class="btn btn-success col me-3">
                    Вызвать исключение
                </button>
            </form>

            <?= $task->orderBy($_POST['orderName'] ?? null) ?>
        <?php } ?>
    </section>

    <?php
}

$htmlBody = ob_get_clean();     // получение захваченного контента
$title = "Планеты";
$activeTab = "task03Page";

require_once "../Infrastructure/layout.php";       // layout страницы

//renderLayout("task03Page", $html, "Планеты");        // рендеринг страницы с layout