@extends('layouts.layout')

@section('title', ($isAdd ? 'Добавление' : 'Изменение') . ' проката')

@section('tablesActive', 'active')

@section('content')

    <div class="min-vh-100">
        <section class="w-50 mx-auto my-4 bg-light shadow-sm border rounded-3 p-3">


            <form action="{{$isAdd ? '/add/rental' : '/edit/rental'}}" method="post">
                @csrf

                <h4 class="text-center mb-4">{{($isAdd ? 'Добавление' : 'Изменение') . ' прокат'}}</h4>

                {{-- id --}}
                <input type="hidden" name="id" value="{{($id ?? old('id')) ?? 0}}">

                {{-- Клиент --}}
                <div class="form-floating my-3">
                    <select name="client_id" class="form-select @error('client_id') is-invalid @enderror">
                        @foreach($clients as $c)
                            <option
                                value="{{$c['key']}}" {{($c['key'] === (($client_id ?? old('client_id')) ?? '') ? 'selected' : '')}}>{{$c['value']}}</option>
                        @endforeach
                    </select>
                    <label class="form-label">Клиент</label>
                </div>

                @error('client_id')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                {{-- Автомобиль --}}
                <div class="form-floating my-3">
                    <select name="car_id" class="form-select @error('car_id') is-invalid @enderror">
                        @foreach($cars as $c)
                            <option
                                value="{{$c['key']}}" {{($c['key'] === (($car_id ?? old('car_id')) ?? '') ? 'selected' : '')}}>{{$c['value']}}</option>
                        @endforeach
                    </select>
                    <label class="form-label">Автомобиль</label>
                </div>

                @error('car_id')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                {{-- Дата начала поездки --}}
                <div class="form-floating">
                    <input class="form-control @error('date_start') is-invalid @enderror"
                           value="{{$date_start ?? old('date_start')}}" type="date" name="date_start">
                    <label class="form-label">Дата начала поездки</label>
                </div>

                @error('date_start')
                <div class="alert alert-danger">{{$message}}</div> @enderror

                {{-- Длительность --}}
                <div class="form-floating my-3">
                    <input name="duration" class="form-control @error('duration') is-invalid @enderror"
                           type="number" placeholder=" "
                           value="{{ ($duration ?? old('duration')) ?? null }}">
                    <label class="form-label">Длительность</label>
                </div>

                @error('yearOfEmployment')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="mt-5">
                    <input class="btn btn-primary w-10rem me-2" type="submit"
                           value="{{$isAdd ? 'Добавить' : 'Сохранить'}}">
                    <a class="btn btn-secondary w-10rem" href="/tables/rentals">Назад</a>
                </div>
            </form>
        </section>
    </div>
@endsection
