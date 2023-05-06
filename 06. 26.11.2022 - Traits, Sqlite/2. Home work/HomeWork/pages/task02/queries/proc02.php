<?php

use App\Task02;

spl_autoload_register(fn($className) => require $fileName = '..\\..\\..\\' . $className . '.php');

ob_start();     // захват контента

$task = new Task02();

$value = null;
if (isset($_POST['minPercent']))
    $value = $_POST['minPercent'];

?>
    <section class="mx-5 my-4 bg-light shadow-sm border rounded-3 min-vh-100 p-3">

        <form method="post">
            <div class="row">
                <div class="col-2">
                    <div class="form-floating">
                        <input type="number" name="minPercent" class="form-control" placeholder="" value="<?= $value ?>"
                               required>
                        <label class="form-label">Минимальный процент</label>
                    </div>
                </div>
                <div class="col my-auto">
                    <button class="btn btn-success my-auto" type="submit">Выбрать</button>
                    <a class="btn btn-warning my-auto <?= is_null($value) ? 'disabled' : '' ?>" href="/pages/task02/queries/proc02.php">Сброс</a>
                </div>
            </div>
        </form>

        <h4 class="text-center">Запрос 02</h4>

        <?= $task->toTableDoctors(is_null($value) ? $task->getDoctors() : $task->proc02($value)) ?>

    </section>


<?php

$htmlBody = ob_get_clean();     // получение захваченного контента
$title = "Запрос 02";
$activeTab = "task02Queries";

require_once "../../../Infrastructure/layout.php";       // layout страницы