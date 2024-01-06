<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id' => Order::inRandomOrder()->first(),
            'product_id' => Product::inRandomOrder()->first(),
            'quantity' => $this->faker->randomNumber(1, false),
            'total_price' => $this->faker->randomFloat(2, 10, 1000),
        ];
    }
}
