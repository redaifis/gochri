<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use App\User;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    $users = User::all();
    $usersId = $users->pluck('id');
    return [
        'reference' => (string)$faker->randomNumber(6),
        'amount' => $faker->randomNumber(2),
        'country' => $faker->country(),
        'city' => $faker->city(),
        'code_postal' => $faker->postcode(),
        'address' => $faker->address(),
        'payment_status' => $faker->randomElement([0,1]),
        'payment_method' => $faker->randomElement(["paypal", "credit card"]),
        'user_id' => $faker->randomElement($usersId),
        'shipping_method_id' => $faker->randomElement([3,4]),
        'shipping_status' => $faker->randomElement([0,1]),
    ];
});
