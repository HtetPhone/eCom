<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::all()->each(function($product) {
            $product->categories()->attach(Category::inRandomOrder()->take(rand(1, 5))->pluck('id'));
        });
    }
}
