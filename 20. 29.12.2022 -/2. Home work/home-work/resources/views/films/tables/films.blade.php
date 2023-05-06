@extends('layouts.layout')

@section('title', 'Фильмы')

@section($isTitles ? 'indexActive' : 'tablesActive', 'active')

@section('content')

    <section class="mx-5 my-4 bg-light shadow-sm border rounded-3 min-vh-100 p-3">
        <h4 class="text-center">Фильмы</h4>

        @if(!$isTitles)
        <div class="row">
            <div class="col-auto">
                <a class="btn btn-success mt-2" href="/tables/films">Все фильмы</a>
            </div>

            {{-- Фильмы, вышедшие на экран в текущем и прошлом году --}}
            <div class="col-auto">
                <a class="btn btn-primary mt-2" href="/tables/films/by-current-and-last-year">Текущий и прошлый год</a>
            </div>

            {{-- Фильмы, дата выхода которых была более заданного числа лет назад --}}
            <div class="col-auto ms-3">
                <form action="/tables/films/by-over-years-last" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-auto">
                            <div class="form-floating">
                                <input type="number" name="years"
                                       class="form-control"
                                       title="Фильмы, дата выхода которых была более заданного числа лет назад"
                                       placeholder=" " min="1" required
                                       value="{{$years ?? null}}">
                                <label class="form-label">Возраст фильма от (лет):</label>
                            </div>
                        </div>

                        <div class="col-auto">
                            <input class="btn btn-primary mt-2" type="submit" value="Выбрать">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @endif

        @if($isTitles)
            <div class="row">
                @foreach($data->all() as $item)
                    <div class="col-3 py-3">
                        <div class="card h-100">
                            <div class="card-header text-center">
                                <img class="h-15rem" src="/storage/films/{{$item->image}}" alt="{{$item->image}}">
                            </div>
                            <div class="card-body mb-0">
                                <ul class="list-group">
                                    <li class="list-group-item">Название: <b>{{$item->name}}</b></li>
                                    <li class="list-group-item">Режиссёр: <b>{{$item->producer->surname . ' ' . $item->producer->name . ' ' . $item->producer->patronymic}}</b></li>
                                    <li class="list-group-item">Дата выхода: <b>{{$item->release_date}}</b> </li>
                                    <li class="list-group-item">Жанр: <b>{{$item->genre->name}}</b></li>
                                    <li class="list-group-item">Бюджет: <b>{{$item->budget}} $</b></li>
                                    <li class="list-group-item">Страна: <b>{{$item->country->name}}</b></li>
                                </ul>
                            </div>
                            <div class="card-footer">

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Афиша</th>
                    <th>Название</th>
                    <th>Режиссёр</th>
                    <th>Дата выхода</th>
                    <th>Жанр</th>
                    <th>Бюджет</th>
                    <th>Страна</th>
                    <th class="text-center">
                        <a class="btn btn-success" href="/add/film"><i class="bi bi-plus-lg"></i>Добавить...</a>
                    </th>
                </tr>
                </thead>
                <tbody>

                @foreach($data->all() as $item)
                    <tr class="align-middle">
                        <td>{{$item->id}}</td>
                        <td>
                            <img class="h-7rem" src="{{asset("storage/films/$item->image")}}" alt="{{$item->image}}">
                        </td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->producer->surname . ' ' . $item->producer->name . ' ' . $item->producer->patronymic}}</td>
                        <td>{{$item->release_date}}</td>
                        <td>{{$item->genre->name}}</td>
                        <td>{{$item->budget}}</td>
                        <td>{{$item->country->name}}</td>
                        <td class='text-center'>
                            <a class="btn btn-warning" href='/edit/film/{{$item->id}}'><i
                                    class='bi bi-pencil-fill'></i></a>
                            <a class="btn btn-danger" href="/delete/film/{{$item->id}}" title="Удалить">
                                <i class="bi bi-trash-fill"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </section>

@endsection
