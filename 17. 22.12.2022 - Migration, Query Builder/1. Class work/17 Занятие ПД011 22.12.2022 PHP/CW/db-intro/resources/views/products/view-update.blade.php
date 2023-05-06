@extends('layouts.layout')

{{-- задать параметр шаблона - имя активной страницы--}}
@section('active_update', 'active')

<!-- секция контент -->
@section('main_part')
    <h4 class="text-center my-5">Обновление записи о товаре с идентфиикатором {{ $id }}</h4>
    <!-- взято тут: https://bootstrap-4.ru/docs/5.1/components/alerts/ -->
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
        </symbol>
    </svg>

    <div class="alert alert-success d-flex align-items-start w-50 mx-auto p-3">
        <svg class="bi flex-shrink-0 me-3" width="24" height="24">
            <use xlink:href="#info-fill"/>
        </svg>
        <div>
            <strong>К сведению</strong><br>
            Запись с идентфикатором <b>{{ $id }} {{ $num == 0?"НЕ":"" }}</b> изменена в таблице <b><u>products</u></b><br>
            Всего обновлено записей: {{ $num  }}
        </div>
    </div>

@endsection
