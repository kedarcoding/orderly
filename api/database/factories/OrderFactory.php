<?php

namespace Database\Factories;
use App\Models\Order;
use App\Models\Customer;
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
             'customer_id' => Customer::inRandomOrder()->first()->id ?? Customer::factory(),
             'item_name'   => $this->faker->word,
             'price'       => $this->faker->randomFloat(2, 100, 1000),
             'status'      => $this->faker->randomElement(['pending', 'paid', 'cancelled']),
        ];
    }
}
