@extends('layouts.layout')

{{-- Представление, формируемое обработчиком формы form1 --}}

{{-- задать параметр шаблона - имя активной страницы--}}
@section('active_form1', 'active')

<!-- секция контент -->
@section('main_part')

    <h4>Данные из формы ввода, полученные по GET-запросу от form1</h4>
    <ul>
        <li>Полное имя: {{ $fullName }}</li>
        <li>Возраст: {{ $age }}</li>
        <li>Подготвка: {{ $skill }}</li>
        <li>Сертифицирован: {{ $certified?"да":"нет" }}</li>
    </ul>

@endsection
