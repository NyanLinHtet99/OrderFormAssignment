<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nrc' => rand(1, 64) . '/' . fake()->regexify('[A-Za-z]{6}') . '(N)' . sprintf("%06d", mt_rand(1, 999999)),
            'name' => fake()->name(),
            'phone' => fake()->phoneNumber(),
            'secondary_phone' => fake()->phoneNumber(),
            'email' => fake()->unique()->safeEmail(),
            'address' => fake()->address(),
            'latitude' => fake()->latitude(),
            'longitude' => fake()->longitude(),
            'product_id' => rand(1, 3),
        ];
    }
}
