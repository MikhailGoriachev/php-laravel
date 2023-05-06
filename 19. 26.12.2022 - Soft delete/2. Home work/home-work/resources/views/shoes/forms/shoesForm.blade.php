@extends('layouts.layout')

@section('title', ($isAdd ? 'Добавление' : 'Изменение') . ' обуви')

@section('tablesActive', 'active')

@section('content')

    <div class="min-vh-100">
        <section class="w-50 mx-auto my-4 bg-light shadow-sm border rounded-3 p-3">


            <form action="{{$isAdd ? '/shoes/create' : '/shoes/edit'}}" method="post">
                @csrf

                <h4 class="text-center mb-4">{{($isAdd ? 'Добавление' : 'Изменение') . ' обуви'}}</h4>

                {{-- id --}}
                <input type="hidden" name="id" value="{{(isset($item) ? $item->id : old('id'))}}">

                {{-- Производитель --}}
                <div class="form-floating my-3">
                    <select name="manufacture_id" class="form-select @error('manufacture_id') is-invalid @enderror">
                        @foreach($manufactureList as $m)
                            <option
                                value="{{$m['key']}}" {{($m['key'] === (isset($item)
                                        ? $item->manufacture_id
                                        : old('manufacture_id')) ? 'selected' : '')}}>
                                {{$m['value']}}
                            </option>
                        @endforeach
                    </select>
                    <label class="form-label">Производитель</label>
                </div>

                @error('manufacture_id')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                {{-- Тип обуви --}}
                <div class="form-floating my-3">
                    <select name="shoes_type_id" class="form-select @error('shoes_type_id') is-invalid @enderror">
                        @foreach($shoesTypeList as $m)
                            <option
                                value="{{$m['key']}}" {{($m['key'] === (isset($item)
                                                    ? $item->shoes_type_id
                                                    : old('shoes_type_id')) ? 'selected' : '')}}>
                                {{$m['value']}}
                            </option>
                        @endforeach
                    </select>
                    <label class="form-label">Тип обуви</label>
                </div>

                @error('shoes_type_id')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                {{-- Уникальный код товара --}}
                <div class="form-floating my-3">
                    <input name="code" class="form-control @error('code') is-invalid @enderror"
                           type="number" placeholder=" "
                           value="{{ isset($item) ? $item->code : old('code') }}">
                    <label class="form-label">Код товара</label>
                </div>

                {{-- Стоимость --}}
                <div class="form-floating my-3">
                    <input name="price" class="form-control @error('price') is-invalid @enderror"
                           type="number" placeholder=" "
                           value="{{ isset($item) ? $item?->price : old('price') }}">
                    <label class="form-label">Стоимость (&#8381;)</label>
                </div>

                @error('price')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="mt-5">
                    <input class="btn btn-primary w-10rem me-2" type="submit"
                           value="{{$isAdd ? 'Добавить' : 'Сохранить'}}">
                    <a class="btn btn-secondary w-10rem" href="/shoes/index">Назад</a>
                </div>
            </form>
        </section>
    </div>
@endsection
