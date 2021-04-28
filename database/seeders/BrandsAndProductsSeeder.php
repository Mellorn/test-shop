<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;
use App\Models\Product;

class BrandsAndProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Brand::factory()
            ->count(20)
            ->has(Product::factory()->count(20))
            ->create();
    }
}
