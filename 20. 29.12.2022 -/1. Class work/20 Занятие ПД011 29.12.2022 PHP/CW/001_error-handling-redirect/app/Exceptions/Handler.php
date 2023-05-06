<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use PHPUnit\Util\InvalidDataSetException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        // запись в журнал
        $this->reportable(function (Throwable $e) {
            // код регистрации собственных обработчиков, выполняющих журналирование сведений об ошибках
        });

        // вывод представлений (в частности), но и можно и JSON
        // регистрация собственного отображения исключения
        $this->renderable(function (InvalidDataSetException $e, $request) {
            // вызываем представление, передаем ему массив данных и статусный код (код для передачи клиенту)
            return response()->view('errors.custom-handler', ['p1'=>$e->getMessage(), 'p2'=>42], 523);
        });
    }
}
