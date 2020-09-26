<?php

/*
 * --------------------------------------------------------------------------
 * Feature Factory
 * --------------------------------------------------------------------------
*/

$factory->define(
    Siravel\Models\Feature::class, function (Faker\Generator $faker) {
        return [
        'code' => 'user-signup',
        'is_active' => false,
        ];
    }
);
