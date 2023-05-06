<?php

use Infrastructure\SessionManager;

spl_autoload_register();

// вход/вызод в систему
if (isset($_POST['login'])) {
    $_POST['login'] === 'in' ? SessionManager::Login() : SessionManager::Logout();
}

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
                    <li>Наследование в PHP, абстрактные классы, методы</li>
                    <li>Интерфейсы и наследование в PHP</li>
                    <li>ООП в PHP: пространства имен <b>namespace, use</b></li>
                    <li>
                        ООП в PHP: автозагрузка классов, функции <b>__autoload(имяКласса),
                            spl_autoload_register(имяФункции), spl_autoload()</b></li>
                    <li>Сериализация скалярных переменных, массивов, объектов в строковое представление</li>
                    <li>Десериализация скалярных переменных, массивов, объектов из строкового представления</li>
                    <li>Магические методы <b>__sleep(), __wakeup()</b> для сериализации и десериализации объектов</li>
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
                    Разработайте приложение PHP. На главной странице разместите это задание, на других страницах –
                    решение задач. Доступ к функционалу приложения открывается только после создания сессии (клик по
                    кнопке «Войти»). По клику на кнопку «Выйти» удаляется сессия, запрещается доступ к функционалу.
                </p>

                <p>
                    В файле формата CSV хранить данные о моменте начала и завершения сессии (начало сессии – момент
                    нажатия кнопки «Вход», окончание сессии – момент нажатия кнопки «Выход»). Логин и пароль не
                    использовать. Предусмотрите страницу для просмотра файла-журнала сессий.
                </p>

                <p>
                    В сеттерах классов выбрасывать исключения при некорректны параметрах. Обработка исключений – на
                    страницах с таблицей товаров, таблицей транспортных средств.
                </p>

                <p>
                    Формы обрабатывать в тех же файлах, где они определены, при некорректных значениях выбрасывать
                    исключения.
                </p>

                <!-- #region Задание 1 -->
                <p>
                    <b>Задача 1</b>. Создать класс <b>Goods</b> (товар). В классе должны быть представлены поля:
                    наименование товара, дата оформления (прихода), цена единицы товара, количество единиц товара, номер
                    накладной, по которой товар поступил на склад.
                </p>

                <p>
                    Реализовать методы изменения цены единицы товара, изменения количества товара (увеличения и
                    уменьшения), вычисления стоимости товара. Разработать форму добавления/редактирования товара.
                    Использовать __toString().
                </p>

                <p>
                    Реализовать массив товаров, добавление в массив, удаление из массива. Данные по товарам сохранять в
                    файле в формате CSV. Также требуется выводить таблицу товаров, итоговую сумму хранимых товаров.
                </p>
                <!-- #endregion -->

                <!-- #region Задание 2 -->
                <p>
                    <b>Задача 2</b>. Разработайте иерархию: Интерфейс ТранспортноеСредство --> абстрактный класс
                    ОбщественныйТранспорт --> класс Трамвай.
                </p>

                <p>
                    Данные по трамваю вводить в форме, трамвай добавляем в массив, массив трамваев сохранять на сервере,
                    в CSV-файле. Отображение массива трамваев – в таблице. Предусмотрите возможность добавления,
                    удаления, изменения данных о конкретном трамвае.
                </p>

                <p>
                    Некоторые рекомендуемые свойства трамвая: маршрут, пассажировместимость, фактическое количество
                    пассажиров, текущая скорость. Некоторые рекомендуемые методы: начало движения, завершение движения,
                    посадка пассажиров, высадка пассажиров.
                </p>

                <p>
                    Очевидно, что посадка и высадка пассажиров не выполняются в процессе движения трамвая.
                </p>

                <p>
                    Примените magic-методы __get(), __set(), __toString() в классе Трамвай. По отдельным командам
                    продемонстрируйте сериализацию и десериализацию трамвая, массива трамваев.
                </p>
                <!-- #endregion -->

                <!-- #region Задание 3 -->
                <p>
                    <b>Задача 3</b>. Обработка файла объектов в формате <b>CSV</b>. Объект – класс Планета (Солнечной
                    системы) с закрытыми свойствами название, радиус, масса, количество спутников, тип планеты (<i>
                        каменная, газовый гигант, ледяной гигант</i>), расстояние до Солнца в а.е., фотография. По
                    кликам на кнопки типа «submit» реализуйте обработки:
                </p>

                <ul>
                    <li>Вывод данных из файла на страницу с упорядочиванием по расстоянию</li>
                    <li>Вывод данных из файла на страницу с упорядочиванием по алфавиту</li>
                    <li>Вывод данных из файла на страницу с упорядочиванием по массе</li>
                    <li>Выборка планет по массе</li>
                    <li>Выборка планет по типу</li>
                    <li>Удаление сведений о планете</li>
                </ul>
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
                                href="https://cloud.mail.ru/public/vhnY/K741ziKmS" target="_blank">по этой ссылке</a>.
                    </p>
                </div>
            </div>
            <!-- #endregion -->
    </section>

<?php

$htmlBody = ob_get_clean();     // получение захваченного контента
$title = "Главная";
$activeTab = "index";

require_once "Infrastructure/layout.php";       // layout страницы

//renderLayout("index", $html, "Главная");        // рендеринг страницы с layout
?>