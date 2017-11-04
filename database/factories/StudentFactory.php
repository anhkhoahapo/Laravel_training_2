<?php

use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\App\Models\Student::class, function (Faker $faker) {
    return [
            'name' => $faker->name,
            'email' => $faker->email,
            'birthday' => $faker->date('Y-m-d', 'now'),
            'address' => $faker->address,
            'phone' => $faker->e164PhoneNumber
    ];
});
