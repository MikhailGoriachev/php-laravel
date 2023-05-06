{{-- подключение шаблона --}}
@extends('layouts.layout')

{{-- задать параметр шаблона - имя активной страницы--}}
@section('active_person', 'active')

<!-- секция контента -->
@section('main_part')
    <div class="w-50 mx-auto">
        <h4>Данные объекта класса Person, введенные в форму</h4>
        <h5>Строковое представление <u>{{ $person }}</u></h5>
        <ul class="list-group w-50">
            <li class="list-group-item d-flex justify-content-between px-3">
                <span>Фамилия И.О:</span> <strong>{{ $person->fullName }}</strong>
            </li>
            <li class="list-group-item d-flex justify-content-between px-3">
                <span>Возраст, лет:</span> <strong>{{ $person->age }}</strong>
            </li>
            <li class="list-group-item d-flex justify-content-between px-3">
                <span>Оклад, руб:</span> <strong>{{ $person->salary }}</strong>
            </li>
        </ul>

        {{-- демонстрация форматирования в строку таблицы - не рабоает задание ширины поля вывода --}}
{{--        <pre>--}}
{{--            {{ $person->toTableRow() }}--}}
{{--            {{ $person->toTableRow() }}--}}
{{--        </pre>--}}
    </div>

    <div class="w-50 mx-auto">
        <h4>Данные объекта класса Person, прочтанные из файла CSV</h4>
        <h5>Строковое представление <u>{{ $p1 }}</u></h5>
        <ul class="list-group w-50">
            <li class="list-group-item d-flex justify-content-between px-3">
                <span>Фамилия И.О:</span> <strong>{{ $p1->fullName }}</strong>
            </li>
            <li class="list-group-item d-flex justify-content-between px-3">
                <span>Возраст, лет:</span> <strong>{{ $p1->age }}</strong>
            </li>
            <li class="list-group-item d-flex justify-content-between px-3">
                <span>Оклад, руб:</span> <strong>{{ $p1->salary }}</strong>
            </li>
        </ul>

{{--        <pre>--}}
{{--            {{ $person->toTableRow() }}--}}
{{--            {{ $person->toTableRow() }}--}}
{{--        </pre>--}}

    </div>
@endsection
