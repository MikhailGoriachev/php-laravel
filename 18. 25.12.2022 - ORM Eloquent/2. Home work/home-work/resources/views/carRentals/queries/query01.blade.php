@extends('layouts.layout')

@section('title', 'Запрос 1')

@section('queriesActive', 'active')

@section('content')

    <section class="mx-5 my-4 bg-light shadow-sm border rounded-3 min-vh-100 p-3">

        <h4 class="text-center">Запрос 1</h4>

        <form method="post" action="/queries/query01">
            @csrf
            <div class="row">
                <div class="col-auto">
                    <div class="form-floating">
                        <input type="number" class="form-control @error('min_rental') is-invalid @enderror"
                               name="min_rental" placeholder=" " value="{{$min_rental ?? old('min_rental')}}">
                        <label class="form-label">Мин. стоимость проката</label>
                    </div>

                    @error('min_rental') <div class="alert alert-danger">{{$message}}</div> @enderror

                </div>
                <div class="col my-auto">
                    <button class="btn btn-success my-auto" type="submit">Выбрать</button>
                    <a class="btn btn-warning my-auto"
                       href="queries/query01">Сброс</a>
                </div>
            </div>
        </form>

        <div class="row">
            <table class="table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Модель</th>
                    <th>Цвет</th>
                    <th>Госномер</th>
                    <th>Год выпуска</th>
                    <th>Страховая плата</th>
                    <th>Цена проката (сутки)</th>
                </tr>
                </thead>
                <tbody>

                @foreach($data->all() as $item)
                    <tr class="align-middle">
                        <th>{{$item->id}}</th>
                        <td>{{$item->brand->name}}</td>
                        <td>{{$item->color->name}}</td>
                        <td>{{$item->plate}}</td>
                        <td>{{$item->year_manufacture}}</td>
                        <td>{{$item->inshurance_pay}}</td>
                        <td>{{$item->rental}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>

@endsection
