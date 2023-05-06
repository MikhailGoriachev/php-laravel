<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

// операци с таблицей products
class ProductsController extends Controller
{
    // чтение всех записей
    public function index(): View {
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

        // передать выборки в представдение для products
        return view('products.view-all', [
            'products'=>$products,
            'products1'=>$products1,
            'products2'=>$products2
        ]);
    } // index

    // добавление записи
    public function insert(): View {
        $number = random_int(1, 12);
        $id = DB::table('products')->insertGetId([
            'name' => "товар номер $number",
            'id_category'  => random_int(1, 5),
            'price'  => random_int(1, 10) * 100,
            'amount'  => random_int(1, 20),
        ]);
        return view('products.view-insert', ['id' => $id]);
    } // insert

    // модификация записи по id
    public function update($id): View {
        $number = random_int(1, 12);
        $num = DB::table('products')->where('id', $id)->update([
            'name' => "товар номер $number",
            'id_category'  => random_int(1, 5),
            'price'  => random_int(1, 10) * 100,
            'amount'  => random_int(1, 20),
        ]);
        return view('products.view-update', ['id' => $id, 'num'=>$num]);
    } // update

    // удаление записи по id
    public function delete($id): View {
        $num = DB::table('products')->where('id', $id)->delete();

        return view('products.view-delete', ['id' => $id, 'num'=>$num]);
    } // update
} // class ProductsController
