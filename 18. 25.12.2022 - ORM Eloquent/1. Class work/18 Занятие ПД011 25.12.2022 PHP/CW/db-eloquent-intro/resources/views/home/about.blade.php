@extends('layouts.layout')

{{-- задать параметр шаблона - имя активной страницы--}}
@section('active_about', 'active')

<!-- секция контента: вывод фамилии, имени, группы студента, произвольной картинки -->
@section('main_part')
    <h4 class="text-center">Сведения о разработчике</h4>
    <ul class="list-group my-5 mx-auto w-25">
        <li class="list-group-item d-flex justify-content-between px-5"><span>Имя:</span> <b>Студент</b></li>
        <li class="list-group-item d-flex justify-content-between px-5"><span>Фамилия:</span> <b>Программер</b></li>
        <li class="list-group-item d-flex justify-content-between px-5"><span>Группа:</span> <b>ПД011</b></li>
    </ul>
    <div class="text-center">
        <h5>Рабочее место Тейлора Отвелла, главного разработчика Laravel</h5>
        <img class="w-50" src="{{ asset("/images/tailor_at_works.jpg") }}" >
    </div>
@endsection
