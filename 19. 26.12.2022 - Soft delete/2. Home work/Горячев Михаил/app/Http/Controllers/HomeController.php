<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    // главная страница
    public function index(): View {
        return view('home/index', ['activeTab' => 'index']);
    }

    // подробности о разработчике
    public function about(): View {
        return view('home/about', ['activeTab' => 'about']);
    }
}
