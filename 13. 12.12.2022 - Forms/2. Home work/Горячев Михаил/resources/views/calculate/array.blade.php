@extends('layouts/layout')

@section('title', 'Массивы')

@section('arrayActive', 'active')

@section('content')
    <section class="mx-5 my-4 bg-light shadow-sm border rounded-3 min-vh-100 p-3">
        <h4 class="text-center">Массивы</h4>

        {{view('calculate.showArray', ['title' => 'Исходный массив', 'array' => $sourceArray])}}

        {{view('calculate.showArray', ['title' => "Количество положительных элементов: $countPositiveItems",
            'array' => $sourceArray, 'isActive' => fn($n) => $n > 0 ? 'bg-primary text-white' : ''])}}

        {{view('calculate.showArray', ['title' => sprintf('Сумма элементов после последнего нулевого: %.3f', $sumItemsAfterLastZeroElem),
            'array' => $sourceArray, 'isActive' => fn($n) => $n === 0 ? 'bg-success text-white' : ''])}}

        {{view('calculate.showArray', ['title' => 'Сортировка по правилу: нули в начале',
            'array' => $sortArray, 'isActive' => fn($n) => $n === 0 ? 'bg-success text-white' : ''])}}

        <div class="ms-3 my-5">
            <a class="btn btn-primary me-2"
               href="/arrayForm/{{ $min }}/{{ $max }}">
                Ввод данных
            </a>
            <a class="btn btn-secondary" href="/">На главную</a>
        </div>
    </section>
@endsection
