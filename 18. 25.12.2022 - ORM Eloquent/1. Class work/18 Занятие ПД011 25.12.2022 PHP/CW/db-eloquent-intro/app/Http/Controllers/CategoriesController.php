<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;

// Операции с базой данных - ORM Eloquent
class CategoriesController extends Controller
{
    // чтение данных из таблицы categories
    public function readData(): View {

        // получить все записи (и все поля) из таблицы categories
        $categories = Category::all();

        // получить выборку из записей - все методы QueryBuilder доступы
        $categories1 = Category::where('id', '>', '3')->get();

        // пролучить первую запись выборки
        $categories2 = Category::where('id', '>', '3')->first();

        // пролучить запись по идентификатору
        $categories3 = Category::find(random_int(1, 5));

        // пролучить группу записей по идентификаторам
        // $categories4 = Category::find(1, 3, 5);
        $categories4 = Category::find([2, 5, 3, 1]);

         return view('categories.view-all',
            [
                'categories'=>$categories,
                'categories1'=>$categories1,
                'categories2'=>$categories2,
                'categories3'=>$categories3,
                'categories4'=>$categories4,
            ]);
    } // readData

} // class CategoriesController
