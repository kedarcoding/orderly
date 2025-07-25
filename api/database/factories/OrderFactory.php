<?php

namespace Database\Factories;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Item;
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
         $price = fake()->randomFloat(2, 100, 1000);
         $qty = fake()->numberBetween(1, 5);
         return [
            'customer_id' => Customer::factory(),
            'item_id' => Item::factory(),
            'quantity' => $qty,
            'price' => $price,
            'total' => $qty * $price,
            'status' => fake()->randomElement(['pending', 'paid', 'cancelled']),
         ];
    }
}
