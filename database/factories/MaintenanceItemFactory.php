<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\MaintenanceItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class MaintenanceItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MaintenanceItem::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'status' => fake()->word(),
            'note' => fake()->word(),
            'item_id' => \App\Models\Item::factory(),
            'maintenance_department_id' => \App\Models\MaintenanceDepartment::factory(),
            'asset_id' => \App\Models\Asset::factory(),
        ];
    }
}
