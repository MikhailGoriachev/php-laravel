@extends('layouts.layout')

@section('title', 'Запрос 6')

@section('queriesActive', 'active')

@section('content')

    <section class="mx-5 my-4 bg-light shadow-sm border rounded-3 min-vh-100 p-3">

        <h4 class="text-center">Запрос 6</h4>

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
                    <th>Страховой взнос</th>
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
                        <td>{{$item->inshurance_pay_value}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>

@endsection
