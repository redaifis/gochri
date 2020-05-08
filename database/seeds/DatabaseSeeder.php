<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ProductSeeder::class);
        $this->call(OrderSeeder::class);

        // Get all the roles attaching up to 3 random roles to each user
        $products = App\Product::all();

        // Populate the pivot table
        App\Order::all()->each(function ($order) use ($products) { 
            $order->products()->attach(
                $products->random(rand(1, 5))->pluck('id')->toArray(), ['quantity' => rand(1,4)]
            ); 
        });
    }
}
