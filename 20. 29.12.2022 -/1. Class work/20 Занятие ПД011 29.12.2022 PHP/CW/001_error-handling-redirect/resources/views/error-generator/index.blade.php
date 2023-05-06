@extends('layouts.layout')

{{-- задать параметр шаблона - имя активной страницы--}}
@section('active_exceptions', 'active')

<!-- секция контент -->
@section('main_part')
    <h4 class="text-center my-5">Страница error-generator/index</h4>
    <h5 class="text-center my-3">Генерация ошибок - выброс исключений</h5>
    <div class="btn-group">
        <a class="btn btn-secondary mx-3" href="/error-generator/standard-handling">Исключение, стандартная обработка</a>
        <a class="btn btn-secondary mx-3" href="/error-generator/custom-handling">Исключение, собственная обработка</a>
        <a class="btn btn-secondary mx-3" href="/error-generator/http-standard-handling">HTTP-исключение, стандартная обработка</a>
        <a class="btn btn-secondary mx-3" href="/error-generator/http-custom-handling">HTTP-исключение, собственная обработка</a>
    </div>
@endsection
