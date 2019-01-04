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

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'firstname'      => $faker->name,
		'lastname'       => $faker->name,
		'username'       => $faker->username,
		'email'          => $faker->unique()->safeEmail,
		'area'           => $faker->randomElement(['administracion', 'comercial', 'farmacia']),
		'password'       => bcrypt('secret'),
		'remember_token' => str_random(10),
    ];
});
