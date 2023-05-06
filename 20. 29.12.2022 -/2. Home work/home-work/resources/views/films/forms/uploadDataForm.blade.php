@extends('layouts.layout')

@section('title', 'Загрузка данных')

@section('uploadDataActive', 'active')

@section('content')

    <div class="min-vh-100">
        <section class="w-50 mx-auto my-4 bg-light shadow-sm border rounded-3 p-3">

            <form action="tables/upload-data" method="post" enctype="multipart/form-data">
                @csrf

                <h4 class="text-center mb-4">Загрузка данных</h4>


                {{-- Файл изображения --}}
                <div class="form-floating my-3">
                    <input name="file" type="file" class="form-control p-5" placeholder=" ">
                    <label class="form-label">Файл с данными в формате JSON</label>
                </div>

                @error('file')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror


                <div class="mt-5">
                    <input class="btn btn-primary w-10rem me-2" type="submit"
                           value="Загрузить">
                    <a class="btn btn-secondary w-10rem" href="/tables/films">Отмена</a>
                </div>
            </form>
        </section>
    </div>
@endsection
