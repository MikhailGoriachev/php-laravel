<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Manufacture;
use App\Models\Shoes;
use App\Models\ShoesType;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

    public function run() {
        // производители
        collect(['Nike', 'Adidas', 'Puma', 'Rebook', 'Lacoste', 'Imac', 'Affex', 'Furla'])
            ->map(fn($a) => (new Manufacture(['name' => $a]))->save());

        // типы обуви
        collect(['ботинки', 'туфли', 'кроссовки', 'кеды', 'бутсы', 'балетки', 'босоножки', 'чешки'])
            ->map(fn($a) => (new ShoesType(['name' => $a]))->save());

        // обувь
        Shoes::factory()->count(fake()->numberBetween(15,20))->create();
    }
}
