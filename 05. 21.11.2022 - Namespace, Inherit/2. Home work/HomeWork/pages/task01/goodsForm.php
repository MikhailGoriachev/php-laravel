<?php

use App\Task01;
use Infrastructure\SessionManager;

spl_autoload_register(fn($className) => require $fileName = '..\\..\\' . $className . '.php');

if (isset($_POST['login'])) {
    $_POST['login'] === 'in' ? SessionManager::Login() : SessionManager::Logout();
}

ob_start();     // захват контента

if (!SessionManager::IsLogged())
    echo '<section class="min-vh-100">' . SessionManager::getAlertErrorMessage() . '</section>';
else {

    // задание 
    $task = new Task01();
    
    // работает ли форма в режиме для добавления
    $isAdd = isset($_POST['add']);
    
    if (!$isAdd)
        $goods = $task->getItemById(+$_POST['edit']);
        
    ?>
    <section class="mx-auto w-50 my-4 bg-light shadow-sm border rounded-3 min-vh-100 p-3">
        <h4 class="text-center"><?= $isAdd ? 'Добавление' : 'Изменение' ?> товара</h4>

        <form method="post" action="/pages/task01/goodsList.php">

            <!-- тип формы -->
            <input type="hidden" name="typeForm" value="<?= $isAdd ? 'add' : 'edit' ?>">
            
            <!-- id -->
            <input type="hidden" name="id" value="<?= $isAdd ? 0 : $goods->getId() ?>">
            
            <!-- Наимнование -->
            <div class="form-floating my-3">
                <input class="form-control" type="text" name="name" placeholder="Наименование"
                       value="<?= $isAdd ? '' : $goods->getName() ?>"
                       required>
                <label>Наименование</label>
            </div>
            
            <!-- Дата оформления -->
            <div class="form-floating my-3">
                <input class="form-control" type="date" name="date" placeholder="Дата оформления"
                       value="<?= $isAdd ? '' : $goods->getDate()->format('Y-m-d') ?>"
                       required>
                <label>Дата оформления</label>
            </div>
            
            <!-- Цена ед. -->
            <div class="form-floating my-3">
                <input class="form-control" type="number" name="price" min="1" placeholder="Цена ед. (&#8381)"
                       value="<?= $isAdd ? '' : $goods->getPrice() ?>"
                       required>
                <label>Цена ед. (&#8381)</label>
            </div>
            
            <!-- Количество -->
            <div class="form-floating my-3">
                <input class="form-control" type="number" name="amount" min="0" placeholder="Количество"
                       value="<?= $isAdd ? '' : $goods->getAmount() ?>"
                       required>
                <label>Количество</label>
            </div>
            
            <!-- Номер накладной -->
            <div class="form-floating my-3">
                <input class="form-control" type="text" name="number" placeholder="Номер накладной"
                       value="<?= $isAdd ? '' : $goods->getNumber() ?>"
                       required>
                <label>Номер накладной</label>
            </div>

            <button type="submit" class="btn btn-primary my-4"><?= $isAdd ? 'Добавить' : 'Сохранить' ?></button>
            <a class="btn btn-success my-4" href="/pages/task01/goodsList.php">Назад</a>
        </form>
    </section>
    <?php
}
$htmlBody = ob_get_clean();     // получение захваченного контента
$title = "Результат вычислений";
$activeTab = "task01Page";

require_once "../../Infrastructure/layout.php";       // layout страницы
