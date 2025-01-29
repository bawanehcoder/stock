<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()
            ->count(1)
            ->create([
                'email' => 'admin@admin.com',
                'password' => \Hash::make('admin'),
            ]);

        // $this->call(WarehouseSeeder::class);
        // $this->call(ItemSeeder::class);
        // $this->call(AssetSeeder::class);
        // $this->call(MaintenanceDepartmentSeeder::class);
        // $this->call(MaintenanceItemSeeder::class);
        // $this->call(OrderSeeder::class);
        // $this->call(SupplierSeeder::class);
        // $this->call(OrderItemSeeder::class);
    }
}
