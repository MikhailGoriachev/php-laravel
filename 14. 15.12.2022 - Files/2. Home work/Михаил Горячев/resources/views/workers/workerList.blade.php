@extends('layouts.layout')

@section('title', 'Работники')

@section('workersActive', 'active')

@section('content')

    <section class="mx-5 my-4 bg-light shadow-sm border rounded-3 min-vh-100 p-3">
        <h4 class="text-center">{{$title ?? 'Работники'}}</h4>

        <div class="row">
            <div class="col-auto">
                <a class="btn btn-success mt-2" href="/workers/allData">Исходные данные</a>
            </div>
            <div class="col-auto">
                <a class="btn btn-primary mt-2" href="/workers/selectByMaxSalary">Максимальный оклад</a>
            </div>
            <div class="col-auto">
                <a class="btn btn-primary mt-2" href="/workers/selectByMinSalary">Минимальный оклад</a>
            </div>
            <div class="col-auto">
                <form action="/workers/selectByOverExperience" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-auto">
                            <div class="form-floating">
                                <input class="form-control w-22rem" type="number" min="0" name="experience"
                                       value="{{$experience ?? null}}" placeholder=" " required>
                                <label class="form-label">Минимальный стаж работы (лет)</label>
                            </div>
                        </div>

                        <div class="col-auto mt-2">
                            <input class="btn btn-success" type="submit" value="Выделить">
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            <table class="table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Фотография</th>
                    <th>Фамилия и инициалы</th>
                    <th>Должность</th>
                    <th>Пол</th>
                    <th>Год трудоустройства</th>
                    <th>Стаж</th>
                    <th>Оклад (&#8381;)</th>
                    <th class="text-center">
                        <a class="btn btn-success" href="/workers/addForm" title="Добавить...">
                            <i class="bi bi-plus-lg"></i> Добавить
                        </a>
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $item)
                    <tr class="align-middle {{isset($predicate) && $predicate($item) ? 'bg-light-green' : ''}}">
                        <th>{{$item->id}}</th>
                        <td>
                            <img src="{{asset("images/people/$item->image")}}" class="h-5rem" alt="image">
                        </td>
                        <td>{{$item->fullName}}</td>
                        <td>{{$item->position}}</td>
                        <td>{{$item->gender ? 'мужской' : 'женский'}}</td>
                        <td>{{$item->yearOfEmployment}}</td>
                        <td>{{$item->getExperience()}}</td>
                        <td>{{$item->salary}}</td>
                        <td class="text-center">
                            <a class="btn btn-warning" href="/workers/editForm/{{$item->id}}" title="Изменить...">
                                <i class="bi bi-pencil-fill"></i>
                            </a>
                            <a class="btn btn-danger" href="/workers/delete/{{$item->id}}" title="Удалить">
                                <i class="bi bi-trash-fill"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>

@endsection
