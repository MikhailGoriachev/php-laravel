<?php

use App\Task02;

spl_autoload_register(fn($className) => require $fileName = '..\\..\\..\\' . $className . '.php');

ob_start();     // захват контента

$task = new Task02();

$from = null;
$to = null;
if (isset($_POST['fromDate']) ?? isset($_POST['toDate'])) {
    $from = $_POST['fromDate'];
    $to = $_POST['toDate'];

    $f = date_parse($from);
    $t = date_parse($to);
    $fromObj = new \DateTime($f['year'] . '-' . $f['month'] . '-' . $f['day']);
    $toObj = new \DateTime($t['year'] . '-' . $t['month'] . '-' . $t['day']);
}

?>
    <section class="mx-5 my-4 bg-light shadow-sm border rounded-3 min-vh-100 p-3">

        <form method="post">
            <div class="row">
                <div class="col-5">
                    <div class="row">
                        <div class="col">
                            <div class="form-floating">
                                <input type="date" name="fromDate" class="form-control" placeholder=" "
                                       value="<?= $from ?>"
                                       required>
                                <label class="form-label">Мин. дата</label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input type="date" name="toDate" class="form-control" placeholder=" " value="<?= $to ?>"
                                       required>
                                <label class="form-label">Макс. дата</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col my-auto">
                    <button class="btn btn-success my-auto" type="submit">Выбрать</button>
                    <a class="btn btn-warning my-auto <?= is_null($from) && is_null($to) ? 'disabled' : '' ?>"
                       href="/pages/task02/queries/proc03.php">Сброс</a>
                </div>
            </div>
        </form>

        <h4 class="text-center">Запрос 03</h4>

        <?= $task->toTableAppointments(is_null($from) && is_null($to) ? $task->getAppointments() : $task->proc03($fromObj, $toObj)) ?>

    </section>


<?php

$htmlBody = ob_get_clean();     // получение захваченного контента
$title = "Запрос 03";
$activeTab = "task02Queries";

require_once "../../../Infrastructure/layout.php";       // layout страницы