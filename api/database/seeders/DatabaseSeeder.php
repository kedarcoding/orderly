<?php

namespace Database\Seeders;

use App\Models\{Customer,Order,User};
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'admin@example.com',
            'password'=> 'admin123'
        ]);

        Customer::factory(10)->create()->each(function ($customer) {
        Order::factory(3)->create([
            'customer_id' => $customer->id
        ]);
    });
    }
}
