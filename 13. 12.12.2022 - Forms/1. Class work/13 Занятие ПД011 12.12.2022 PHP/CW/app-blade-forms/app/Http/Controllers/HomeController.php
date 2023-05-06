<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // GET /
    public function index() {
        return view("home.index");
    } // index

    // GET home/about
    public function about() {
        return view("home.about");
    } // about
}
