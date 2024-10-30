<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'cost_price' => $this->faker->randomFloat(2, 10),
            'selling_price' => $this->faker->randomFloat(20, 40),
            'quantity' => $this->faker->randomDigit(),
            'tax_rate' => $this->faker->randomDigit(),
        ];
    }
}
