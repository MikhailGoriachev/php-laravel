@extends('layouts.layout')

<!-- секция контент -->
@section('main_part')
    <h4 class="text-center my-5">Страница home/index</h4>

    <ul class="list-group w-50 mx-auto my-5">
        <li class="list-group-item">
           Вычисляемые поля в запросах ORM  Eloquent
        </li>
        <li class="list-group-item">
            Связь 1:1 в моделях Eloquent
        </li>
        <li class="list-group-item">
            Жадная загрузка по умолчанию в моделях ORM Eloquent 
        </li>
        <li class="list-group-item">
            "Мягкое" удаление в ORM Eloquent
        </li>
    </ul>
@endsection
