{{-- подключение шаблона --}}
@extends('layouts.layout')

{{-- задать параметр шаблона - имя активной страницы--}}
@section('active_read', 'active')

<!-- секция контента -->
@section('main_part')
    <h3>Демонстрация <u>чтения</u> из файла</h3>
    <div>
        <h4>Из файла прочитано:</h4>
        <pre>
        {{ $content }}
        </pre>
    </div>
@endsection
