@extends('layouts/layout')

@section('title', 'Выражения')

@section('evaluateActive', 'active')

@section('content')
    <section class="mx-5 my-4 bg-light shadow-sm border rounded-3 min-vh-100 p-3">

        <h4 class="text-center">Выражения</h4>

        <div class="container-fluid">
            <div class="row">

                {{-- выражение 1 --}}
                <div class="col-auto">
                    <div class="card w-22rem m-3 p-0 shadow-sm">
                        <div class="card-header">
                            <h5 class="text-center">Выражение 1</h5>
                        </div>

                        <ul class="list-group list-group-flush">
                            <li class="list-group-item text-center">
                                Исходные данные
                            </li>
                            <li class="list-group-item">
                                &alpha;: <b>{{ number_format(($exp1['a']), 5, '.', ' ') }}</b>
                            </li>
                            <li class="list-group-item">
                                &beta;: <b>{{ number_format($exp1['b'], 5, '.', ' ') }}</b>
                            </li>
                            <li class="list-group-item text-center">
                                Результат
                            </li>
                            <li class="list-group-item">
                                z<sub>1</sub>: <b>{{ number_format($exp1['z1'], 5, '.', ' ') }}</b>
                            </li>
                            <li class="list-group-item">
                                z<sub>2</sub>: <b>{{ number_format($exp1['z2'], 5, '.', ' ') }}</b>
                            </li>
                        </ul>
                    </div>
                </div>

                {{-- выражение 2 --}}
                <div class="col-auto">
                    <div class="card w-22rem m-3 p-0 shadow-sm">
                        <div class="card-header">
                            <h5 class="text-center">Выражение 2</h5>
                        </div>

                        <ul class="list-group list-group-flush">
                            <li class="list-group-item text-center">
                                Исходные данные
                            </li>
                            <li class="list-group-item">
                                n: <b>{{ number_format($exp2['m'], 5, '.', ' ') }}</b>
                            </li>
                            <li class="list-group-item">
                                m: <b>{{ number_format($exp2['n'], 5, '.', ' ') }}</b>
                            </li>
                            <li class="list-group-item text-center">
                                Результат
                            </li>
                            <li class="list-group-item">
                                z<sub>1</sub>: <b>{{ number_format($exp2['z1'], 5, '.', ' ') }}</b>
                            </li>
                            <li class="list-group-item">
                                z<sub>2</sub>: <b>{{ number_format($exp2['z2'], 5, '.', ' ') }}</b>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="ms-3 my-5">
                <a class="btn btn-primary me-2"
                   href="/evaluateForm/{{ $exp1['a'] }}/{{ $exp1['b'] }}/{{ $exp2['m'] }}/{{ $exp2['n'] }}">
                    Ввод данных
                </a>
                <a class="btn btn-secondary" href="/">На главную</a>
            </div>
        </div>
    </section>
@endsection
