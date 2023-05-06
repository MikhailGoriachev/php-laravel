@extends('layouts/layout')

@section('title', 'О разработчике')

@section('content')
    <div class="min-vh-100">
        <section class="w-50 mx-auto my-4 bg-light shadow-sm border rounded-3 p-3">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="border rounded bg-white shadow-sm">
                            <img class="w-100" src="images/icon.svg" alt="">
                        </div>
                    </div>
                    <div class="col-auto">
                        <ul class="list-group shadow-sm">
                            <li class="list-group-item">
                                Разработчик:
                                <a href="https://github.com/MikhailGoriachev" target="_bank">
                                    <b>Горячев Михаил</b>
                                </a>
                            </li>
                            <li class="list-group-item">
                                Группа: <b>ПД011</b>
                            </li>
                            <li class="list-group-item">
                                Город: <b>Донецк</b>
                            </li>
                            <li class="list-group-item">
                                Год создания: <b>2022</b>
                            </li>
                            <li class="list-group-item">
                                Поддержка:
                                <a href="mailto:goriachevmichael@gmail.com">
                                    <b>goriachevmichael@gmail.com</b>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
