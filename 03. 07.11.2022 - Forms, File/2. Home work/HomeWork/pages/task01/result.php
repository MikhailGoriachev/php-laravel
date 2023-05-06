<?php
require_once "../../infrastructure/layout.php";       // layout страницы
require_once "../../app/task01.php";               // обработка по заданию
ob_start();     // захват контента
?>
    <section class="min-vh-100">
        <?php
        // получение результата формы
        $result = formHandler();
        ?>

        <?php if (isset($result['error'])) { ?>
            <div class="alert alert-danger m-5 w-22rem" role="alert">
                <?= $result['error'] ?>
                <a href="/pages/task01/inputForm.php">Вернуться к форме</a>
            </div>
        <?php } else { ?>
            <div class="card mx-auto w-50 shadow my-4">
                <div class="card-header">
                    <h4 class="text-center">Результат обработки фигуры</h4>
                    <div class="row h-20rem">
                        <div class="col-6 text-center">
                            <h5><?= $result['name'] ?></h5>
                            <div class="border p-1 shadow-sm">
                                <img class="h-15rem" src="/images/figures/<?= $result['figureImage'] ?>" alt="">
                            </div>
                        </div>
                        <div class="col-6 text-center">
                            <h5><?= $result['material'] ?></h5>
                            <div class="border p-1 shadow-sm">
                                <img class="h-15rem w-100" src="/images/materials/<?= $result['materialImage'] ?>"
                                     alt="">
                            </div>
                        </div>
                    </div>
                </div>

                <ul class="list-group list-group-flush">
                    <?= !isset($result['radius']) ? "" : sprintf("<li class='list-group-item'>Радиус: <b>%.5f</b></li>", $result['radius']) ?>
                    <?= !isset($result['height']) ? "" : sprintf("<li class='list-group-item'>Высота: <b>%.5f</b></li>", $result['height']) ?>
                    <?= !isset($result['density']) ? "" : sprintf("<li class='list-group-item'>Плотность: <b>%.5f</b></li>", $result['density']) ?>
                </ul>

                <div class="card-footer px-0">
                    <h6 class="text-center">Результат обработки:</h6>

                    <ul class="list-group list-group-flush">
                        <?= !isset($result['area']) ? "" : sprintf("<li class='list-group-item'>Площадь: <b>%.5f</b></li>", $result['area']) ?>
                        <?= !isset($result['volume']) ? "" : sprintf("<li class='list-group-item'>Объём: <b>%.5f</b></li>", $result['volume']) ?>
                        <?= !isset($result['mass']) ? "" : sprintf("<li class='list-group-item'>Масса: <b>%.5f</b></li>", $result['mass']) ?>
                    </ul>

                    <a class="btn btn-primary mx-2 mt-2" href="/pages/task01/inputForm.php">Вернуться к форме ввода</a>
                    <a class="btn btn-success mt-2" href="/pages/task01/history.php">История вычислений</a>
                </div>

            </div>
        <?php } ?>
    </section>
<?php
$html = ob_get_clean();     // получение захваченного контента
renderLayout("task01Page", $html, "Результат обработки");        // рендеринг страницы с layout