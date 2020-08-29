<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Reservation\Space;
use Faker\Generator as Faker;

$factory->define(Space::class, function (Faker $faker) {
    return [
        'name' => "Space ". $faker->word,
        'description' => $faker->paragraph(2, true)
    ];
});
