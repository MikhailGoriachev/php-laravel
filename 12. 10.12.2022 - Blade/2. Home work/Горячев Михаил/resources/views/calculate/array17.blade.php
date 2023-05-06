@extends('layouts/layout')

@section('title', 'Массивы')

@section('content')
    <section class="mx-5 my-4 bg-light shadow-sm border rounded-3 min-vh-100 p-3">
        <h4 class="text-center">Массивы</h4>

        {{$showArrayFn($sourceArray, 'Исходный массив')}}

        {{$showArrayFn($sourceArray, "Количество положительных элеменетов $countPositiveItems",
            fn($n) => $n > 0 ? 'bg-primary text-white' : '')}}

        {{$showArrayFn($sourceArray, "Количество положительных элеменетов $countPositiveItems",
            fn($n) => $n === 0 ? 'bg-success text-white' : '')}}

        {{$showArrayFn($sortArray, "Сортировка по правилу: нули в начале",
            fn($n) => $n === 0 ? 'bg-success text-white' : '')}}
    </section>
@endsection
