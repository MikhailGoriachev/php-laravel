<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// контроллер по заданию - вывод задания, сведений о приложении и разработчике
class HomeController extends Controller
{
    // GET /
    // GET /home
    // GET /home/index
    public function index() {
        return view("home.index");
    } // index

    // GET home/about
    public function about() {
        return view("home.about");
    } // about
} // class HomeController
