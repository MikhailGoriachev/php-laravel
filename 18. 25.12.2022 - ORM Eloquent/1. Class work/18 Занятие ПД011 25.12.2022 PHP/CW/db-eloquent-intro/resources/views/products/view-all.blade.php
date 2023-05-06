@extends('layouts.layout')

{{-- задать параметр шаблона - имя активной страницы--}}
@section('active_products', 'active')

<!-- секция контент -->
@section('main_part')
    <h4 class="text-center my-5">Страница products/view-all</h4>

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
                <td>{{ $product->category->category }}</td>
                <td>{{ number_format($product->price, 2) }}</td>
                <td>{{ $product->amount }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <h4 class="text-center">Товары с ценой > 500 или количеством = 100 (жадная загрузки)</h4>
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
                <td>{{ $product->category->category }}</td>
                <td>{{ number_format($product->price, 2) }}</td>
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
                <td>{{ $product->category->category }}</td>
                <td>{{ number_format($product->price, 2)  }}</td>
                <td>{{ $product->amount }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
