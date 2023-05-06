<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Nette\InvalidArgumentException;
use PHPUnit\Util\InvalidDataSetException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ErrorGeneratorController extends Controller
{
    // вывод страницы пол GET-запросу
    public function index() {
        return view('error-generator.index');
    } // index

    // стандартная обработка исключений
    public function standardHandling() {
        throw new InvalidArgumentException("Сведения об ошибке");
    } // standardHandling

    // пользовательская обработка исключения - вывод сообщения по конкретному типу исключения
    // задается в классе App\Exceptions\Handler
    public function customHandling() {
       $message = "Текст сообщения об ошибке";
       throw new InvalidDataSetException($message);
    } // customHandling

    // стандартная обрабтка стандартного HTTP-кода ошибки, на примере кода 403
    public function httpStandardHandling() {
        // вызов стандартного HTTP-исключения, код оошибки 403
        // есть стандартная страница для кода 403
        // abort(403);

        // это не стандартный код, вызов не проходит
        // Laravel падает на таком запросе...
        // abort(407);

        // порождается исключение с кодом 521
        // Symfony\Component\HttpKernel\Exception\HttpException;
        throw new HttpException(521, "Сообщение об ошибке");

        // все равно Laravel падает на таком запросе...
        // throw new HttpException(407, "Сообщение об ошибке");
    } // httpStandardHandling

    // пользовательчкая обработка стандартного HTTP-кода ошибки, на примере кода 404
    // по команде
    // php artisan vendor:publish --tag=laravel-errors
    // станадртные обработчики перемещаются в resources/views/errors/
    // далее их можно настраивать по своему усмотрению
    public function httpCustomHandling() {
        abort(404);
    } // httpCustomHandling
}
