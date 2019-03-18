<?php

use Faker\Generator as Faker;

$factory->define(App\Report::class, function (Faker $faker) {
    return [
        'title' => $faker->streetName,
        'description' => $faker->text,
        'lat' => '52.2' . $faker->numberBetween(40000, 999999),
        'lng' => '7'    . $faker->numberBetween(6.910912, 7.03000),
    ];
});


$factory->state(App\Report::class, 'test', function(Faker $faker) {
    return [
        'title' => 'Test report',
        'description' => 'Test report description',
        'lat' => '52.261111',
        'lng' => '76.951111',
        'videos' => [
            'https://www.youtube.com/watch?v=jsYwFizhncE',
            'https://www.youtube.com/watch?v=PFDu9oVAE-g',
            'https://www.youtube.com/watch?v=aircAruvnKk',
            'https://www.youtube.com/watch?v=3d6DsjIBzJ4',
        ],
        'images' => [
            '/public/assets/images/auth-img.png',
            '/public/assets/images/auth-img-2.png',
            '/public/assets/images/auth-img-3.png',
            '/public/assets/images/catword.png',
            '/public/assets/images/404.png',
        ],
    ];
});