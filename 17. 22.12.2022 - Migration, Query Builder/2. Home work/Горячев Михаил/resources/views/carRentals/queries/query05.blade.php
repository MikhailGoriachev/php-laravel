@extends('layouts.layout')

@section('title', 'Запрос 5')

@section('queriesActive', 'active')

@section('content')

    <section class="mx-5 my-4 bg-light shadow-sm border rounded-3 min-vh-100 p-3">

        <h4 class="text-center">Запрос 5</h4>

        <form method="post" action="/queries/query05">
            @csrf
            <div class="row">
                <div class="col-auto">
                    <div class="form-floating">
                        <input type="number" name="min_insurance_pay" placeholder=" "
                               value="{{$min_insurance_pay ?? old('min_insurance_pay')}}"
                               class="form-control @error('min_insurance_pay') is-invalid @enderror">
                        <label class="form-label">Мин. страховая стоим.</label>
                    </div>

                    @error('min_insurance_pay')
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>

                <div class="col-auto">
                    <div class="form-floating">
                        <input type="number" name="max_insurance_pay" placeholder=" "
                               value="{{$max_insurance_pay ?? old('max_insurance_pay')}}"
                               class="form-control @error('max_insurance_pay') is-invalid @enderror">
                        <label class="form-label">Макс. страховая стоим.</label>
                    </div>

                    @error('max_insurance_pay')
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>

                <div class="col my-auto">
                    <button class="btn btn-success my-auto" type="submit">Выбрать</button>
                    <a class="btn btn-warning my-auto"
                       href="queries/query05">Сброс</a>
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
                        <td>{{$item->brand_name}}</td>
                        <td>{{$item->color_name}}</td>
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
