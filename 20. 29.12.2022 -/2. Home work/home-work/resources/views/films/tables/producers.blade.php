@extends('layouts.layout')

@section('title', 'Режиссёры')

@section('tablesActive', 'active')

@section('content')

    <section class="mx-5 my-4 bg-light shadow-sm border rounded-3 min-vh-100 p-3">
        <h4 class="text-center">Режиссёры</h4>

        <div class="row">

            {{-- Все режиссёры --}}
            <div class="col-auto">
                <a class="btn btn-success mt-2" href="/tables/producers">Все режиссёры</a>
            </div>

            {{-- Режиссеры, снимавшие фильмы заданного жанра --}}
            <div class="col-auto ms-3">
                <form action="/tables/producers/by-genre" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-auto">
                            <div class="form-floating">
                                <select name="genre_id" class="form-select">
                                    @foreach($genreList as $m)
                                        <option
                                            value="{{$m['key']}}" {{($m['key'] === ($genre_id ?? null) ? 'selected' : '')}}>
                                            {{$m['value']}}
                                        </option>
                                    @endforeach
                                </select>
                                <label class="form-label">Жанр</label>
                            </div>
                        </div>

                        <div class="col-auto">
                            <input class="btn btn-primary mt-2" type="submit" value="Выбрать">
                        </div>
                    </div>
                </form>
            </div>

            {{-- Режиссеры из заданной страны --}}
            <div class="col-auto ms-3">
                <form action="/tables/producers/by-country" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-auto">
                            <div class="form-floating">
                                <select name="country_id" class="form-select">
                                    @foreach($countryList as $m)
                                        <option
                                            value="{{$m['key']}}" {{($m['key'] === ($country_id ?? null) ? 'selected' : '')}}>
                                            {{$m['value']}}
                                        </option>
                                    @endforeach
                                </select>
                                <label class="form-label">Страна</label>
                            </div>
                        </div>

                        <div class="col-auto">
                            <input class="btn btn-primary mt-2" type="submit" value="Выбрать">
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            @foreach($data->all() as $item)
                <div class="col-3 py-3">
                    <div class="card h-100">
                        <div class="card-header text-center">
                            <img class="h-15rem" src="/storage/producers/{{$item->image}}" alt="{{$item->image}}">
                        </div>
                        <div class="card-body mb-0">
                            <ul class="list-group">
                                <li class="list-group-item">Фамилия: <b>{{$item->surname}}</b></li>
                                <li class="list-group-item">Имя: <b>{{$item->name}}</b></li>
                                <li class="list-group-item">Отчество: <b>{{$item->patronymic}}</b></li>
                                <li class="list-group-item">Дата рождения: <b>{{$item->date_of_birth}}</b></li>
                                <li class="list-group-item">Количество фильмов: <b>{{$item->getAmountFilms()}}</b></li>
                            </ul>
                        </div>
                        <div class="card-footer">

                        </div>
                    </div>
                </div>
            @endforeach
        </div>

{{--        <table class="table table-hover">--}}
{{--            <thead>--}}
{{--            <tr>--}}
{{--                <th>ID</th>--}}
{{--                <th>Фото</th>--}}
{{--                <th>Фамилия</th>--}}
{{--                <th>Имя</th>--}}
{{--                <th>Отчество</th>--}}
{{--                <th>Дата рождения</th>--}}
{{--                <th>Количество фильмов</th>--}}
{{--                <th class="text-center">--}}
{{--                    <a class="btn btn-success" href="/add/producer"><i class="bi bi-plus-lg"></i>Добавить...</a>--}}
{{--                </th>--}}
{{--            </tr>--}}
{{--            </thead>--}}
{{--            <tbody>--}}

{{--            @foreach($data->all() as $item)--}}
{{--                <tr class="align-middle">--}}
{{--                    <td>{{$item->id}}</td>--}}
{{--                    <td>--}}
{{--                        <img class="h-7rem" src="{{asset("storage/producers/$item->image")}}" alt="{{$item->image}}">--}}
{{--                    </td>--}}
{{--                    <td>{{$item->surname}}</td>--}}
{{--                    <td>{{$item->name}}</td>--}}
{{--                    <td>{{$item->patronymic}}</td>--}}
{{--                    <td>{{$item->date_of_birth}}</td>--}}
{{--                    <td>{{$item->getAmountFilms()}}</td>--}}
{{--                    <td class='text-center'>--}}
{{--                        <a class="btn btn-warning" href='/edit/producer/{{$item->id}}'><i--}}
{{--                                class='bi bi-pencil-fill'></i></a>--}}
{{--                    </td>--}}
{{--                </tr>--}}
{{--            @endforeach--}}
{{--            </tbody>--}}
{{--        </table>--}}
    </section>

@endsection
