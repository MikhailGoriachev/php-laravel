<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Занятие 15.12.2022</title>

    <!-- подключение bootstrap -->
    <link href="{{ asset("/lib/bootstrap/css/bootstrap.min.css") }}" rel="stylesheet" />
    <script src="{{asset("/lib/bootstrap/js/bootstrap.bundle.min.js")}}"></script>

    <!-- подключение собственных стилей -->
    <link rel="stylesheet" href="{{ asset("/css/style.css") }}">
</head>
<body>
    {{-- панель навигации --}}
    @section('navigation')
        <!-- навигация по приложению, переходы по заданию -->
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <div class="container-fluid">
                <a class="navbar-brand active" href="/">ПД011</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#appNavbar-1">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="appNavbar-1">
                    <ul class="navbar-nav">
                        {{-- Переход на страницу записи в локальный файл --}}
                        <li class="nav-item">
                            <a class="nav-link @yield('active_write')" href="/write"
                               title="Переход на страницу записи в файл">Запись в файл</a>
                        </li>

                        {{-- Переход на страницу чтения из локального файла --}}
                        <li class="nav-item">
                            <a class="nav-link @yield('active_read')" href="/read"
                               title="Переход на страницу чтения из файла">Чтение из файла</a>
                        </li>

                        <!-- Переход на страницу работы с моделью -->
                        <li class="nav-item">
                            <a class="nav-link @yield('active_person')" href="/person"
                               title="Переход на страницу работы с моделью">Модель</a>
                        </li>

                        {{-- переход на страницу вывода сеедений --}}
                        <li class="nav-item">
                            <a class="nav-link @yield('active_about')" href="/about"
                               title="Переход на страницу вывода сведений">О разработчике</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    @show

    {{-- контент представлений --}}
    <main class="container m-5">
        @yield('main_part')
    </main>

    {{-- подвал страницы --}}
    @section('footer')
        <footer class="mt-5 p-1 bg-dark text-white-50 text-center">
            <h5>КА Шаг, ПД011, Донецк, 2022</h5>
        </footer>
    @show
</body>
</html>
