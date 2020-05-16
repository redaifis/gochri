<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Product::class, function (Faker $faker) {
    return [
        
        'name' => $faker->sentence(),
        'description' => $faker->paragraph(),
        'price' => $faker->randomFloat(2,10,200),
        'stock' => $faker->numberBetween(20,500),
        'status' => $faker->boolean(70),
        'vendor' => $faker->randomElement(['Atacadao','Marjan','Carrefour', 'Aswak Assalam']),
        'discount' => $faker->randomElement([null,10,5,15]),
        'slug' => Str::slug($faker->sentence()),
        'image' => $faker->file('C:\Users\Reda\Desktop\pains et bagettes', 'public/storage/images/products', false),
        'user_id' => $faker->randomElement([3,4]),
        'category_id' => 19,
        'subcategory_id' => 7,

    ];
});
