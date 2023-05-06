<?php
require_once "../../infrastructure/SessionManager.php";
require_once "../../app/task01.php";               // обработка по заданию
ob_start();     // захват контента

if (isset($_POST['login'])) {
    $_POST['login'] === 'in' ? SessionManager::Login() : SessionManager::Logout();
}

if (!SessionManager::IsLogged()) {
    echo '<section class="min-vh-100">' . SessionManager::getAlertErrorMessage() . '</section>';
} else {
    ?>
    <section class="mx-auto w-50 my-4 bg-light shadow-sm border rounded-3 min-vh-100 p-3">
        <h4 class="text-center">Данные фигуры</h4>


        <form method="post" action="/pages/task01/result.php">

            <!-- фигуры -->
            <?= array_reduce(getFigures(), fn($prev, $curr) => $prev .
                '<div class="form-check">' .
                "<input class='form-check-input' type='radio' name='figure' value='{$curr['engName']}' id='{$curr['engName']}'" .
                (($_COOKIE['figure'] ?? '') === $curr['engName'] ? 'checked' : '') . ' required/>' .
                "<label class='form-check-label' for='{$curr['engName']}'>" .
                $curr['rusName'] .
                '</label>' .
                '</div>', '') ?>

            <!-- Сторона A -->
            <div class="form-floating my-3">
                <input class="form-control" type="number" name="a" min="0.00001" step="any" placeholder="Сторона A"
                       value="<?= $_COOKIE['a'] ?? "" ?>"
                       required>
                <label>Сторона A</label>
            </div>

            <!-- Сторона B -->
            <div class="form-floating my-3">
                <input class="form-control" type="number" name="b" min="0.00001" step="any" placeholder="Сторона B"
                       value="<?= $_COOKIE['b'] ?? "" ?>">
                <label>Сторона B</label>
            </div>

            <!-- Сторона C -->
            <div class="form-floating my-3">
                <input class="form-control" type="number" name="c" min="0.00001" step="any" placeholder="Сторона C"
                       value="<?= $_COOKIE['c'] ?? "" ?>">
                <label>Сторона C</label>
            </div>

            <!-- Параметры вычисления -->
            <h6>Параметры вычисления:</h6>

            <!-- Периметр -->
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox"
                           name="isPerimeter" <?= ($_COOKIE['isPerimeter'] ?? '') ?>>
                    Периметр
                </label>
            </div>

            <!-- Площадь -->
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="isArea" <?= ($_COOKIE['isArea'] ?? '') ?>>
                    Площадь
                </label>
            </div>

            <button type="submit" class="btn btn-primary my-4">Вычислить</button>
            <a class="btn btn-success my-4" href="/pages/task01/history.php">История вычислений</a>
        </form>

    </section>
    <?php
}
$htmlBody = ob_get_clean();     // получение захваченного контента
$title = "Ввод данных";
$activeTab = "task01Page";

require_once "../../infrastructure/layout.php";       // layout страницы

//$html = ob_get_clean();     // получение захваченного контента
//renderLayout("task01Page", $html, "Ввод данных");        // рендеринг страницы с layout