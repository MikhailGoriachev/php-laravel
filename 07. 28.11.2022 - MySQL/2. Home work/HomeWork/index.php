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
                    <li>Понятие о трейтах в PHP</li>
                    <li>Создание трейта, ключевое слово trait</li>
                    <li>Подключение трейта к классу, ключевое слово use</li>
                    <li>Разрешение конфликтов свойств и методов, ключевые слова <b>insteadof</b>, as</li>
                    <li>Понятие о генераторах в <b>PHP</b>, ключевое слово <b>yield</b></li>
                    <li>Понятие о классе <b>PDO</b> (<b>PHP</b> Data Object) для доступа к базам данных из <b>PHP</b>
                    </li>
                    <li>Включение поддержки <b>PDO</b> для MySQL, SQLite в конфигурационном файле php.ini</li>
                    <li>Подключение к базе данных при помощи <b>PDO</b></li>
                    <li>Реализация CRUD-операций при помощи класса <b>PDO</b>, методы query(), execute()</li>
                    <li>Получение результатов в виде ассоциативного и обычного массивов</li>
                    <li>Получение скалярного результата запроса</li>
                    <li>Подготовленные запросы в <b>PDO</b></li>
                    <li>Передача неименованных параметров в запросы – символы «?» в запросе и передача массива
                        параметров
                    </li>
                    <li>Передача именованных параметров в запросы – <b>:имяПараметра</b> и привязка параметра</li>
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
                    Разработайте веб-приложение на PHP для решения задач с использованием трейтов, базы данных
                    <b>SQLite3</b> и <b>PDO</b>.
                </p>

                <!-- #region Задание 1 -->
                <p>
                    <b>Задача 1</b>. Применение трейтов. Реализуйте обработку прямоугольных матриц по GET-запросу.
                    Размеры матриц формируйте при помощи генератора случайных чисел, заполнение матриц – целыми
                    случайными числами.
                </p>

                <p>
                    При помощи исключений обрабатывать ошибки времени исполнения.
                </p>

                <ul>
                    <li>
                        <b>Вариант 12</b>. Найти номер первой из строк, содержащих хотя бы один положительный элемент (0
                        считаем положительным числом). <i>Вычислить суммы элементов в тех столбцах, которые не содержат
                            отрицательных элементов.</i> Уплотнить заданную матрицу, удаляя из нее строки и столбцы,
                        заполненные нулями.
                    </li>
                    <li>
                        <b>Вариант 15</b>. Определить номер первого из столбцов, содержащих хотя бы один нулевой
                        элемент. <i>Определить количество столбцов, содержащих хотя бы один нулевой элемент.
                            Характеристикой строки целочисленной матрицы назовем сумму ее отрицательных четных
                            элементов</i>. Переставляя строки заданной матрицы, расположить их в соответствии с
                        убыванием характеристик.
                    </li>
                </ul>

                <p>
                    Решение по каждому варианту надо разместить в отдельном классе (Variant12, Variant15). Работу с
                    матрицей (создание, вывод в таблицу, заполнение матрицы значениями), реализовать в трейте. Добавлять
                    трейт к каждому из классов решения (Variant12, Variant15).
                </p>
                <!-- #endregion -->

                <!-- #region Задание 2 -->
                <p>
                    <b>Задача 2</b>. Применение PDO. Разработайте базу данных SQLite3. Разработайте код для выполнения
                    запросов с параметрами. Параметры запросов вводить из форм
                </p>
                
                <p>
                    <i>Выведите все таблицы базы данных с расшифровкой полей.</i>
                </p>
                
                <p>
                    <i>Реализуйте добавление, редактирование и удаление записи о врачебном приеме.</i>
                </p>

                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <td>База данных «Платный прием в поликлинике»</td>
                    </tr>
                    <tr>
                        <td>Описание предметной области</td>
                    </tr>
                    <tr>
                        <td>Платный прием пациентов (консультации специалистов) проводится врачами разных специальностей
                            (хирург, терапевт, кардиолог, офтальмолог и т.д.). Несколько врачей могут иметь одну и ту же
                            специальность. При оформлении приема должна быть сформирована квитанция об оплате приема, в
                            которой указывается информация о пациенте, о враче, который консультирует пациента, о
                            стоимости приема, о дате приема.
                        </td>
                    </tr>
                    <tr>
                        <td>Пациент оплачивает за прием некоторую сумму, которая устанавливается персонально для каждого
                            врача. За каждый прием врачу отчисляется фиксированный процент от стоимости приема. Процент
                            отчисления от стоимости приема на зарплату врача также устанавливается персонально для
                            каждого врача.
                        </td>
                    </tr>
                    <tr>
                        <td>Размер начисляемой врачу заработной платы за каждый прием вычисляется по формуле: Стоимость
                            приема * Процент отчисления от стоимости приема на зарплату врача. Из этой суммы вычитается
                            подоходный налог, составляющий 13% от суммы.
                        </td>
                    </tr>
                    <tr>
                        <td>База данных должна включать как минимум таблицы ВРАЧИ, ПАЦИЕНТЫ, ПРИЕМ, содержащие следующую
                            информацию:
                        </td>
                    </tr>
                    <tr>
                        <td>Фамилия врача</td>
                    </tr>
                    <tr>
                        <td>Имя врача</td>
                    </tr>
                    <tr>
                        <td>Отчество врача</td>
                    </tr>
                    <tr>
                        <td>Специальность врача</td>
                    </tr>
                    <tr>
                        <td>Стоимость приема</td>
                    </tr>
                    <tr>
                        <td>Процент отчисления от стоимости приема на зарплату врача</td>
                    </tr>
                    <tr>
                        <td>Фамилия пациента</td>
                    </tr>
                    <tr>
                        <td>Имя пациента</td>
                    </tr>
                    <tr>
                        <td>Отчество пациента</td>
                    </tr>
                    <tr>
                        <td>Дата рождения пациента</td>
                    </tr>
                    <tr>
                        <td>Адрес пациента</td>
                    </tr>
                    <tr>
                        <td>Дата приема</td>
                    </tr>
                    </tbody>
                </table>

                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <th colspan="3">ЗАПРОСЫ</th>
                    </tr>
                    <tr>
                        <th>Номер запроса</th>
                        <th>Тип запроса</th>
                        <th>Какую задачу решает запрос</th>
                    </tr>

                    <tr>
                        <td>1</td>
                        <td>Запрос с параметрами</td>
                        <td>
                            Выбирает информацию о пациентах с фамилиями, начинающимися на заданную последовательность
                            символов
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Запрос с параметрами</td>
                        <td>
                            Выбирает информацию о врачах, для которых значение в поле <b>Процент отчисления на
                                зарплату</b>, больше заданного
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Запрос с параметрами</td>
                        <td>Выбирает информацию о приемах за некоторый период</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Запрос с параметрами</td>
                        <td>Выбирает из таблицы информацию о врачах с заданной <b>специальностью</b></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Запрос с вычисляемыми полями</td>
                        <td>
                            Вычисляет размер заработной платы врача за каждый прием. Включает поля <b>Фамилия врача, Имя
                                врача, Отчество врача, Специальность врача, Стоимость приема, Зарплата</b>. Сортировка
                            по полю <b>Специальность врача</b>
                        </td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>Итоговый запрос</td>
                        <td>
                            Выполняет группировку по полю <b>Дата приема</b>. Для каждой даты вычисляет максимальную
                            стоимость приема
                        </td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td>Итоговый запрос</td>
                        <td>
                            Выполняет группировку по полю <b>Специальность</b>. Для каждой специальности вычисляет
                            средний Процент отчисления на зарплату от стоимости приема
                        </td>
                    </tr>
                    </tbody>
                </table>
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
                        Материалы занятия и задачник – в этом же архиве. Запись занятия можно скачать
                        <a href="https://cloud.mail.ru/public/JKGi/gEJxGWTNh" target="_blank">по этой ссылке</a>.
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