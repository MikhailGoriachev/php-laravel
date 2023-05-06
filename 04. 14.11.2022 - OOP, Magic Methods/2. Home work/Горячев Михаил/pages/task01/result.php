<?php
require_once "../../infrastructure/SessionManager.php";
require_once "../../app/task01.php";               // обработка по заданию
ob_start();     // захват контента

if (isset($_POST['login'])) {
    $_POST['login'] === 'in' ? SessionManager::Login() : SessionManager::Logout();
}

if (!SessionManager::IsLogged())
    echo '<section class="min-vh-100">' . SessionManager::getAlertErrorMessage() . '</section>';
else {
    ?>
    <section class="min-vh-100">
        <?php
        // получение результата формы
        $result = formHandler();
        ?>

        <?php if (isset($result['error'])) { ?>
            <div class="row">
                <div class="alert alert-danger m-5 col-5" role="alert">
                    <?= $result['error'] ?>
                    <a href="/pages/task01/inputForm.php">Вернуться к форме</a>
                </div>
            </div>
        <?php } else { ?>
            <div class="card mx-auto w-30rem shadow my-4">
                <div class="card-header">
                    <h4 class="text-center">Результат обработки фигуры</h4>
                    <div class="h-20rem">
                        <div class="text-center">
                            <h5><?= $result['name'] ?></h5>
                            <div class="border p-1 shadow-sm bg-white">
                                <img class="h-15rem" src="/images/figures/<?= $result['figureImage'] ?>" alt="">
                            </div>
                        </div>
                    </div>
                </div>

                <ul class="list-group list-group-flush">
                    <?= $result['a'] !== null ? sprintf("<li class='list-group-item'>Сторона A: <b>%.5f</b></li>", $result['a']) : null ?>
                    <?= $result['b'] !== null ? sprintf("<li class='list-group-item'>Сторона B: <b>%.5f</b></li>", $result['b']) : null ?>
                    <?= $result['c'] !== null ? sprintf("<li class='list-group-item'>Сторона C: <b>%.5f</b></li>", $result['c']) : null ?>
                </ul>

                <div class="card-footer px-0">
                    <h6 class="text-center">Результат обработки:</h6>

                    <ul class="list-group list-group-flush">
                        <?= $result['perimeter'] !== null ? sprintf("<li class='list-group-item'>Периметер: <b>%.5f</b></li>", $result['perimeter']) : null ?>
                        <?= $result['area'] !== null ? sprintf("<li class='list-group-item'>Площадь: <b>%.5f</b></li>", $result['area']) : null ?>
                    </ul>
                    <div class="text-center">
                        <a class="btn btn-primary mx-2 mt-2" href="/pages/task01/inputForm.php">Вернуться к форме
                            ввода</a>
                        <a class="btn btn-success mt-2" href="/pages/task01/history.php">История вычислений</a>
                    </div>
                </div>

            </div>
        <?php } ?>
    </section>
    <?php
}
$htmlBody = ob_get_clean();     // получение захваченного контента
$title = "Результат обработки";
$activeTab = "task01Page";

require_once "../../infrastructure/layout.php";       // layout страницы

//$html = ob_get_clean();     // получение захваченного контента
//renderLayout("task01Page", $html, "Результат обработки");        // рендеринг страницы с layout