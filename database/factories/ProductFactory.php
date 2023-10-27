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
    public function definition()
    {
        return [
                'company_id' => $this->faker->numberBetween($min = 1, $max = 10),
                'product_name' => $this->faker->realText(15),
                'price' => $this->faker->numberBetween($min = 10, $max = 300),
                'stock' => $this->faker->numberBetween($min = 1, $max = 50),
                'comment' => $this->faker->realText(50),
        ];
    }
}
