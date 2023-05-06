<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Занятие 12.12.2022 - формы</title>

    <!-- подключение bootstrap -->
    <link href="{{ asset("lib/bootstrap/css/bootstrap.min.css") }}" rel="stylesheet" />
    <script src="{{ asset("lib/bootstrap/js/bootstrap.bundle.min.js") }}"></script>

    <!-- подключение собственных стилей -->
    <link rel="stylesheet" href= "{{ asset("/css/style.css") }}">
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
                        {{-- Переход на страницу отображения формы 1, GET-обработка  --}}
                        <li class="nav-item">
                            <a class="nav-link @yield('active_form1')" href="/form1"
                               title="Переход на страницу отображения формы 1, GET-обработка">
                                GET-обработка
                            </a>
                        </li>

                        {{-- Переход на страницу отображения формы 2, POST-обработка  --}}
                        <li class="nav-item">
                            <a class="nav-link @yield('active_form2')" href="/form2"
                               title="Переход на страницу отображения формы 2, POST-обработка">
                                POST-обработка
                            </a>
                        </li>


                        {{-- переход на страницу вывода сеедений --}}
                        <li class="nav-item">
                            <a class="nav-link @yield('active_about')" href="/home/about"
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
