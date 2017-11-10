<?php

use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\App\Models\Student::class, function (Faker $faker) {
    return [
            'mssv' => (string)rand(20140000, 20179999),
            'password' => Hash::make('123'),
            'name' => $faker->name,
            'email' => $faker->email,
            'birthday' => $faker->date('Y-m-d', 'now'),
            'avatar' => Storage::url('public/students/avatars/default.png'),
    ];
});
