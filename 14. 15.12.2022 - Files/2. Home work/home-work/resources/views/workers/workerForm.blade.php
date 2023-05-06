@extends('layouts.layout')

@section('title', ($isAdd ? 'Добавление' : 'Изменение') . ' работника')

@section('workersActive', 'active')

@section('content')

    <div class="min-vh-100">
        <section class="w-50 mx-auto my-4 bg-light shadow-sm border rounded-3 p-3">


            <form action="{{$isAdd ? '/workers/add' : '/workers/edit'}}" method="post">
                @csrf

                <h4 class="text-center mb-4">{{($isAdd ? 'Добавление' : 'Изменение') . ' работника'}}</h4>

                {{-- id --}}
                <input type="hidden" name="id" value="{{$id ?? 0}}">

                {{-- Фотография --}}
                <input type="hidden" name="image" value="{{$image ?? ''}}">

                {{-- Фамилия и инициалы --}}
                <div class="form-floating my-3">
                    <input name="fullName" class="form-control" type="text" placeholder=" "
                           value="{{ $fullName ?? null }}" required>
                    <label class="form-label">Фамилия и инициалы</label>
                </div>

                {{-- Должность --}}
                <div class="form-floating my-3">
                    <select name="position" class="form-select" required>
                        @foreach($positionList as $pos)
                            <option value="{{$pos}}" {{($pos === ($position ?? '') ? 'selected' : '')}}>{{$pos}}</option>
                        @endforeach
                    </select>
                    <label class="form-label">Должность</label>
                </div>

                {{-- Пол --}}
                <div class="form-floating my-3">
                    <select name="gender" class="form-select" required>
                        <option value="1" {{($gender ?? true) ? 'selected' : ''}}>Мужской</option>
                        <option value="0" {{!($gender ?? false) ? 'selected' : ''}}>Женский</option>
                    </select>
                    <label class="form-label">Пол</label>
                </div>

                {{-- Год трудоустройства --}}
                <div class="form-floating my-3">
                    <input name="yearOfEmployment" class="form-control" type="number" min="1950" placeholder=" "
                           value="{{ $yearOfEmployment ?? null }}" required>
                    <label class="form-label">Год трудоустройства</label>
                </div>

                {{-- Оклад --}}
                <div class="form-floating my-3">
                    <input name="salary" class="form-control" type="number" min="1" placeholder=" "
                           value="{{ $salary ?? null }}" required>
                    <label class="form-label">Оклад (&#8381;)</label>
                </div>

                <div class="mt-5">
                    <input class="btn btn-primary w-10rem me-2" type="submit"
                           value="{{$isAdd ? 'Добавить' : 'Сохранить'}}">
                    <a class="btn btn-secondary w-10rem" href="/workers/allData">Назад</a>
                </div>
            </form>
        </section>
    </div>
@endsection
