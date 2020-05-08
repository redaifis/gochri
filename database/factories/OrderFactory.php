<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'amount' => $faker->randomNumber(2),
        'country' => $faker->country(),
        'city' => $faker->city(),
        'code_postal' => $faker->postcode(),
        'address' => $faker->address(),
        'status' => $faker->randomElement(['En attente' , 'Livraisé', 'Remboursé', 'Arrivé']),
        'user_id' => 4,
        'shipping_method_id' => $faker->randomElement([3,4]),
    ];
});
