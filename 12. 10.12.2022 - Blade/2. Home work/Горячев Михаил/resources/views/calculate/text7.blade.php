@extends('layouts/layout')

@section('title', 'Текст')

@section('content')
    <section class="mx-5 my-4 bg-light shadow-sm border rounded-3 min-vh-100 p-3">
        <h4 class="text-center">Текст. Количество слов из 4 букв: {{$amountWordsFourLetters}}</h4>

        <div class="border shadow-sm rounded bg-white">
            <h5 class="m-4">{{$str}}</h5>
        </div>
    </section>
@endsection
