<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $product_name = $this->faker->name;
        return [
            'name' => $product_name,
            'slug' => Str::slug($product_name),
            'price' => $this->faker->numberBetween(10, 100),
            'publish' => 1,
        ];
    }
}
