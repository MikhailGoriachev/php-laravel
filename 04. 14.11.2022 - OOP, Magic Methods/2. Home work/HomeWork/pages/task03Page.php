<?php
require_once '../models/PlanetList.php';
require_once "../infrastructure/SessionManager.php";
require_once "../app/task03.php";               // обработка по заданию
ob_start();     // захват контента

if (isset($_POST['login'])) {
    $_POST['login'] === 'in' ? SessionManager::Login() : SessionManager::Logout();
}

if (!SessionManager::IsLogged())
    echo '<section class="min-vh-100">' . SessionManager::getAlertErrorMessage() . '</section>';
else {
    ?>
    <section class="mx-5 my-4 bg-light shadow-sm border rounded-3 min-vh-100 p-3">

        <h4 class="text-center">Планеты</h4>

        <?php if (!isset($_POST['generateException'])) { ?>
            <form method="post" class="m-3">
                <button type="submit" name="generateException" value="0" class="btn btn-success col me-3">
                    Вызвать исключение
                </button>
            </form>
        <?php } ?>

        <?= task03() ?>
    </section>

    <?php
}

$htmlBody = ob_get_clean();     // получение захваченного контента
$title = "Планеты";
$activeTab = "task03Page";

require_once "../infrastructure/layout.php";       // layout страницы

//renderLayout("task03Page", $html, "Планеты");        // рендеринг страницы с layout