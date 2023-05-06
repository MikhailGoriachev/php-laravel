@extends('layouts.layout')

@section('title', 'Запрос 3')

@section('queriesActive', 'active')

@section('content')

    <section class="mx-5 my-4 bg-light shadow-sm border rounded-3 min-vh-100 p-3">

        <h4 class="text-center">Запрос 3</h4>

        <form method="post" action="/queries/query03">
            @csrf
            <div class="row">
                <div class="col-auto">
                    <div class="form-floating">
                        <input type="text" class="form-control @error('passport') is-invalid @enderror"
                               name="passport" placeholder=" "
                               value="{{$passport ?? old('passport')}}">
                        <label class="form-label">Паспорт</label>
                    </div>

                    @error('passport')
                    <div class="alert alert-danger">{{$message}}</div> @enderror
                </div>

                <div class="col my-auto">
                    <button class="btn btn-success my-auto" type="submit">Выбрать</button>
                    <a class="btn btn-warning my-auto"
                       href="queries/query03">Сброс</a>
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
                            $item->client->last_name . ' ' . mb_substr($item->client->first_name, 0, 1) . '.' .
                            mb_substr($item->client->patronymic, 0, 1) . '.'}}
                        </td>
                        <td>{{$item->client->passport}}</td>
                        <td>{{$item->car->brand->name}}</td>
                        <td>{{$item->car->color->name}}</td>
                        <td>{{$item->car->plate}}</td>
                        <td>{{$item->car->inshurance_pay}}</td>
                        <td>{{$item->car->rental}}</td>
                        <td>{{$item->date_start}}</td>
                        <td>{{$item->duration}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>

@endsection
