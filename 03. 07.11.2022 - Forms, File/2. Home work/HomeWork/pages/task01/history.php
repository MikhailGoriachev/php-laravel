<?php
require_once "../../infrastructure/layout.php";       // layout страницы
require_once "../../app/task01.php";               // обработка по заданию
ob_start();     // захват контента
?>
    <section class="mx-5 my-4 bg-light shadow-sm border rounded-3 min-vh-100 p-3">
        <?php
        if (isset($_POST['removeHistory']))
            removeHistory();
        
        $result = getHistory();
        ?>

        <?php if (isset($result['error'])) { ?>
            <div class="alert alert-danger m-5 w-22rem" role="alert">
                <?= $result['error'] ?>
                <a href="/pages/task01/inputForm.php">Вернуться к форме</a>
            </div>
        <?php } else { ?>
            <h4 class="text-center">История вычислений</h4>
            <div class="bg-white border shadow-sm">
                <pre class="min-h-75vh"><?= $result['content'] ?></pre>
            </div>

            <a class="btn btn-primary mx-2 my-4" href="/pages/task01/inputForm.php">Вернуться к форме ввода</a>
            
            <!-- Удаление журнала -->
            <form method="post" class="d-inline">
                <input type="hidden" name="removeHistory">
                <button type="submit" class="btn btn-danger my-4">Очистить журнал</button>
            </form>
        <?php } ?>
    </section>
<?php
$html = ob_get_clean();     // получение захваченного контента
renderLayout("task01Page", $html, "Результат вычислений");        // рендеринг страницы с layout