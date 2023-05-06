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
                    <li>Понятие о файловых системах Laravel</li>
                    <li>Работа с файлами в Laravel – запись, чтение, удаление</li>
                    <li>Модели в Laravel – создание и использование классов моделей</li>
                    <li>Практика реализации модели в Laravel: класс, форма, запись в файл, чтение из файла</li>
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

                <p>
                    С использованием фреймворка Laravel создайте приложение с использованием контроллеров, моделей.
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
                        должностям
                    </li>
                    <li>
                        вывод массива с выделением работников с превышением заданного стажа работы, упорядочивать массив
                        по окладу
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
                    В массиве должно быть не менее 10 экземпляров.
                </p>
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
                        <a href="https://cloud.mail.ru/public/upRZ/kotSo5uMW" target="_blank">по этой ссылке</a>.
                    </p>
                </div>
            </div>
        </div>
        <!-- #endregion -->
    </section>

@endsection
