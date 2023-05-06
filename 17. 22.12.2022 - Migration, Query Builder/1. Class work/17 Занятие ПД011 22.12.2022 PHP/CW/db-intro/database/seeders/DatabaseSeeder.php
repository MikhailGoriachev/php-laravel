<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            ['id_category'=>1, 'name'=>'йогурт', 'amount'=>120, 'price'=>50],
            ['id_category'=>2, 'name'=>'щетка', 'amount'=>12, 'price'=>200],
            ['id_category'=>3, 'name'=>'пакет упаковочный', 'amount'=>100, 'price'=>2],
            ['id_category'=>4, 'name'=>'насос погружной', 'amount'=>5, 'price'=>3100],
            ['id_category'=>5, 'name'=>'тонометр', 'amount'=>1, 'price'=>1200],
        ]);
    }
}
