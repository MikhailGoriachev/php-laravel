<?php

use App\Task02\Task02Queries;
use App\Task02\Task02Tables;
use Models\Task02\Student;

spl_autoload_register(fn($className) => require $fileName = '..\\..\\..\\' . $className . '.php');

ob_start();     // захват контента

$queries = new Task02Queries();
$tables = new Task02Tables();

if (!($isStartData = !((isset($_POST['lastName']) && isset($_POST['passport']))))) {
    $lastName = $_POST['lastName'];
    $passport = $_POST['passport'];
}

?>
    <section class="mx-5 my-4 bg-light shadow-sm border rounded-3 min-vh-100 p-3">

        <h4 class="text-center">Запрос
            01 <?= $isStartData ? '' : "(Фамилия: $lastName; Серия паспорта: $passport)" ?></h4>

        <form method="post">
            <div class="row">
                <div class="col-auto">
                    <div class="form-floating">
                        <input type="text" class="form-control" name="lastName"
                               value="<?= $isStartData ? '' : $lastName ?>" placeholder=" " required>
                        <label class="form-label">Фамилия</label>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="form-floating">
                        <input type="text" class="form-control" name="passport"
                               value="<?= $isStartData ? '' : $passport ?>" placeholder=" " required>
                        <label class="form-label">Паспорт</label>
                    </div>
                </div>
                <div class="col my-auto">
                    <button class="btn btn-success my-auto" type="submit">Выбрать</button>
                    <a class="btn btn-warning my-auto <?= $isStartData ? 'disabled' : '' ?>"
                       href="/pages/task02/queries/query01.php">Сброс</a>
                </div>
            </div>
        </form>


        <?= $queries->toTableData($isStartData ? $tables->getStudents() : $queries->query01($lastName, $passport), Student::headerTable()) ?>

    </section>

<?php

$htmlBody = ob_get_clean();     // получение захваченного контента
$title = "Запрос 01";
$activeTab = "task02Queries";

require_once "../../../Infrastructure/layout.php";       // layout страницы