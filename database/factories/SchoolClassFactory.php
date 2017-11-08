<?php

use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\App\Models\SchoolClass::class, function (Faker $faker) {
    $semesters = ['20151', '20152', '20161', '20162', '20163', '20171'];

    $teachers = DB::table('teachers')->get()->pluck('id')->all();

    $subjects = DB::table('subjects')->get()->pluck('id')->all();

    return [
            'teacher_id' => $teachers[rand(0, count($teachers) - 1)],
            'subject_id' => $teachers[rand(0, count($subjects) - 1)],
            'semester' => $semesters[rand(0, count($semesters) - 1)],
    ];
});
