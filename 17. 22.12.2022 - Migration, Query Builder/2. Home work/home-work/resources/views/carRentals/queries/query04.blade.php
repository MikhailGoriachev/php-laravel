@extends('layouts.layout')

@section('title', 'Запрос 4')

@section('queriesActive', 'active')

@section('content')

    <section class="mx-5 my-4 bg-light shadow-sm border rounded-3 min-vh-100 p-3">

        <h4 class="text-center">Запрос 4</h4>

        <form method="post" action="/queries/query04">
            @csrf
            <div class="row">
                <div class="col-auto">
                    <div class="form-floating">
                        <input class="form-control @error('date_start') is-invalid @enderror" type="date" name="date_start">
                        <label class="form-label">Дата</label>
                    </div>

                    @error('date_start')
                    <div class="alert alert-danger">{{$message}}</div> @enderror
                </div>

                <div class="col my-auto">
                    <button class="btn btn-success my-auto" type="submit">Выбрать</button>
                    <a class="btn btn-warning my-auto"
                       href="queries/query04">Сброс</a>
                </div>
            </div>
        </form>

        <div class="row">
            <table class="table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Клиент</th>
                    <th>Паспорт</th>
                    <th>Модель</th>
                    <th>Цвет</th>
                    <th>Номер</th>
                    <th>Страх. стоимость</th>
                    <th>Аренда</th>
                    <th>Дата</th>
                    <th>Длительность</th>
                </tr>
                </thead>
                <tbody>

                @foreach($data->all() as $item)
                    <tr class="align-middle">
                        <td>{{$item->id}}</td>
                        <td>{{
                            $item->last_name . ' ' . mb_substr($item->first_name, 0, 1) . '.' .
                            mb_substr($item->patronymic, 0, 1) . '.'}}
                        </td>
                        <td>{{$item->passport}}</td>
                        <td>{{$item->brand_name}}</td>
                        <td>{{$item->color_name}}</td>
                        <td>{{$item->plate}}</td>
                        <td>{{$item->inshurance_pay}}</td>
                        <td>{{$item->rental}}</td>
                        <td>{{$item->date_start}}</td>
                        <td>{{$item->duration}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>

@endsection
