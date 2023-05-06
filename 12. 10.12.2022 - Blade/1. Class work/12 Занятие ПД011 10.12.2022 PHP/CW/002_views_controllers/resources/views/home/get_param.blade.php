@extends('layouts.app')

<!-- настройка параметра -->
@section('title', 'Home/someValues')

<!-- секция контент -->
@section('content')

    <h1>Home/someValues</h1>
    <!-- Вывод параметра p1 -->
    <p>Случайное число, полученное из маршрута {{$id}}</p>
    <p><a href="/">На главную</a></p>
@endsection
