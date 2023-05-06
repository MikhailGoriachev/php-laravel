@extends('layouts.layout')

{{-- задать параметр шаблона - имя активной страницы--}}
@section('active_form1', 'active')

<!-- секция контент -->
@section('main_part')

    {{-- форма с обработкой данных GET --}}
    <div class="offset-2 col-5">
        <h4>Форма ввода form1, GET-обработка</h4>
        <div class="my-3">
            <form action="/handle1" >
                <div class="row my-3">
                    <label class="form-label col-3" for="id_name">Полное имя:</label>
                    <div class="col-9">
                        <input class="form-control" type="text" name="fullName" id="id_name">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="form-label col-3" for="id_age">Возраст:</label>
                    <div class="col-9">
                        <input class="form-control" type="number" name="age" id="id_age">
                    </div>
                </div>

                {{-- поле ввода - радиокнопки --}}
                <div class="row mb-3">
                    <div class="col-3">
                        <p>Подготовка:</p>
                    </div>
                    <div class="col-9">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="skill" id="rb1" value="starter">
                            <label class="form-check-label" for="rb1">
                                начальный уровень
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="skill" id="rb2" value="essential">
                            <label class="form-check-label" for="rb2">
                                средний уровень
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="skill" id="rb3" value="professional">
                            <label class="form-check-label" for="rb3">
                                продвинутый уровень
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="skill" id="rb4" value="expert">
                            <label class="form-check-label" for="rb4">
                                эксперт уровень
                            </label>
                        </div>
                    </div>
                </div>

                {{-- поле вода - чекбокс --}}
                <div class="mb-3 row form-check">
                    <div class="offset-3 col-9">
                        <input class="form-check-input" type="checkbox" name="certified" id="id_certified">
                        <label class="form-check-label" for="id_certified">
                            сертифицирован
                        </label>
                    </div>
                </div>

                <div class="my-3 row">
                    <div class="offset-3 col-9">
                        <input class="btn btn-success" type="submit" value="Отправить">
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
