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
                    <input name="fullName" class="form-control @error('fullName') is-invalid @enderror"
                           type="text"
                           id="id_fullName"
                           value="{{ old('fullName') }}">
                </div>
            </div>
            <div class="row my-3">
                <label class="form-label col-3" for="id_age">Возраст, лет:</label>
                <div class="col-9">
                    <input name="age" class="form-control @error('age') is-invalid @enderror"
                           type="number" id="id_age"
                           value="{{ old('age') }}">
                </div>
            </div>
            <div class="row my-3">
                <label class="form-label col-3" for="id_salary">Оклад, руб.:</label>
                <div class="col-9">
                    <input name="salary"  class="form-control @error('salary') is-invalid @enderror"
                           type="number"
                           id="id_salary"
                           value="{{ old('salary') }}">
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

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

@endsection
