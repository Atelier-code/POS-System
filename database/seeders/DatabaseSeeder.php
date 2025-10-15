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
//        /*
//        User::factory(10)->create();
//        */
        User::factory()->create([
            'name' => 'Kephas Tetteh',
            'email' => 'tettehkephas@gmail.com',
            'role' => 'admin',
        ]);
////
//        Product::factory(60)->create();
       Sale::factory(10)->create();
        SaleItem::factory(50)->create();
//        Returns::factory(20)->create();

    }
}
