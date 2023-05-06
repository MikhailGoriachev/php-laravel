@extends('layouts.layout')

{{-- задать параметр шаблона - имя активной страницы--}}
@section('active_read', 'active')

<!-- секция контент -->
@section('main_part')
    <h4 class="text-center my-5">Страница categories/view-all</h4>

    <h4 class="text-center">Оригинальные имена полей</h4>
    <ul class="list-group w-50 mx-auto my-5">
        @foreach($categories as $category)
            <li class="list-group-item">
                <b>{{ $category->id }}</b> {{ $category->category }}
            </li>
        @endforeach
    </ul>

    <h4 class="text-center">Переименованные поля</h4>
    <ul class="list-group w-50 mx-auto my-5">
        @foreach($categories1 as $category)
            <li class="list-group-item">
                <b>{{ $category->number }}</b> {{ $category->name }}
            </li>
        @endforeach
    </ul>

    <h4 class="text-center">Товары с расшифровкой полей</h4>
    <table class="table table-bordered w-75 mx-auto my-5">
        <thead>
            <tr>
                <th>ИД</th>
                <th>Наименование товара</th>
                <th>Категория</th>
                <th>Цена</th>
                <th>Количество</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->amount }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h4 class="text-center">Товары с расшифровкой полей, с ценой > 500 или количеством = 100</h4>
    <table class="table table-bordered w-75 mx-auto my-5">
        <thead>
            <tr>
                <th>ИД</th>
                <th>Наименование товара</th>
                <th>Категория</th>
                <th>Цена</th>
                <th>Количество</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products1 as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->amount }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h4 class="text-center">Товары с расшифровкой полей, с ценой между 500 и 300</h4>
    <table class="table table-bordered w-75 mx-auto my-5">
        <thead>
            <tr>
                <th>ИД</th>
                <th>Наименование товара</th>
                <th>Категория</th>
                <th>Цена</th>
                <th>Количество</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products2 as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->amount }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
