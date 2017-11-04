<?php

use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\App\Models\SchoolClass::class, function (Faker $faker) {
    $semesters = ['20151', '20152', '20161', '20162', '20163', '20171'];

    return [
            'teacher_id' => function () {
                return factory(\App\Models\Teacher::class)->create()->id;
            },
            'subject_id' => function () {
                return factory(\App\Models\Subject::class)->create()->id;
            },
            'semester' => $semesters[rand(0, count($semesters) - 1)]
    ];
});
