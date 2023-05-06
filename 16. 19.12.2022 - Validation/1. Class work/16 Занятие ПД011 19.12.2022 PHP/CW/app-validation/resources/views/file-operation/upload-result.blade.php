{{-- подключение шаблона --}}
@extends('layouts.layout')

{{-- задать параметр шаблона - имя активной страницы--}}
@section('active_upload', 'active')

<!-- секция контента -->
@section('main_part')
    <h4>Файл загружен</h4>
    <p>Имя файла от клиента: <strong>{{ $clientOriginalName }}</strong></p>
    <p>Имя файла на сервере: <strong>{{ $path }}</strong></p>
    <p>URL файла на сервере, для использования: <strong>{{ $pathUrl }}</strong></p>

    <h5>Что загружено:</h5>
    <img src="{{ $pathUrl }}" alt="картинка, загруженная на сервер"/>
@endsection
