@extends('layouts/layout')

@section('title', 'Главная')

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
                    <li>Понятие о маршрутизации</li>
                    <li>Передача данных из контроллера в представление</li>
                    <li>Понятие о шаблонизаторе Blade.</li>
                    <li>Layout-страница, директивы Blade для layout</li>
                    <li>Передача параметров маршрута представлению</li>
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
                            <li><b>home/index</b> (он же – путь по умолчанию): вывод этого задания</li>
                            <li><b>home/about</b>: вывод фамилии, имени, группы студента, произвольной картинки</li>
                        </ul>
                    </li>
                    <li>
                        <b>CalculateController</b>
                        <ul>
                            <li><b>calculate/variant13</b>: выполните вычисления и вывод результатов для 5 случайных пар
                                чисел (выводите также изображение расчетного выражения), не используйте модель
                            </li>

                            <li><b>calculate/array17</b>: выполните вычисления и вывода результата для массива случайных
                                целых чисел, не используйте модель

                                <ul>
                                    <li>вывести исходный массив</li>
                                    <li>определите количество положительных элементов массива;</li>
                                    <li>вычислите сумму элементов массива, расположенных после последнего элемента,
                                        равного нулю.
                                    </li>
                                    <li>преобразуйте массив таким образом, чтобы сначала располагались все элементы,
                                        равные нулю, а потом — все остальные
                                    </li>
                                    <li>вывести преобразованный массив</li>
                                </ul>
                            </li>

                            <li><b>calculate/text7</b>: в строке, выбираемой из массива строк случайным образом (в
                                массиве не менее 10 строк) определять, сколько в ней слов, состоящих не более чем из
                                четырех букв
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
                        <a href="https://cloud.mail.ru/public/jBes/ko6tCwN8H" target="_blank">по этой ссылке</a>.
                    </p>
                </div>
            </div>
        </div>
        <!-- #endregion -->
    </section>

@endsection
