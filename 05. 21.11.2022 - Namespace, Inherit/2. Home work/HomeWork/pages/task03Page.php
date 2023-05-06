<?php

use Infrastructure\SessionManager;
use App\Task03;
use Infrastructure\Utils;

spl_autoload_register(fn($className) => require $fileName = '..\\' . $className . '.php');

ob_start();     // захват контента

if (isset($_POST['login'])) {
    $_POST['login'] === 'in' ? SessionManager::Login() : SessionManager::Logout();
}

if (!SessionManager::IsLogged())
    echo '<section class="min-vh-100">' . SessionManager::getAlertErrorMessage() . '</section>';
else {

    $task = new Task03();
    
    // удаление
    if (isset($_POST['remove'])) {
        $task->planetList->removeItem(+$_POST['remove']);
    }

    ?>
    <section class="mx-5 my-4 bg-light shadow-sm border rounded-3 min-vh-100 p-3">

        <h4 class="text-center">Планеты</h4>

        <?php
        // генерация исключения
        if (isset($_POST['generateException'])) {
            echo $task->exceptionDemo();
        } else {
            ?>
            <div class="row">
                <div class="col-auto">
                    <form method="post">
                        <button type="submit" name="generateException" value="0" class="btn btn-success my-2">
                            Вызвать исключение
                        </button>
                    </form>
                </div>
                <div class="col-auto">
                    <!-- Форма для выборки типа планеты -->
                    <form method="post" class="row">

                        <div class="col-auto">
                            <div class="form-floating">
                                <select class="form-select" name="type" required>
                                    <?= array_reduce(['все', ...Utils::getTypesPlanet()], fn($p, $c) => $p . "<option value='$c'>$c</option>") ?>
                                </select>
                                <label>Тип планеты</label>
                            </div>
                        </div>

                        <div class="col-auto">
                            <button type="submit" name="selectName" value="type" class="btn btn-success my-2">
                                Выбрать
                            </button>
                        </div>
                    </form>
                </div>

                <div class="col-auto">
                    <!-- Форма для выборки массы планеты -->
                    <form method="post">

                        <div class="row">
                            <div class="col-auto">
                                <div class="form-floating">
                                    <input class="form-control" type="number" name="minMass" min="0" placeholder=" "
                                           required>
                                    <label>Мин. масса</label>
                                </div>
                            </div>

                            <div class="col-auto">
                                <div class="form-floating">
                                    <input class="form-control" type="number" name="maxMass" min="1" placeholder=" "
                                           required>
                                    <label>Макс. масса</label>
                                </div>
                            </div>

                            <div class="col-auto">
                                <button type="submit" name="selectName" value="mass" class="btn btn-success my-2">
                                    Выбрать
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <?php

            // сортировка
            $task->orderBy($_POST['orderName'] ?? null);

            // выборка данных
            $task->selectBy($_POST['selectName'] ?? null);

            echo $task->toTable();

            ?>
        <?php } ?>
    </section>

    <?php
}

$htmlBody = ob_get_clean();     // получение захваченного контента
$title = "Планеты";
$activeTab = "task03Page";

require_once "../Infrastructure/layout.php";       // layout страницы

//renderLayout("task03Page", $html, "Планеты");        // рендеринг страницы с layout