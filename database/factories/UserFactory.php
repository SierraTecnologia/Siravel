<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name'           => $faker->name,
        'email'          => $faker->unique()->safeEmail,
        'password'       => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'role_id' => (new Role)->newQuery()->inRandomOrder()->firstOrFail()->id,
        'login' => $faker->userName,
    ];
});

/*
|--------------------------------------------------------------------------
| UserMeta Factory
|--------------------------------------------------------------------------
*/

$factory->define(App\Models\UserMeta::class, function (Faker\Generator $faker) {
    return [
        'user_id' => 1,
        'phone' => $faker->phoneNumber,
        'marketing' => 1,
        'terms_and_cond' => 1,
    ];
});