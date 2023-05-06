@extends('layouts.layout')

@section('title', ($isAdd ? 'Добавление' : 'Изменение') . ' фильма')

@section('tablesActive', 'active')

@section('content')

    <div class="min-vh-100">
        <section class="w-50 mx-auto my-4 bg-light shadow-sm border rounded-3 p-3">

            <form action="{{$isAdd ? '/add/film' : '/edit/film'}}" method="post" enctype="multipart/form-data">
                @csrf

                <h4 class="text-center mb-4">{{($isAdd ? 'Добавление' : 'Изменение') . ' фильма'}}</h4>

                {{-- id --}}
                <input type="hidden" name="id" value="{{(isset($item) ? $item->id : old('id'))}}">


                {{-- Название --}}
                <div class="form-floating my-3">
                    <input name="name" class="form-control @error('name') is-invalid @enderror"
                           type="text" placeholder=" "
                           value="{{ isset($item) ? $item->name : old('name') }}">
                    <label class="form-label">Название</label>
                </div>

                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror


                {{-- Режиссёр --}}
                <div class="form-floating my-3">
                    <select name="producer_id" class="form-select @error('producer_id') is-invalid @enderror">
                        @foreach($producerList as $m)
                            <option
                                value="{{$m['key']}}" {{($m['key'] === (isset($item)
                                        ? $item->producer_id
                                        : old('producer_id')) ? 'selected' : '')}}>
                                {{$m['value']}}
                            </option>
                        @endforeach
                    </select>
                    <label class="form-label">Режиссёр</label>
                </div>

                @error('producer_id')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                @error('image')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror


                {{-- Дата выхода --}}
                <div class="form-floating">
                    <input type="date" name="release_date" class="form-control"
                           value="{{ isset($item) ? $item->release_date : old('release_date') }}">
                    <label class="form-label">Дата выхода</label>
                </div>

                @error('release_date')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror


                {{-- Жанр --}}
                <div class="form-floating my-3">
                    <select name="genre_id" class="form-select @error('genre_id') is-invalid @enderror">
                        @foreach($genreList as $m)
                            <option
                                value="{{$m['key']}}" {{($m['key'] === (isset($item)
                                        ? $item->genre_id
                                        : old('genre_id')) ? 'selected' : '')}}>
                                {{$m['value']}}
                            </option>
                        @endforeach
                    </select>
                    <label class="form-label">Жанр</label>
                </div>

                @error('genre_id')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror


                {{-- Бюджет фильма --}}
                <div class="form-floating my-3">
                    <input name="budget" class="form-control @error('budget') is-invalid @enderror"
                           type="number" placeholder=" "
                           value="{{ isset($item) ? $item->budget : old('budget') }}">
                    <label class="form-label">Бюджет фильма</label>
                </div>

                @error('budget')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror


                {{-- Страна --}}
                <div class="form-floating my-3">
                    <select name="country_id" class="form-select @error('country_id') is-invalid @enderror">
                        @foreach($countryList as $m)
                            <option
                                value="{{$m['key']}}" {{($m['key'] === (isset($item)
                                        ? $item->country_id
                                        : old('country_id')) ? 'selected' : '')}}>
                                {{$m['value']}}
                            </option>
                        @endforeach
                    </select>
                    <label class="form-label">Страна</label>
                </div>

                @error('country_id')
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
                    <a class="btn btn-secondary w-10rem" href="/tables/films">Назад</a>
                </div>
            </form>
        </section>
    </div>
@endsection
