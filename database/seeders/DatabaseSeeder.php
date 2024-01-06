<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create 20 unique categories
        for ($i = 0; $i < 20; $i++) {
            \App\Models\Category::factory()->create();
        }

        \App\Models\User::factory(300)->create();
        \App\Models\Product::factory(1000)->create();

        // Create 200 orders
        for ($i = 0; $i < 200; $i++) {
            \App\Models\Order::factory()->create();
        }

        \App\Models\OrderItem::factory(100)->create();
    }
}
