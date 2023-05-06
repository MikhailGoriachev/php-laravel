<?php

use Infrastructure\SessionManager;
use App\Task01;
use Models\Goods;

spl_autoload_register(fn($className) => require $fileName = '..\\..\\' . $className . '.php');

if (isset($_POST['login'])) {
    $_POST['login'] === 'in' ? SessionManager::Login() : SessionManager::Logout();
}

ob_start();     // захват контента

if (!SessionManager::IsLogged())
    echo '<section class="min-vh-100">' . SessionManager::getAlertErrorMessage() . '</section>';
else {

    // задание 
    $task = new Task01();

    // добавление
    if (isset($_POST['typeForm']))
        $task->formHandle();

    // удаление
    if (isset($_POST['remove']))
        $task->removeItem(+$_POST['remove']);

    ?>
    <section class="mx-5 my-4 bg-light shadow-sm border rounded-3 min-vh-100 p-3">

        <h4 class="text-center">Список товаров (сумма: <?= $task->getSumCost() ?> &#8381;)</h4>

        <?= $task->toTable(); ?>
    </section>
    <?php
}
$htmlBody = ob_get_clean();     // получение захваченного контента
$title = "Результат вычислений";
$activeTab = "task01Page";

require_once "../../Infrastructure/layout.php";       // layout страницы

//$html = ob_get_clean();     // получение захваченного контента
//renderLayout("task01Page", $html, "Результат вычислений");        // рендеринг страницы с layout