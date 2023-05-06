<?php

namespace Database\Factories;

use App\Models\Manufacture;
use App\Models\ShoesType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shoes>
 */
class ShoesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'code' => fake()->numberBetween(1e8, 1e9),
            'manufacture_id' => Manufacture::all()->random(),
            'shoes_type_id' => ShoesType::all()->random(),
            'price' => fake()->numberBetween(20, 70) * 100,
        ];
    }
}
