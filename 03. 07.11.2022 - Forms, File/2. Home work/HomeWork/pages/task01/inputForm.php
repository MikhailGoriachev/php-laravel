<?php
require_once "../../infrastructure/layout.php";       // layout страницы
require_once "../../app/task01.php";               // обработка по заданию
ob_start();     // захват контента
?>
    <section class="mx-auto w-50 my-4 bg-light shadow-sm border rounded-3 min-vh-100 p-3">
        <h4 class="text-center">Данные фигуры</h4>

        <form method="post" action="/pages/task01/result.php">

            <!-- фигуры -->
            <div class="form-floating my-3">
                <select name="figure" class="form-select" required>
                    <?= array_reduce(getFigures(), fn($prev, $curr) => $prev . "
                        <option value='{$curr['engName']}'>{$curr['rusName']}</option>", '') ?>
                </select>
                <label>Фигура</label>
            </div>

            <!-- материалы -->
            <div class="form-floating my-3">
                <select name="material" class="form-select" required>
                    <?= array_reduce(getMaterials(), fn($prev, $curr) => $prev . "
                        <option value='{$curr['engName']}'>{$curr['rusName']}</option>", '') ?>
                </select>
                <label>Материал</label>
            </div>

            <!-- радус -->
            <div class="form-floating my-3">
                <input class="form-control" type="number" name="radius" min="0.00001" step="any" placeholder="Радиус"
                       required>
                <label>Радиус</label>
            </div>

            <!-- Высота -->
            <div class="form-floating my-3">
                <input class="form-control" type="number" name="height" min="0.00001" step="any" placeholder="Высота">
                <label>Высота (не используется для сферы)</label>
            </div>

            <!-- Параметры вычисления -->
            <h6>Параметры вычисления:</h6>

            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="isArea" checked>
                    Площадь
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="isVolume" checked>
                    Объём
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="isMass" checked>
                    Масса
                </label>
            </div>

            <button type="submit" class="btn btn-primary my-4">Вычислить</button>
            <a class="btn btn-success my-4" href="/pages/task01/history.php">История вычислений</a>
        </form>
    </section>

<?php
$html = ob_get_clean();     // получение захваченного контента
renderLayout("task01Page", $html, "Ввод данных");        // рендеринг страницы с layout