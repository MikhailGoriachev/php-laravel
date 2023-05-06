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
                    <li>Вычисляемые поля в запросах ORM Eloquent</li>
                    <li>Создание связей между моделями <b>1:1</b></li>
                    <li>Жадная загрузка по умолчанию в моделях ORM Eloquent</li>
                    <li>"Мягкое" удаление в ORM Eloquent</li>
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
                    <b>Задача 1</b>. С использованием фреймворка Laravel создайте приложение для работы с базой данных
                    (можно даже с однотабличной, дикое упрощение, очень не рекомендую) для хранения данных по обуви в
                    магазине.
                </p>

                <p>
                    Должны храниться как минимум следующие данные: наименование (ботинки, кроссовки и т.д.), уникальный
                    код товара (это не поле первичного ключа id), наименование производителя, цена.
                </p>

                <p>
                    Создайте базу данных, миграции, выполните начальное заполнение данными (не менее 10 записей).
                    Разработайте модель, контроллеры. Применяйте навигацию, мастер-страницы. Предусмотрите следующие
                    действия в приложении:
                </p>

                <ul>
                    <li>
                        HomeController
                        <ul>
                            <li><b>home/index:</b> вывод этого задания</li>
                            <li><b>home/about:</b> вывод сведений о разработчике</li>
                        </ul>
                    </li>
                    <li>
                        ShoesController
                        <ul>
                            <li><b>shoes/index:</b> вывод всех записей таблицы обуви</li>
                            <li>
                                <b>shoes/create:</b> добавляет пару обуви в таблицу, используйте
                                форму с валидацией
                            </li>
                            <li>
                                <b>shoes/edit/{code}:</b> редактирует пару обуви, выбор пары по
                                коду товара
                            </li>
                            <li><b>shoes/show:</b> выводит пары обуви заданного наименования</li>
                            <li><b>shoes/delete/{code}:</b> "мягкое" удаление пары обуви с заданным кодом товара</li>
                        </ul>
                    </li>
                </ul>
                <!-- $endregion -->
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
                        <a href="https://cloud.mail.ru/public/Z9D9/KQ6pu1azc" target="_blank">по этой ссылке</a>.
                    </p>
                </div>
            </div>
        </div>
        <!-- #endregion -->
    </section>

@endsection
