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

        DB::table('categories')->insert([
            ['category'=>'продукты питания'],
            ['category'=>'промышленные товары'],
            ['category'=>'сопутствующие товары'],
            ['category'=>'бытовая техника'],
            ['category'=>'медицинская техника'],
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
