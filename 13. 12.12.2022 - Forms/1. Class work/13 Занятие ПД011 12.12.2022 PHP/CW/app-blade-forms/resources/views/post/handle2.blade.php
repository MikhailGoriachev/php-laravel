@extends('layouts.layout')

{{-- задать параметр шаблона - имя активной страницы--}}
@section('active_form2', 'active')

<!-- секция контент -->
@section('main_part')

    <h4>Получен идентфиикатор {{ $id }}</h4>

    <h4>Данные из формы ввода, полученные по POST-запросу от form2</h4>
    <ul>
        <li>Полное имя: {{ $fullName }}</li>
        <li>Возраст: {{ $age }}</li>
        <li>Подготвка: {{ $skill }}</li>
        <li>Сертифицирован: {{ $certified?"да":"нет" }}</li>
    </ul>

    <h4>Данные из массива ввода</h4>
    <ul>
        <li>Полное имя: {{ $data['fullName'] }}</li>
        <li>Возраст: {{ $data['age'] }}</li>
        <li>Подготвка: {{ $data['skill'] }}</li>
        <li>Сертифицирован: {{ $data['certified']?"да":"нет" }}</li>
    </ul>

@endsection
