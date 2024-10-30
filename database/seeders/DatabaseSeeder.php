<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Returns;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Product::factory(60)->create();
        Sale::factory(20)->create();
        SaleItem::factory(100)->create();
        Returns::factory(20)->create();

    }
}
