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
                    <li>Скачивание файлов с сервера в Laravel</li>
                    <li>Загрузка файлов на сервер в Laravel</li>
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
                    <b>Задание 1</b>. С использованием фреймворка Laravel создайте приложение с использованием контроллеров, моделей.
                    Применяйте навигацию, шаблоны страниц. В классе
                </p>

                <p>Worker должны быть следующие поля:</p>

                <ul>
                    <li>идентификатор работника</li>
                    <li>фамилия и инициалы работника</li>
                    <li>название занимаемой должности</li>
                    <li>пол (мужской или женский, другие варианты не требуются)</li>
                    <li>год поступления на работу</li>
                    <li>
                        имя файла с фотографией работника (графические файлы, рекомендуемые имена файлов: man_001.jpg,
                        woman_001.jpg, подготовьте файлы заранее, добавлять файлы в приложении не надо)
                    </li>
                    <li>величина оклада работника</li>
                    <li>метод вычисления стажа работника для текущей даты</li>
                </ul>

                <p>
                    Выполнить для массива работников (объектов класса Worker) по командам интерфейса пользователя:
                </p>

                <ul>
                    <li>вывод массива с упорядочиванием фамилий по алфавиту</li>
                    <li>
                        вывод массива с выделением работников с окладами, равными минимальному, упорядочивание по
                        алфавиту
                    </li>
                    <li>
                        вывод массива с выделением работников с окладами, равными максимальному, упорядочивание по
                        должностям. <i>Предусмотрите возможность скачивания выборки работников с окладами, равными
                            максимальному в текстовом/табличном формате.</i>
                    </li>
                    <li>
                        вывод массива с выделением работников с превышением заданного стажа работы, упорядочивать массив
                        по окладу. <i>Предусмотрите возможность скачивания выборки работников с окладами, равными
                            максимальному в текстовом/табличном формате.</i>
                    </li>
                </ul>

                <p>
                    Реализуйте изменение и удаление записей коллекции в форме. Должность работника выбирайте из
                    выпадающего списка. Имя файла с фотографией генерируйте случайным образом. Данные храните в файле в
                    формате CSV (можно и в JSON) выводится на страницу.
                </p>

                <p>
                    При создании контроллера для работы с массивом работников проверяйте наличие файла с коллекцией
                    сведений о работниках. При его отсутствии файла – создавайте его из массива объектов класса Worker.
                    В массиве должно быть не менее 10 экземпляров. <i>Для начального заполнения коллекции имя файла с
                        фотографией генерируйте случайным образом из заранее подготовленных файлов. При добавлении и
                        редактировании предусмотрите загрузку файла фотографии на сервер.</i>
                </p>
                <!-- #endregion -->

                <!-- #region Задание 2 -->
                <p>
                    <b>Задание 2</b>. Самостоятельно ознакомьтесь с коллекциями Laravel 9 по <a
                        href="https://github.com/russsiq/laravel-docs-ru/blob/9.x/docs/collections.md#flip"
                        target="_blank">документации</a>.
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
                        Материалы занятия и задачник – в этом же архиве. Запись занятия можно скачать
                        <a href="https://cloud.mail.ru/public/d1TC/M3XwZgBVN" target="_blank">по этой ссылке</a>.
                    </p>
                </div>
            </div>
        </div>
        <!-- #endregion -->
    </section>

@endsection
