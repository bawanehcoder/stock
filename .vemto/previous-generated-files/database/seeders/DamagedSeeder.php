<?php

namespace Database\Seeders;

use App\Models\Damaged;
use Illuminate\Database\Seeder;

class DamagedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Damaged::factory()
            ->count(5)
            ->create();
    }
}
