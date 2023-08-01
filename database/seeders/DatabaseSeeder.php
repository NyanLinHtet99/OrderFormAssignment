<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // DB::table('products')->insert([
        //     'name' => 'Product A',
        //     'price' => 15000,
        // ]);
        // DB::table('products')->insert([
        //     'name' => 'Product B',
        //     'price' => 20000,
        // ]);
        // DB::table('products')->insert([
        //     'name' => 'Product C',
        //     'price' => 30000,
        // ]);
        Product::create(['name' => 'Product A', 'price' => 15000]);
        Product::create(['name' => 'Product B', 'price' => 20000]);
        Product::create(['name' => 'Product C', 'price' => 30000]);
        Order::factory(10)->create();
    }
}
