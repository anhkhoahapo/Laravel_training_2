<?php

use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\App\Models\Subject::class, function (Faker $faker) {
    return [
        'name' => $faker->realText(15),
        'credit' => rand(0, 4)
    ];
});
