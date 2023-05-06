@extends('layouts/layout')

@section('title', $title ?? 'Ошибка')

@section($activeTab ?? '', 'active')

@section('content')
    <section class="mx-5 my-4 bg-light shadow-sm border rounded-3 min-vh-100 p-3">
        <div class="row">
            <div class="m-3 alert alert-danger col-auto" role="alert">
                {{ $message }}. <b><a href="/">Перейти на главную</a></b>
            </div>
        </div>
    </section>
@endsection
