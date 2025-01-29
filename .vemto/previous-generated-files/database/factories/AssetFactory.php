<?php

namespace Database\Factories;

use App\Models\Asset;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class AssetFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Asset::class;

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
            'user_id' => \App\Models\User::factory(),
            'warehouse_id' => \App\Models\Warehouse::factory(),
        ];
    }
}
