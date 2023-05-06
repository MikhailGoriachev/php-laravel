@extends('layouts.layout')

{{-- задать параметр шаблона - имя активной страницы--}}
@section('active_products', 'active')

<!-- секция контент -->
@section('main_part')
    <h4 class="text-center my-5">Страница products/view-all</h4>

    <h4 class="text-center">Товары с расшифровкой полей</h4>
    <table class="table table-bordered w-75 mx-auto my-5">
        <thead>
        <tr class="text-center">
            <th>ИД</th>
            <th>Наименование товара</th>
            <th>Категория</th>
            <th>Цена ед., руб.</th>
            <th>Количество, ед.</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->category->name }}</td>
                <td class="text-end px-3">{{ number_format($product->price, 2) }}</td>
                <td class="text-end px-3">{{ $product->amount }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <h4 class="text-center">Товары с расшифровкой полей и вычисляемым полем (жадная загрузка)</h4>
    <table class="table table-bordered w-75 mx-auto my-5">
        <thead>
        <tr class="text-center">
            <th>ИД</th>
            <th>Наименование товара</th>
            <th>Категория</th>
            <th>Цена за ед., руб.</th>
            <th>Количество, ед.</th>
            <th>Сумма, руб.</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products1 as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->category->name }}</td>
                <td class="text-end px-3">{{ number_format($product->price, 2) }}</td>
                <td class="text-end px-3">{{ $product->amount }}</td>
                <td class="text-end px-3">{{ number_format($product->total, 2) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <h4 class="text-center">Товары с ценой > 500 или количеством = 100 (жадная загрузка)</h4>
    <table class="table table-bordered w-75 mx-auto my-5">
        <thead>
        <tr class="text-center">
            <th>ИД</th>
            <th>Наименование товара</th>
            <th>Категория</th>
            <th>Цена ед., руб.</th>
            <th>Количество, ед.</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products2 as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->category->name }}</td>
                <td class="text-end px-3">{{ number_format($product->price, 2) }}</td>
                <td class="text-end px-3">{{ $product->amount }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <h4 class="text-center">Товары с расшифровкой полей, с ценой между 500 и 300 (жадная загрузка)</h4>
    <table class="table table-bordered w-75 mx-auto my-5">
        <thead>
        <tr class="text-center">
            <th>ИД</th>
            <th>Наименование товара</th>
            <th>Категория</th>
            <th>Цена ед., руб.</th>
            <th>Количество, ед.</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products3 as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->category->name }}</td>
                <td class="text-end px-3">{{ number_format($product->price, 2)  }}</td>
                <td class="text-end px-3">{{ $product->amount }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
