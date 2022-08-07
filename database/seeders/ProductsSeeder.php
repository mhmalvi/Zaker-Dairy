<?php

namespace Database\Seeders;

use Database\Factories\ProductFactory;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = ProductFactory::new()->times(20)->create();

        foreach ($products as $product) {
            $product->seo()->create();
        }
    }
}
