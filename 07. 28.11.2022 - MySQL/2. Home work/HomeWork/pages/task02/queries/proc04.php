<?php

use App\Task02;

spl_autoload_register(fn($className) => require $fileName = '..\\..\\..\\' . $className . '.php');

ob_start();     // захват контента

$task = new Task02();

$value = '';
if (isset($_POST['speciality']))
    $value = $_POST['speciality'];

?>
    <section class="mx-5 my-4 bg-light shadow-sm border rounded-3 min-vh-100 p-3">

        <form method="post">
            <div class="row">
                <div class="col-2">
                    <div class="form-floating">
                        <select name="speciality" class="form-select">
                            <?= array_reduce($task->getSpecialities(), fn($p, $c) => $p . "<option value='{$c['speciality']}'>{$c['speciality']}</option>") ?>
                        </select>
                        <label class="form-label">Специальность</label>
                    </div>
                </div>
                <div class="col my-auto">
                    <button class="btn btn-success my-auto" type="submit">Выбрать</button>
                    <a class="btn btn-warning my-auto <?= empty($value) ? 'disabled' : '' ?>" href="/pages/task02/queries/proc04.php" >Сброс</a>
                </div>
            </div>
        </form>

        <h4 class="text-center">Запрос 04</h4>

        <?= $task->toTableDoctors(empty($value) ? $task->getDoctors() : $task->proc04($value)) ?>

    </section>


<?php

$htmlBody = ob_get_clean();     // получение захваченного контента
$title = "Запрос 04";
$activeTab = "task02Queries";

require_once "../../../Infrastructure/layout.php";       // layout страницы