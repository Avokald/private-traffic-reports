<?php

use Faker\Generator as Faker;

$factory->define(App\Tag::class, function (Faker $faker) {
    return [
        'title' => $faker->streetName,
        'description' => $faker->text,
        'color' => $faker->hexColor,
    ];
});
