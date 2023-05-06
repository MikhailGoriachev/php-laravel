<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // действие контроллера index
    public function index() {
        // обращение к странице отображения действия index в каталоге home
        return view('home/index');
    } // index

    // действие контроллера about
    public function about() {
        // обращение к странице отображения действия about в каталоге home
        return view('home/about');
    } // about

    // действие, возвращающее HTML
    public function directHtml() {
        return "<h1>Home/DirectHtml</h1><p><a href='/'>На главную</a></p>";
    }

    // действие, передающее в представление несколько значений
    public function someValues() {
        // скаляр
        $a = rand(100, 1000);

        // массив
        $fruits = ["яблоки", "груши", "вишни", "апельсин", "мандарин"];

        // передача данных представлению
        // "home.some_values ==== "home/some_values
        return view("home.some_values", ['p1'=>$a, 'p2'=>$fruits]);
    } // someValues

    // действие, получающее один параметр из маршрута
    public function getParam($id) {
        return view("home.get_param", ['id'=>$id]);
    } // getParam
} // class HomeController
