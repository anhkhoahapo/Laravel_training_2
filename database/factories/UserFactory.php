<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Models\User::class, function (Faker $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'role' => 3,
        'remember_token' => str_random(10)
    ];
});


$factory->state(App\Models\User::class, 'admin', function ($faker) {
    return [
        'email'         => 'admin@test.com',
        'password'      => Hash::make('admin'),
        'name'          => $faker->name('male'),
        'role'          => 1
    ];
});

$factory->state(App\Models\User::class, 'teacher', function ($faker) {
    return [
        'email'         => 'teacher@test.com',
        'password'      => Hash::make('teacher'),
        'name'          => $faker->name('male'),
        'role'          => 2
    ];
});