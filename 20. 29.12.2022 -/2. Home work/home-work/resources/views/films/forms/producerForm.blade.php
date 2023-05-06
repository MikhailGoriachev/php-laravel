@extends('layouts.layout')

@section('title', ($isAdd ? 'Добавление' : 'Изменение') . ' режиссёра')

@section('tablesActive', 'active')

@section('content')

    <div class="min-vh-100">
        <section class="w-50 mx-auto my-4 bg-light shadow-sm border rounded-3 p-3">

            <form action="{{$isAdd ? '/add/producer' : '/edit/producer'}}" method="post" enctype="multipart/form-data">
                @csrf

                <h4 class="text-center mb-4">{{($isAdd ? 'Добавление' : 'Изменение') . ' режиссёра'}}</h4>

                {{-- id --}}
                <input type="hidden" name="id" value="{{(isset($item) ? $item->id : old('id'))}}">


                {{-- Фамилия --}}
                <div class="form-floating my-3">
                    <input name="surname" class="form-control @error('surname') is-invalid @enderror"
                           type="text" placeholder=" "
                           value="{{ isset($item) ? $item->surname : old('surname') }}">
                    <label class="form-label">Фамилия</label>
                </div>

                @error('surname')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror


                {{-- Имя --}}
                <div class="form-floating my-3">
                    <input name="name" class="form-control @error('name') is-invalid @enderror"
                           type="text" placeholder=" "
                           value="{{ isset($item) ? $item->name : old('name') }}">
                    <label class="form-label">Имя</label>
                </div>

                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror


                {{-- Отчество --}}
                <div class="form-floating my-3">
                    <input name="patronymic" class="form-control @error('patronymic') is-invalid @enderror"
                           type="text" placeholder=" "
                           value="{{ isset($item) ? $item->patronymic : old('patronymic') }}">
                    <label class="form-label">Отчество</label>
                </div>

                @error('patronymic')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror


                {{-- Дата рождения --}}
                <div class="form-floating">
                    <input type="date" name="date_of_birth" class="form-control"
                           value="{{ isset($item) ? $item->date_of_birth : old('date_of_birth') }}">
                    <label class="form-label">Дата рождения</label>
                </div>

                @error('date_of_birth')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror


                {{-- Изображение (название файла) --}}
                <input type="hidden" name="image" value="{{ isset($item) ? $item->image : old('budget') }}">


                {{-- Файл изображения --}}
                <div class="form-floating my-3">
                    <input name="file" type="file" class="form-control p-5" placeholder=" ">
                    <label class="form-label">Афиша</label>
                </div>

                @error('file')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror


                <div class="mt-5">
                    <input class="btn btn-primary w-10rem me-2" type="submit"
                           value="{{$isAdd ? 'Добавить' : 'Сохранить'}}">
                    <a class="btn btn-secondary w-10rem" href="/tables/producers">Назад</a>
                </div>
            </form>
        </section>
    </div>
@endsection
