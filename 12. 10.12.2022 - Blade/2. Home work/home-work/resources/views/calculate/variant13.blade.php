@extends('layouts/layout')

@section('title', 'Выражения')

@section('content')
    <section class="mx-5 my-4 bg-light shadow-sm border rounded-3 min-vh-100 p-3">

        <h4 class="text-center">Выражения</h4>

        <div class="container-fluid">
            <div class="row">
                @foreach($arr as $exp)
                    <div class="card w-22rem m-3 p-0 shadow-sm">
                        <div class="card-header">
                            <h5 class="text-center">Выражение №{{$exp['n']}}</h5>
                        </div>

                        <ul class="list-group list-group-flush">
                            <li class="list-group-item text-center">
                                Исходные данные
                            </li>
                            <li class="list-group-item">
                                &alpha;: <b>{{$exp['a']}}</b>
                            </li>
                            <li class="list-group-item">
                                &beta;: <b>{{$exp['b']}}</b>
                            </li>
                            <li class="list-group-item text-center">
                                Результат
                            </li>
                            <li class="list-group-item">
                                z<sub>1</sub>: <b>{{$exp['z1']}}</b>
                            </li>
                            <li class="list-group-item">
                                z<sub>2</sub>: <b>{{$exp['z2']}}</b>
                            </li>
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
