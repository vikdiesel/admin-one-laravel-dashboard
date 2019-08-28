<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Client;
use Faker\Generator as Faker;

$factory->define(Client::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'city' => $faker->city,
        'company' => $faker->company,
        'progress' => $faker->numberBetween(25, 95),
        'created_at' => now()->subDays(rand(1, 180))
    ];
});
