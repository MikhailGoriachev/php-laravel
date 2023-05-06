@extends('layouts.layout')

@section('title', 'Модели')

@section('tablesActive', 'active')

@section('content')

    <section class="mx-5 my-4 bg-light shadow-sm border rounded-3 min-vh-100 p-3">
        <h4 class="text-center">Прокаты</h4>

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
                    <th class="text-center">
                        <a class="btn btn-success" href="add/rental"><i class="bi bi-plus-lg"></i>Добавить...</a>
                    </th>
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
                        <td class='text-center'>
                            <a class="btn btn-warning" href='edit/rental/{{$item->id}}'><i class='bi bi-pencil-fill'></i></a>
                            <a class="btn btn-danger" href="/remove/rental/{{$item->id}}" title="Удалить">
                                <i class="bi bi-trash-fill"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>

@endsection
