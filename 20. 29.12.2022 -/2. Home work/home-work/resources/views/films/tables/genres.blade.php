@extends('layouts.layout')

@section('title', 'Жанры')

@section('tablesActive', 'active')

@section('content')

    <section class="mx-5 my-4 bg-light shadow-sm border rounded-3 min-vh-100 p-3">
        <h4 class="text-center">Жанры</h4>

        <table class="table table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Название</th>
            </tr>
            </thead>
            <tbody>

            @foreach($data->all() as $item)
                <tr class="align-middle">
                    <td>{{$item->id}}</td>
                    <td>{{$item->name}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </section>

@endsection
