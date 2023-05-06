@extends('layouts.layout')

@section('title', ($isAdd ? 'Добавление' : 'Изменение') . ' работника')

@section('workersActive', 'active')

@section('content')

    <div class="min-vh-100">
        <section class="w-50 mx-auto my-4 bg-light shadow-sm border rounded-3 p-3">


            <form action="{{$isAdd ? '/workers/add' : '/workers/edit'}}" method="post" enctype="multipart/form-data">
                @csrf

                <h4 class="text-center mb-4">{{($isAdd ? 'Добавление' : 'Изменение') . ' работника'}}</h4>

                {{-- id --}}
                <input type="hidden" name="id" value="{{($id ?? old('id')) ?? 0}}">

                {{-- Фотография --}}
                <input type="hidden" name="image" value="{{($image ?? old('image')) ?? ''}}">

                {{-- Фамилия и инициалы --}}
                <div class="form-floating my-3">
                    <input name="fullName" class="form-control @error('fullName') is-invalid @enderror" type="text"
                           placeholder=" "
                           value="{{ ($fullName ?? old('fullName')) ?? null }}">
                    <label class="form-label">Фамилия и инициалы</label>
                </div>

                @error('fullName')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror


                {{-- Должность --}}
                <div class="form-floating my-3">
                    <select name="position" class="form-select @error('position') is-invalid @enderror">
                        @foreach($positionList as $pos)
                            <option
                                value="{{$pos}}" {{($pos === (($position ?? old('position')) ?? '') ? 'selected' : '')}}>{{$pos}}</option>
                        @endforeach
                    </select>
                    <label class="form-label">Должность</label>
                </div>

                @error('position')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror


                {{-- Пол --}}
                <div class="form-floating my-3">
                    <select name="gender" class="form-select @error('$gender') is-invalid @enderror">
                        <option value="1" {{(($gender ?? old('gender') ) ?? true) ? 'selected' : ''}}>Мужской</option>
                        <option value="0" {{!(($gender ?? old('gender') ) ?? false) ? 'selected' : ''}}>Женский</option>
                    </select>
                    <label class="form-label">Пол</label>
                </div>

                @error('gender')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror


                {{-- Год трудоустройства --}}
                <div class="form-floating my-3">
                    <input name="yearOfEmployment" class="form-control @error('yearOfEmployment') is-invalid @enderror"
                           type="number" placeholder=" "
                           value="{{ ($yearOfEmployment ?? old('yearOfEmployment')) ?? null }}">
                    <label class="form-label">Год трудоустройства</label>
                </div>

                @error('yearOfEmployment')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror


                {{-- Оклад --}}
                <div class="form-floating my-3">
                    <input name="salary" class="form-control @error('salary') is-invalid @enderror" type="number"
                           placeholder=" "
                           value="{{ ($salary ?? old('salary')) ?? null }}">
                    <label class="form-label">Оклад (&#8381;)</label>
                </div>

                @error('salary')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror


                {{-- Файл фотографии --}}
                <div class="form-floating my-3">
                    <input name="photo" type="file" class="form-control p-5 @error('photo') is-invalid @enderror"
                           placeholder=" "
                           value="{{old('photo')}}">
                    <label class="form-label">Файл изображения</label>
                </div>

                @error('photo')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror


                <div class="mt-5">
                    <input class="btn btn-primary w-10rem me-2" type="submit"
                           value="{{$isAdd ? 'Добавить' : 'Сохранить'}}">
                    <a class="btn btn-secondary w-10rem" href="/workers/allData">Назад</a>
                </div>
            </form>
        </section>
    </div>
@endsection
