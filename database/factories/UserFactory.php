<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

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

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$P.QuxbZeNyjrXSTIYXZxrOTJGsXm.NIhP05G1XPZ/b5h42poWUBuC', // 12345678
        'remember_token' => Str::random(10),
        'approved' => random_int(0, 1),
        'administrator' => random_int(0, 1),
        'cpf' => Str::random(11),
        'rg' => Str::random(9),
        'ra' => Str::random(20),
        'course_id' => random_int(1, 10),
    ];
});
