<?php

/*
|--------------------------------------------------------------------------
| Team Factory
|--------------------------------------------------------------------------
*/

$factory->define(
    Siravel\Models\Team::class, function (Faker\Generator $faker) {
        return [
        'user_id' => 1,
        'name' => $faker->name
        ];
    }
);
