<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Customer;
use App\Pitch;
use App\PitchComment;
use Faker\Generator as Faker;

$factory->define(PitchComment::class, function (Faker $faker) {
    return [
        'comment' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'pitch_id' => function(){
            return factory(Pitch::class)->create()->id;
        },
        'customer_id' => function(){
            return factory(Customer::class)->create()->id;
        },
    ];
});
