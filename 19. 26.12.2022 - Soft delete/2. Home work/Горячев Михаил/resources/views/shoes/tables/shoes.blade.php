@extends('layouts.layout')

@section('title', 'Обувь')

@section('tablesActive', 'active')

@section('content')

    <section class="mx-5 my-4 bg-light shadow-sm border rounded-3 min-vh-100 p-3">
        <h4 class="text-center">Обувь</h4>

        <form action="/shoes/show" method="post">
            @csrf
            <div class="row">

                {{-- Тип обуви --}}
                <div class="col-auto">
                    <div class="form-floating my-3">
                        <select name="shoes_type_id" class="form-select @error('shoes_type_id') is-invalid @enderror">
                            @foreach($shoesTypeList as $s)
                                <option
                                    value="{{$s['key']}}" {{($s['key'] === ($shoes_type_id ?? old('shoes_type_id')) ? 'selected' : '')}}>
                                    {{$s['value']}}
                                </option>
                            @endforeach
                        </select>
                        <label class="form-label">Тип обуви</label>
                    </div>
                </div>

                <div class="col-auto mt-4">
                    <input class="btn btn-success w-8rem" type="submit" value="Выбрать">
                </div>
                <div class="col-auto mt-4">
                    <a class="btn btn-warning w-8rem" href="/shoes/index">Сброс</a>
                </div>
            </div>
        </form>

        <table class="table table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Код товара</th>
                <th>Производитель</th>
                <th>Тип обуви</th>
                <th>Цена</th>
                <th class="text-center">
                    <a class="btn btn-success" href="shoes/create"><i class="bi bi-plus-lg"></i>Добавить...</a>
                </th>
            </tr>
            </thead>
            <tbody>

            @foreach($data->all() as $item)
                <tr class="align-middle">
                    <td>{{$item->id}}</td>
                    <td>{{$item->code}}</td>
                    <td>{{$item->manufacture->name}}</td>
                    <td>{{$item->shoes_type->name}}</td>
                    <td>{{$item->price}}</td>
                    <td class='text-center'>
                        <a class="btn btn-warning" href='shoes/edit/{{$item->code}}'><i
                                class='bi bi-pencil-fill'></i></a>
                        <a class="btn btn-danger" href="shoes/delete/{{$item->code}}" title="Удалить">
                            <i class="bi bi-trash-fill"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </section>

@endsection
