<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Pitch;
use App\PitchSchedule;
use Faker\Generator as Faker;


$factory->define(PitchSchedule::class, function (Faker $faker) {
    $startingDate = $faker->dateTimeThisYear('+1 month');
    $endingDate   = strtotime('+1 Week', $startingDate->getTimestamp());
    return [
        'day' => $faker->numberBetween($min = 1, $max = 30),
        'start' => $startingDate,
        'end' => $endingDate,
        'pitch_id' => function(){
            return factory(Pitch::class)->create()->id;
        },
    ];
});
