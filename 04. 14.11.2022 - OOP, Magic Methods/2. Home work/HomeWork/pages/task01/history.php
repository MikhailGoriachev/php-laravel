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
            <table class="table">
                <thead>
                <tr>
                    <th>Изображение</th>
                    <th>Название фигуры</th>
                    <th>Сторона A</th>
                    <th>Сторона B</th>
                    <th>Сторона C</th>
                    <th>Периметр</th>
                    <th>Площадь</th>
                    <th>Дата и время</th>
                </tr>
                </thead>
                <tbody>
                <?= array_reduce($result['content'],
                    fn($prev, $row) => $prev .
                        '<tr class="align-middle">' .
                        "<td><img class='h-7rem' src='/images/figures/$row[0]' alt=''/></td>" .
                        "<td>$row[1]</td>" .
                        '<td>' . (!empty($row[2]) ? sprintf('%.5f', $row[2]) : '———') . '</td>' .
                        '<td>' . (!empty($row[3]) ? sprintf('%.5f', $row[3]) : '———') . '</td>' .
                        '<td>' . (!empty($row[4]) ? sprintf('%.5f', $row[4]) : '———') . '</td>' .
                        '<td>' . (!empty($row[5]) ? sprintf('%.5f', $row[5]) : '———') . '</td>' .
                        '<td>' . (!empty($row[6]) ? sprintf('%.5f', $row[6]) : '———') . '</td>' .
                        "<td>$row[7]</td>" .
                        '</tr>',
                    '')
                ?>
                </tbody>
            </table>

            <a class="btn btn-primary mx-2 my-4" href="/pages/task01/inputForm.php">Вернуться к форме ввода</a>

            <!-- Удаление журнала -->
            <form method="post" class="d-inline">
                <input type="hidden" name="removeHistory">
                <button type="submit" class="btn btn-danger my-4">Очистить журнал</button>
            </form>
        <?php } ?>
    </section>
    <?php
}
$htmlBody = ob_get_clean();     // получение захваченного контента
$title = "Результат вычислений";
$activeTab = "task01Page";

require_once "../../infrastructure/layout.php";       // layout страницы

//$html = ob_get_clean();     // получение захваченного контента
//renderLayout("task01Page", $html, "Результат вычислений");        // рендеринг страницы с layout