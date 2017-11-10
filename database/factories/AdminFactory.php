<?php

use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(\App\Models\Admin::class, function (Faker $faker) {
    return [
        'username' => 'admin',
        'password' => Hash::make('admin'),
        'name' => $faker->name,
        'email' => $faker->email,
        'birthday' => $faker->date('Y-m-d', 'now'),
        'avatar' => Storage::url('public/students/avatars/default.png'),
    ];
});
