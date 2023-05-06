{{-- подключение шаблона --}}
@extends('layouts.layout')

{{-- задать параметр шаблона - имя активной страницы--}}
@section('active_upload', 'active')

<!-- секция контента -->
@section('main_part')
    <h4>Файл загружен</h4>
    <p>Имя файла: <strong>{{ $path }}</strong></p>
@endsection
