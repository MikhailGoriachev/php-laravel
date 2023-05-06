@extends('layouts.layout')

@section('title', 'Ввод размера массива')

@section('arrayActive', 'active')

@section('content')

    <div class="min-vh-100">
        <section class="w-50 mx-auto my-4 bg-light shadow-sm border rounded-3 p-3">

            <form action="/array/{{ $n }}" method="post">
                @csrf

                <h4 class="text-center mb-4">Массив. Ввод данных</h4>

                <div class="row">

                    {{-- минимум диапазона --}}
                    <div class="col">
                        <div class="form-floating">
                            <input name="min" class="form-control" type="number" step="any" placeholder=" "
                                   value="{{ $min }}" required>
                            <label class="form-label">Минимум диапазона</label>
                        </div>
                    </div>

                    {{-- максимум диапазона --}}
                    <div class="col">
                        <div class="form-floating">
                            <input name="max" class="form-control" type="number" step="any" placeholder=" "
                                   value="{{ $max }}" required>
                            <label class="form-label">Максимум диапазона</label>
                        </div>
                    </div>

                </div>

                <div class="mt-5">
                    <input class="btn btn-primary w-10rem me-2" type="submit" value="Создать массив">
                    <a class="btn btn-secondary w-10rem" href="/">На главную</a>
                </div>
            </form>
        </section>
    </div>
@endsection
