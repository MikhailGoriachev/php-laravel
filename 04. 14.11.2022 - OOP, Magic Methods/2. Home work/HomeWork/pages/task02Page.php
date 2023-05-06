<?php
require_once "../infrastructure/SessionManager.php";
require_once "../app/task02.php";               // обработка по заданию
ob_start();     // захват контента

if (isset($_POST['login'])) {
    $_POST['login'] === 'in' ? SessionManager::Login() : SessionManager::Logout();
}

if (!SessionManager::IsLogged())
    echo '<section class="min-vh-100">' . SessionManager::getAlertErrorMessage() . '</section>';
else {
    ?>
    <section class="mx-5 my-4 bg-light shadow-sm border rounded-3 min-vh-100 p-3">

        <?php

        task02();

        $fileText = getText();

        ?>

        <?php if (isset($fileText['error'])) { ?>
            <h4 class="text-center">Контент файла</h4>

            <div class="alert alert-danger m-3 w-22rem" role="alert">
                <?= $fileText['error'] ?>
            </div>
        <?php } else { ?>

            <h4 class="text-center">
                Контент файла <?= $fileText['fileName'] ?? '' ?>. Обработка: <?= $fileText['name'] ?>
            </h4>

            <form method="post" class="m-3">
                <input type="hidden" name="currentFile" value="<?= $fileText['fileName'] ?>">

                <button type="submit" name="handleType" value="default" class="btn btn-success col me-3">
                    По умолчанию
                </button>
                <button type="submit" name="handleType" value="numbers" class="btn btn-primary col mx-3">
                    Строки с двузначными числами
                </button>
                <button type="submit" name="handleType" value="withoutSpecSymbol" class="btn btn-primary col mx-3">
                    Строки без символов ".,!?:"
                </button>
            </form>

            <div class="bg-white border border-2 rounded shadow-sm m-3 p-2">
                <pre><?= $fileText['content'] ?></pre>
            </div>

            <!-- ввод текста -->
            <form method="post" class="m-3">
                <input type="hidden" name="currentFile" value="<?= $fileText['fileName'] ?>">
                <div class="row">
                    <div class="col-8">
                        <div class="form-floating">
                            <textarea class="form-control" name="text" placeholder="Введите текст" required></textarea>
                            <label>Введите текст</label>
                        </div>
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-primary mt-2">Добавить текст</button>
                    </div>
                </div>
            </form>
        <?php } ?>

        <form method="post" class="w-30rem m-3" enctype='multipart/form-data'>
            <div class="row mx-0">
                <input class="form-control col" type="file" name="filename" required>
                <button type="submit" class="btn btn-primary w-10rem mx-3">Загрузить файл...</button>
            </div>
        </form>

    </section>

    <?php
}

$htmlBody = ob_get_clean();     // получение захваченного контента
$title = "Файл";
$activeTab = "task02Page";

require_once "../infrastructure/layout.php";       // layout страницы

//$html = ob_get_clean();     // получение захваченного контента
//renderLayout("task02Page", $html, "Файл");        // рендеринг страницы с layout