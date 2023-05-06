@extends('layouts.layout')

@section('title', 'Выражения. Ввод данных')

@section('evaluateActive', 'active')

@section('content')

    <div class="min-vh-100">
        <section class="w-50 mx-auto my-4 bg-light shadow-sm border rounded-3 p-3">


            <form action="/evaluate" method="post">
                @csrf

                <h4 class="text-center mb-4">Выражения. Ввод данных</h4>

                {{-- выражение 1--}}
                <h5 class="text-center">Выражение 1</h5>

                <div class="row mb-4">

                    {{-- число альфа --}}
                    <div class="col">
                        <div class="form-floating">
                            <input name="a" class="form-control" type="number" step="any" placeholder=" "
                                   value="{{ $a }}" required>
                            <label class="form-label">Число &alpha;</label>
                        </div>
                    </div>

                    {{-- число бета --}}
                    <div class="col">
                        <div class="form-floating">
                            <input name="b" class="form-control" type="number" step="any" placeholder=" "
                                   value="{{ $b }}" required>
                            <label class="form-label">Число &beta;</label>
                        </div>
                    </div>

                </div>

                {{-- выражение 2--}}
                <h5 class="text-center">Выражение 2</h5>

                <div class="row mb-4">

                    {{-- число m --}}
                    <div class="col">
                        <div class="form-floating">
                            <input name="m" class="form-control" type="number" step="any" placeholder=" "
                                   value="{{ $m }}" required>
                            <label class="form-label">Число m</label>
                        </div>
                    </div>

                    {{-- число n --}}
                    <div class="col">
                        <div class="form-floating">
                            <input name="n" class="form-control" type="number" step="any" placeholder=" "
                                   value="{{ $n }}" required>
                            <label class="form-label">Число n</label>
                        </div>
                    </div>

                </div>

                <div class="mt-5">
                    <input class="btn btn-primary w-10rem me-2" type="submit" value="Вычислить">
                    <a class="btn btn-secondary w-10rem" href="/">На главную</a>
                </div>
            </form>
        </section>
    </div>
@endsection
