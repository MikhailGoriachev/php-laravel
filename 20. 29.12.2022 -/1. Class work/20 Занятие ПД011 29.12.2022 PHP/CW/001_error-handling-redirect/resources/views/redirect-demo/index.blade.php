@extends('layouts.layout')

{{-- задать параметр шаблона - имя активной страницы--}}
@section('active_redirections', 'active')

<!-- секция контент -->
@section('main_part')
    <h4 class="text-center my-5">Страница redirect-demo/index</h4>
    <h5 class="text-center my-3">Демонстрация переадресаций</h5>
    <div class="btn-group">
        <a class="btn btn-secondary mx-3" href="/redirect-demo/redirect1">
            Переадресация на маршрут
        </a>
        <a class="btn btn-secondary mx-3" href="/redirect-demo/redirect2">
            Переадресация на метод действия
        </a>
        <a class="btn btn-secondary mx-3" href="/redirect-demo/handler/{{ random_int(1000, 9999) }}">
            Переход на маршрут (без редиректа)
        </a>
    </div>
@endsection
