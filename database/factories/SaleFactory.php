<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sale>
 */
class SaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'=>User::factory(),
            'total'=>$this->faker->randomFloat(2,40,1000),
            'payment_method'=>'card',
            'vat'=>$this->faker->randomFloat(2,10,100),
            'sub_total'=>$this->faker->randomFloat(2,10,1000),
            'created_at'=>$this->faker->dateTimeBetween('-3 months'),
        ];
    }
}
