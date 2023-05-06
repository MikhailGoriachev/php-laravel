<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

// Операции с базой данных
class CategoriesController extends Controller
{
    // чтение данных из таблиц categories, products
    public function readData(): View {
        // получить все записи (и все поля) из таблицы
        $categories = DB::table('categories')->get();

        // получить все записи (и только заданные поля) из таблицы
        $categories = DB::table('categories')
            ->select('id', 'category')  // поля для выборки
            ->get();

        // получить все записи (и только заданные поля, переименоваие полей) из таблицы
        $categories1 = DB::table('categories')
            ->select('id as number', 'category as name')  // поля для выборки
            ->get();

        // отладочная печать Laravel
        // dump($categories);

        // отладочная печать Laravel, с прерыванием выполнения скрипта
        // dd: dump and die
        // dd($categories);

        // получить все записи товаров с расшифровкой полей (соединение таблиц)
        $products = DB::table('products')
            ->join('categories', 'products.id_category', '=', 'categories.id')
            ->select('products.id as id', 'name', 'category', 'price', 'amount')
            ->get();

        // получить все записи товаров с расшифровкой полей (соединение таблиц),
        // у которых цена (price) > 500 или количество (amount) = 100
        $products1 = DB::table('products')
            ->join('categories', 'products.id_category', '=', 'categories.id')
            ->where('price', '>', 500)
            ->orWhere('amount', '=', 100)
            ->select('products.id as id', 'name', 'category', 'price', 'amount')
            ->get();

        // получить все записи товаров с расшифровкой полей (соединение таблиц),
        // у которых цена (price) между 500 и 3000
        $products2 = DB::table('products')
            ->join('categories', 'products.id_category', '=', 'categories.id')
            ->whereBetween('price', [500, 3000])
            ->select('products.id as id', 'name', 'category', 'price', 'amount')
            ->get();

        return view('categories.view-all',
            [
                'categories'=>$categories,
                'categories1'=>$categories1,
                'products'=>$products,
                'products1'=>$products1,
                'products2'=>$products2
            ]);
    } // readData

} // class CategoriesController
