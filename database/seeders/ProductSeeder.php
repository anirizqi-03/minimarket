<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
     
        Product::factory()->count(50)->create();


        Product::factory()
            ->count(5)
            ->outOfStock()
            ->create();


        Product::factory()
            ->count(8)
            ->lowStock()
            ->create();


        Product::factory()
            ->count(3)
            ->inactive()
            ->create();


        Product::factory()
            ->count(10)
            ->kategori('Makanan')
            ->create();

        $this->command->info('✅ Product seeder selesai: ' . Product::count() . ' produk dibuat.');
    }
}
