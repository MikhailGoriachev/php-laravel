@extends('layouts.layout')

@section('title', 'Ввод текста')

@section('textActive', 'active')

@section('content')

    <div class="min-vh-100">
        <section class="w-50 mx-auto my-4 bg-light shadow-sm border rounded-3 p-3">

            <form action="/text" method="post">
                @csrf

                <h4 class="text-center mb-4">Ввода текста</h4>

                {{-- текст --}}
                <div class="form-floating my-3">
                    <input name="text" class="form-control" type="text" placeholder=" "
                           value="{{ $text }}" required>
                    <label class="form-label">Текст</label>
                </div>

                {{-- длина слова --}}
                <div class="form-floating my-3">
                    <input name="length" class="form-control" type="number" min="1" placeholder=" "
                           value="{{ $length }}" required>
                    <label class="form-label">Длина слова (для обработки)</label>
                </div>

                <div class="mt-5">
                    <input class="btn btn-primary w-10rem me-2" type="submit" value="Обработка">
                    <a class="btn btn-success w-10rem me-2" href="/textForm" title="Генерация нового текста">Сгенерировать</a>
                    <a class="btn btn-secondary w-10rem" href="/">На главную</a>
                </div>
            </form>
        </section>
    </div>
@endsection
