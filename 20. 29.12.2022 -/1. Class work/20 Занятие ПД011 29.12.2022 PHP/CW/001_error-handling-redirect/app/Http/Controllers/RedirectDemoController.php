<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RedirectDemoController extends Controller
{
    public function index() {
        return view('redirect-demo.index');
    } // index

    // перенаправление на заданный маршрут (параметры при необходимости задаем в маршруте)
    public function redirect1() {
        $param = 42;
        // перенаправляем на адрес /redirect-demo/handler/{param}
        return redirect("/redirect-demo/handler/$param");
    } // redirect1

    // перенаправление на метод действия с указаниекм парамтера/параметров
    public function redirect2() {
        $param = 24;
        // перенаправляем на метод действия handler,
        // параметры запроса - массив (второй параметр метода action())
        return redirect()->action([RedirectDemoController::class, 'handler'],  ['param' => $param]);
    } // redirect2


    // сюда выполняем редирект
    public function handler($param) {
        return view('redirect-demo.handler', ['param'=>$param]);
    }
}
