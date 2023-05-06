@extends('layouts.layout')

{{-- задать параметр шаблона - имя активной страницы--}}
@section('active_read', 'active')

<!-- секция контент -->
@section('main_part')
    <h4 class="text-center my-5">Страница categories/view-all</h4>

    <div class="row">
        <div class="col-4 mx-3">
            <h4 class="text-center">Категории товаров</h4>
            <table class="table table-bordered w-100 my-3">
                <thead>
                <tr>
                    <th>ИД</th>
                    <th>Категория</th>
                    <th>Артикул</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->article->name }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="col-4 mx-3">
            <h4 class="text-center">Выборка из категории товаров</h4>
            <table class="table table-bordered my-3">
                <thead>
                <tr>
                    <th>ИД</th>
                    <th>Категория</th>
                    <th>Артикул</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories1 as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->article->name }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="col-4 mx-3">
            <h4 class="text-center">Выборка первой записи из категории товаров</h4>
            <table class="table table-bordered my-5">
                <thead>
                <tr>
                    <th>ИД</th>
                    <th>Категория</th>
                    <th>Артикул</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>{{ $categories2->id }}</td>
                    <td>{{ $categories2->name }}</td>
                    <td>{{ $categories2->article->name }}</td>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="col-4 mx-3">
            <h4 class="text-center">Выборка записи по id категории товаров</h4>
            <table class="table table-bordered my-5">
                <thead>
                <tr>
                    <th>ИД</th>
                    <th>Категория</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>{{ $categories3->id }}</td>
                    <td>{{ $categories3->name }}</td>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="col-4 mx-3">
            <h4 class="text-center">Выборка группы записей по id из категории товаров</h4>
            <table class="table table-bordered my-5">
                <thead>
                <tr>
                    <th>ИД</th>
                    <th>Категория</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories4 as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
