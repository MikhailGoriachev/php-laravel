@extends('layouts.app')

<!-- настройка параметра -->
@section('title', 'Home/someValues')

<!-- секция контент -->
@section('content')

    <h1>Home/someValues</h1>
    <!-- Вывод скалярного параметра p1 -->
    <p>Случайное число {{$p1}}</p>

    <!-- Вывод коллекции из параметра p2 -->
    <h3>Фрукты</h3>
    <ul>
        @foreach($p2 as $p)
            <li>{{$p}}</li>
        @endforeach
    </ul>

    <p><a href="/">На главную</a></p>
@endsection
