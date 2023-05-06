@extends('layouts/layout')

@section('title', 'Главная')

@section('indexActive', 'active')

@section('content')
    <section class="mx-5 my-4 bg-light shadow-sm border rounded-3 min-vh-100 p-3">
        <div>
            <button class="btn btn-outline-primary my-2" data-bs-toggle="collapse" href="#collapseTheory" role="button"
                    aria-expanded="false"
                    aria-controls="collapseTheory">
                <span class="h5">Теоретическая часть</span>
            </button>
            <div class="collapse show" id="collapseTheory">
                <ul>
                    <li>Синтаксис управляющих операторов Blade</li>
                    <li>Директивы Blade</li>
                    <li>Получение данных их формы – методы GET, POST</li>
                    <li>Структура приложения с формами</li>
                </ul>
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

                <!-- #region Задание 1 -->
                <p>
                    <b>Задача 1</b>. С использованием фреймворка Laravel создайте приложение с двумя контроллерами
                    (HomeController, CalculateController). Применяйте навигацию, мастер-страницы. Для контроллеров
                    предусмотрите следующие действия и представления, настройте пути:
                </p>

                <ul>
                    <li>
                        <b>HomeController</b>
                        <ul>
                            <li><b>/index</b> (он же – путь по умолчанию): вывод этого задания</li>
                            <li><b>/about</b>: вывод фамилии, имени, группы студента, произвольной картинки</li>
                        </ul>
                    </li>
                    <li>
                        <b>CalculateController</b>
                        <ul>
                            <li>
                                <b>/evaluate:</b> выполните ввод исходных данных в форму, вычисления и вывод результатов
                                для заданных выражений, не используйте модель. Вывод исходных данных и результатов – на
                                отдельную страницу.
                            </li>

                            <li>
                                <b>/array/{n?}:</b> n – параметр маршрута, случайное целое число в диапазоне [12, 25] –
                                размер массива. В форме вводите диапазон генерации случайных целых чисел для заполнения
                                массива. Выполните обработки и вывод результатов для массива, не используйте модель.
                                Вывод массива и результатов – на отдельную страницу.

                                <ul>
                                    <li>вывести исходный массив</li>
                                    <li>определить количество положительных элементов массива;</li>
                                    <li>
                                        вычислить сумму элементов массива, расположенных после последнего элемента,
                                        равного нулю.
                                    </li>
                                    <li>
                                        преобразуйте массив таким образом, чтобы сначала располагались все элементы,
                                        равные нулю, а потом — все остальные
                                    </li>
                                    <li>вывести преобразованный массив</li>
                                </ul>
                            </li>

                            <li>
                                <b>/text:</b> для строки, вводимой в форме определить (все обработки – по кнопке <b>submit</b>
                                единственной формы на странице, вывод – на отдельную страницу результатов):

                                <ul>
                                    <li>
                                        количество слов, начинающихся и заканчивающихся на одну и ту же букву с учетом и
                                        без учета регистра букв, выводить строку и уникальные найденные слова с
                                        количеством их вхождений
                                    </li>
                                    <li>
                                        количество слов, состоящих ровно из <b>k</b> букв, количество букв вводить в
                                        поле ввода формы, выводить строку и уникальные найденные слова с количеством их
                                        вхождений
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
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
                        Материалы занятия и задачник – в этом же архиве. Запись занятия можно скачать
                        <a href="https://cloud.mail.ru/public/QxpQ/EnNAN7Fyn" target="_blank">по этой ссылке</a>.
                    </p>
                </div>
            </div>
        </div>
        <!-- #endregion -->
    </section>

@endsection
