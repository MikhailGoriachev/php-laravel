{{-- подключение шаблона --}}
@extends('layouts.layout')

{{-- задать параметр шаблона - имя активной страницы--}}
@section('active_person', 'active')

<!-- секция контента -->
@section('main_part')
    <div class="d-flex my-3">
        <h3>Демонстрация <u>записи</u>/<u>чтения</u> объекта в файл/из файла</h3>
        <a href="/add-person" class="ms-3 btn btn-success">Добавить данные</a>
    </div>
    <div class="row my-3">
        <h4>Из файла прочитано:</h4>
        <pre>
        {{ $content }}
        </pre>
    </div>
@endsection
