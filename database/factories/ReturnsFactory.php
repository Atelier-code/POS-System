<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Returns>
 */
class ReturnsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'sale_id'=>Sale::factory(),
            'product_id'=>Product::factory(),
            'quantity'=>$this->faker->numberBetween(1,10),
            'price_at_purchase'=>$this->faker->numberBetween(1,10),
        ];
    }
}
