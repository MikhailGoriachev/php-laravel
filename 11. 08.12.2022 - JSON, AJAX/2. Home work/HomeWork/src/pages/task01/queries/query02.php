<?php

ob_start();     // захват контента

?>
    <section class="mx-5 my-4 bg-light shadow-sm border rounded-3 min-vh-100 p-3">

        <h4 class="text-center">Запрос 02</h4>

        <form method="post" id="formId">
            <div class="row">
                <div class="col-auto">
                    <div class="form-floating">
                        <input type="text" class="form-control" name="last_name" placeholder=" " required>
                        <label class="form-label">Фамилия экзаменатора</label>
                    </div>
                </div>

                <div class="col my-auto">
                    <button class="btn btn-success my-auto" type="submit">Выбрать</button>
                    <a class="btn btn-warning my-auto"
                       href="/src/pages/task01/queries/query02.php">Сброс</a>
                </div>
            </div>
        </form>
        
        <div id="containerId"></div>
        
    </section>

<?php

$htmlBody = ob_get_clean();     // получение захваченного контента
$title = "Запрос 02";
$activeTab = "task01Queries";

$headers = '<script src="/src/scripts/task01/queries/query02.js"></script>';

require_once "../../../../Infrastructure/layout.php";       // layout страницы