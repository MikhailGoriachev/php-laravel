<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

// CRUD-операци с таблицей products, связь с таблицей categories 1:M
class ProductsController extends Controller
{
    // чтение всех записей
    public function index(): View {

        // получить все записи товаров с расшифровкой полей ("ленивая" загрузка)
        $products = Product::all();

        // "жадная" загрузка -- with([таблица1, таблица2, ...])
        // получить все записи товаров, в представлении выведем вычисляемео поле
        $products1 = Product::with(['category'])
            ->get();

        // "жадная" загрузка -- with([таблица1, таблица2, ...])
        // получить все записи товаров
        // у которых цена (price) > 500 или количество (amount) = 100
        $products2 = Product::with(['category'])
            ->where('price', '>', 500)
            ->orWhere('amount', '=', 100)
            ->get();

        // получить все записи товаров с расшифровкой полей (соединение таблиц),
        // у которых цена (price) между 500 и 3000
        $products3 = Product::with(['category'])
            ->whereBetween('price', [500, 3000])
            ->get();

        // передать выборки в представдение для products
        return view('products.view-all', [
            'products'=>$products,
            'products1'=>$products1,
            'products2'=>$products2,
            'products3'=>$products3
        ]);
    } // index

    // добавление записи
    public function insert(): View {
        $number = random_int(1, 12);

        // создать запись, задать значения
        $product = new Product();
        $product->name = "товар номер $number";
        $product->category_id = random_int(1, 5);
        $product->price  = random_int(1, 10) * 100;
        $product->amount  = random_int(1, 20);

        // собственно запись в базу данных
        $product->save();

        return view('products.view-insert', ['id' => $product->id]);
    } // insert

    // модификация записи по id
    public function update($id): View {
        // получить запись для редактирования
        $product = Product::find($id);
        if ($product == null) {
            return view('layouts.not-found', ['message' => "Запись с id = $id не найдена. Изменение записи не выполнено."]);
        } // if

        // просто имитация данных для изменения
        $number = random_int(1, 12);

        $product->name = "товар номер $number";
        $product->price  *= 1.15;
        $product->amount  = random_int(1, 20);

        // собственно запись
        $product->save();

        return view('products.view-update', ['id' => $id]);
    } // update

    // удаление записи по id
    public function delete($id): View {
        // получить запись для удаления по идентификатору $id из маршрута
        $product = Product::find($id);
        if ($product == null) {
            return view('layouts.not-found', ['message' => "Запись с id = $id не найдена. Удаление не выполнено."]);
        } // if

        // один из вариантов удалаения записи
        $product->delete();

        // еще один вариант удаления
        // Product::destroy($id);

        // удаление выбранной группы записей
        // Product::where('id', '<', 5)->delete();

        return view('products.view-delete', ['id' => $id]);
    } // delete
} // class ProductsController
