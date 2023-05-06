<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

// Заполнение БД данными
// а) Настроить класс DatabaseSeeder
// б) php artisan db:seed
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // артикулы для связи 1:1 с таблцей categories
        DB::table('articles')->insert([
            ['name'=>'АТ-100010В'],
            ['name'=>'АТ-321234В'],
            ['name'=>'АТ-321230В'],
            ['name'=>'АП-100120В'],
            ['name'=>'АТ-109870М'],
        ]);

        DB::table('categories')->insert([
            ['name'=>'продукты питания',     'article_id' => 1],
            ['name'=>'промышленные товары',  'article_id' => 2],
            ['name'=>'сопутствующие товары', 'article_id' => 3],
            ['name'=>'бытовая техника',      'article_id' => 4],
            ['name'=>'медицинская техника',  'article_id' => 5],
        ]);

        DB::table('products')->insert([
            ['category_id'=>1, 'name'=>'йогурт', 'amount'=>120, 'price'=>50],
            ['category_id'=>2, 'name'=>'щетка', 'amount'=>12, 'price'=>200],
            ['category_id'=>3, 'name'=>'пакет упаковочный', 'amount'=>100, 'price'=>2],
            ['category_id'=>4, 'name'=>'насос погружной', 'amount'=>5, 'price'=>3100],
            ['category_id'=>5, 'name'=>'тонометр', 'amount'=>1, 'price'=>1200],
            ['category_id'=>3, 'name'=>'шнур упаковочный', 'amount'=>1000, 'price'=>1],
            ['category_id'=>4, 'name'=>'арматрура запорная', 'amount'=>12, 'price'=>250],
        ]);
    }
}
