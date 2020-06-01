<?php

/*
|--------------------------------------------------------------------------
| Room Factory
|--------------------------------------------------------------------------
*/

$factory->define(\App\Models\Travels\Hotel::class, function (Faker\Generator $faker) {
    return [
        'code' => 'dumb',
    ];
});

$factory->define(\App\Models\Travels\Room::class, function (Faker\Generator $faker) {
    return [
        'hotel_id' => function () {
            if ($return = \App\Models\Travels\Hotel::inRandomOrder()->first()) {
                return $return->id;
            }
            return factory(\App\Models\Travels\Hotel::class)->create()->id;
        },
        'code' => 'dumb',
    ];
});

$factory->define(\App\Models\Travels\Travel::class, function (Faker\Generator $faker) {
    return [
        'room_id' => function () {
            if ($return = \App\Models\Travels\Room::inRandomOrder()->first()) {
                return $return->id;
            }
            return factory(\App\Models\Travels\Room::class)->create()->id;
        },
        'code' => 'dumb',
    ];
});