<?php

/** @var Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use App\Models\Course;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Course::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'semesters' => random_int(3, 10),
    ];
});
