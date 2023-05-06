<?php
require_once "../infrastructure/layout.php";       // layout страницы
require_once "../app/task02.php";               // обработка по заданию
ob_start();     // захват контента
?>
    <section class="mx-5 my-4 bg-light shadow-sm border rounded-3 min-vh-100 p-3">

        <?php

        setCurrentFile();

        $uploadResult = uploadFile();

        addText();

        $fileText = getText();

        ?>

        <h4 class="text-center">Контент файла <?= $fileText['fileName'] ?? '' ?></h4>
        
        
        <?php if (isset($fileText['error'])) { ?>
            <div class="alert alert-danger m-3 w-22rem" role="alert">
                <?= $fileText['error'] ?>
            </div>
        <?php } else { ?>
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
$html = ob_get_clean();     // получение захваченного контента
renderLayout("task02Page", $html, "Файл");        // рендеринг страницы с layout