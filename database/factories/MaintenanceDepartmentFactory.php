<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\MaintenanceDepartment;
use Illuminate\Database\Eloquent\Factories\Factory;

class MaintenanceDepartmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MaintenanceDepartment::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'location' => fake()->text(255),
            'type' => fake()->word(),
        ];
    }
}
