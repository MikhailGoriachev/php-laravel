@extends('layouts/layout')

@section('title', 'Текст')

@section('textActive', 'active')

@section('content')
    <section class="mx-5 my-4 bg-light shadow-sm border rounded-3 min-vh-100 p-3">
        <h4 class="text-center">Текст</h4>

        <div class="border shadow-sm rounded bg-white my-4">
            <h5 class="m-4">{{$str}}</h5>
        </div>

        <div class="row">

            <div class="col">
                <ul class="list-group">
                    <li class="list-group-item bg-secondary text-white">
                        Слова нач. и зак. на одну букву регистрозависимо: {{ $amountWordsStartEndSensitive }}
                    </li>

                    @foreach($wordsStartEndSensitive as $key => $value)
                        <li class="list-group-item">
                            {{ $key }} ({{ $value }})
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="col">
                <ul class="list-group">
                    <li class="list-group-item bg-secondary text-white">
                        Слова нач. и зак. на одну букву
                        регистронезависимо: {{ $amountWordsStartEndInsensitive }}
                    </li>

                    @foreach($wordsStartEndInsensitive as $key => $value)
                        <li class="list-group-item">
                            {{ $key }} ({{ $value }})
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="col">
                <ul class="list-group">
                    <li class="list-group-item bg-secondary text-white">
                        Количество слов с заданной длиной ({{ $length }}): {{ $amountWordsLenLetters }}
                    </li>

                    @foreach($wordsLenLetters as $key => $value)
                        <li class="list-group-item">
                            {{ $key }} ({{ $value }})
                        </li>
                    @endforeach
                </ul>
            </div>

        </div>

        <div class="ms-3 my-5">
            <a class="btn btn-primary me-2"
               href="/textForm/{{ $str }}/{{ $length }}">
                Ввод текста
            </a>
            <a class="btn btn-secondary" href="/">На главную</a>
        </div>
    </section>
@endsection
