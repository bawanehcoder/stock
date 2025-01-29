<?php

namespace Database\Factories;

use App\Models\Item;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Item::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'status' => fake()->word(),
            'barcode' => fake()->text(255),
            'barcode_image' => fake()->text(255),
            'user_id' => \App\Models\User::factory(),
            'warehouse_id' => \App\Models\Warehouse::factory(),
        ];
    }
}
