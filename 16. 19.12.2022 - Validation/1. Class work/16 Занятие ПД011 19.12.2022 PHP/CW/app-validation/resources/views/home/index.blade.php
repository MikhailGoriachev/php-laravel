@extends('layouts.layout')

<!-- секция контент -->
@section('main_part')
    <h4 class="text-center my-5">Страница home/index</h4>

    <ul class="list-group w-50 mx-auto my-5">
        <li class="list-group-item">
            Операции с файлами
        </li>
        <li class="list-group-item">
            Скачивание файла с сервера
        </li>
        <li class="list-group-item">
            Загрузка файла на сервер
        </li>
        <li class="list-group-item">
            Использование загруженного на сервер файла
        </li>
        <li class="list-group-item">
            Валидация полей формы средствами Laravel
        </li>
    </ul>
@endsection
