{{-- подключение шаблона --}}
@extends('layouts.layout')

{{-- задать параметр шаблона - имя активной страницы--}}
@section('active_upload', 'active')

<!-- секция контента -->
@section('main_part')
    <div class="offset-2 col-5">
        <h4>Форма загрузки файла</h4>
        <form action="/handle-upload-file" method="post"
              enctype="multipart/form-data">
            {{-- защита от CSRF (Cross Site ReFerence ) атак --}}
            @csrf
            <div class="row my-3">
                <label class="form-label col-3" for="id_dataFile">Выберите файл (*.jpg, *.png)</label>
                <div class="col-9">
                    <input class="form-control" type="file" name="dataFile" id="id_dataFile">
                </div>
            </div>

            <div class="my-5 row">
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
