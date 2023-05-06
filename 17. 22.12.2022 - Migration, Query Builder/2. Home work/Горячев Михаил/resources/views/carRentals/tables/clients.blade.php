@extends('layouts.layout')

@section('title', 'Модели')

@section('tablesActive', 'active')

@section('content')

    <section class="mx-5 my-4 bg-light shadow-sm border rounded-3 min-vh-100 p-3">
        <h4 class="text-center">Клиенты</h4>

        <div class="row">
            <table class="table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Фамилия</th>
                    <th>Имя</th>
                    <th>Отчество</th>
                    <th>Паспорт</th>
                </tr>
                </thead>
                <tbody>

                @foreach($data->all() as $item)
                    <tr class="align-middle">
                        <th>{{$item->id}}</th>
                        <td>{{$item->last_name}}</td>
                        <td>{{$item->first_name}}</td>
                        <td>{{$item->patronymic}}</td>
                        <td>{{$item->passport}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>

@endsection
