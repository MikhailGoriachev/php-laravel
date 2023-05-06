<?php
require_once "infrastructure/layout.php";       // layout страницы
ob_start();     // захват контента
?>
    <section class="mx-5 my-4 bg-light shadow-sm border rounded-3 min-vh-100 p-3">
        <div>
            <button class="btn btn-outline-primary my-2" data-bs-toggle="collapse" href="#collapseTheory" role="button"
                    aria-expanded="false"
                    aria-controls="collapseTheory">
                <span class="h5">Теоретическая часть</span>
            </button>

            <div class="collapse show" id="collapseTheory">
                <ul>
                    <li>Основы работы с формами в PHP</li>
                    <li>Понятие о глобальных массивах $_GET, $_PUT</li>
                    <li>Организация работы с формами в PHP</li>
                    <li>Реализация get- и post- методов передачи данных</li>
                    <li>Функции обеспечения безопасности в формах</li>
                    <li>Основные приемы работы с элементами форм</li>
                    <li>Работа с файлами в PHP: открытие, чтение, запись, перемещение файлового указателя, определение
                        достижения конца файла, закрытие файла
                    </li>
                    <li>Манипулирование файлами и каталогами в файловой системе</li>
                    <li>Загрузка файлов на сервер, глобальный массив $_FILES</li>
            </div>
        </div>
        <!-- #endregion -->

        <!-- #region Практическая часть -->
        <div>
            <button class="btn btn-outline-primary my-2" data-bs-toggle="collapse" href="#collapsePractice"
                    role="button" aria-expanded="false"
                    aria-controls="collapsePractice">
                <span class="h5">Практическая часть</span>
            </button>

            <div class="collapse show" id="collapsePractice">
                <p>
                    Разработайте приложение с обработкой данных на PHP. На главной странице разместите это задание, на
                    других страницах – решение задачи.
                </p>

                <!-- #region Задание 1 -->
                <p>
                    <b>Задача 1</b>. Требуется вычислять параметры геометрических тел по выбору пользователя. Параметры
                    тел вводить в элементы интерфейса.
                </p>

                <ul>
                    <li>площадь поверхности</li>
                    <li>объем</li>
                    <li>масса</li>
                </ul>

                <p>Типы тел по выбору пользователя:</p>

                <ul>
                    <li>конус</li>
                    <li>сфера</li>
                    <li>цилиндр</li>
                </ul>

                <p>Варианты материала, из которого изготовлено тело:</p>

                <ul>
                    <li>сталь</li>
                    <li>алюминий</li>
                    <li>водяной лед</li>
                    <li>гранит</li>
                </ul>

                <p>
                    Тип фигуры и материал выбирать из выпадающих списков. Необходимые числовые параметры вводить при
                    помощи строки ввода с типом <b>number</b>. Параметры вычисления задавать чек-боксами, собственно
                    вычисление выполнять при клике на кнопку "Вычислить" типа <b>submit</b>. В результаты вычислений
                    должны также включаться изображения выбранного тела и материала, из которого изготовлено тело.
                </p>

                <p>
                    Требуется также вести журнал операций – текстовый файл, в котором записывать дату и время выполнения
                    расчета, исходные данные расчета, результаты расчета. Предусмотрите страницу для просмотра журнала,
                    очистки журнала.
                </p>
                <!-- #endregion -->

                <!-- #region Задание 2 -->
                <p>
                    <b>Задача 2</b>. Загружать текстовый файл в кодировке UTF-8 на сервер, папка uploaded в приложении.
                    Выводить на страницу текст из файла, форму для ввода текста. По клику на кнопку «Дозапись» записать
                    введенный в поле ввода текст в конец файла, вывести измененный файл (AJAX не использовать).
                </p>
                <!-- #endregion -->
            </div>
        </div>
        <!-- #endregion -->

        <!-- #region Дополнительно -->
        <div>
            <div>
                <button class="btn btn-outline-primary my-2" data-bs-toggle="collapse" href="#collapseAdditionally"
                        role="button" aria-expanded="false"
                        aria-controls="collapseAdditionally">
                    <span class="h5">Дополнительно</span>
                </button>

                <div class="collapse show" id="collapseAdditionally">
                    <p>
                        Материалы занятия – в этом же архиве. Запись занятия можно скачать <a
                                href="https://cloud.mail.ru/public/dEnx/WKDZbCTM5" target="_blank">по этой ссылке</a>.
                    </p>
                </div>
            </div>
            <!-- #endregion -->
    </section>

<?php
$html = ob_get_clean();     // получение захваченного контента
renderLayout("index", $html, "Главная");        // рендеринг страницы с layout
?>