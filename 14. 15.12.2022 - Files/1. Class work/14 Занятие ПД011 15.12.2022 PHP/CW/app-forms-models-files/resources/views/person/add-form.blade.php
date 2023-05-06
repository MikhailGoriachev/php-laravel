{{-- подключение шаблона --}}
@extends('layouts.layout')

{{-- задать параметр шаблона - имя активной страницы--}}
@section('active_person', 'active')

<!-- секция контента -->
@section('main_part')
    <div class="offset-2 col-5">
        <h4>Форма ввода данных для объекта класса <u>Person</u></h4>
        <form action="/handle-add-person" method="post" >
            {{-- защита от CSRF (Cross Site ReFerence ) атак --}}
            @csrf
            <div class="row my-3">
                <label class="form-label col-3" for="id_fullName">Фамилия И.О.:</label>
                <div class="col-9">
                    <input class="form-control" type="text" name="fullName" id="id_fullName">
                </div>
            </div>
            <div class="row my-3">
                <label class="form-label col-3" for="id_age">Возраст, лет:</label>
                <div class="col-9">
                    <input class="form-control" type="number" name="age" id="id_age" min="16" max="145">
                </div>
            </div>
            <div class="row my-3">
                <label class="form-label col-3" for="id_salary">Оклад, руб.:</label>
                <div class="col-9">
                    <input class="form-control" type="number" name="salary" id="id_salary" min="0">
                </div>
            </div>

            <div class="my-3 row">
                <div class="offset-3 col-3 me-3">
                    <input class="btn btn-success" type="submit" value="Сохранить">
                </div>
                <div class="col-3">
                    <input class="btn btn-secondary" type="reset" value="Сбросить">
                </div>
            </div>
        </form>
    </div>

@endsection
