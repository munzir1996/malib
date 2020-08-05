<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Area;
use App\Owner;
use App\Pitch;
use Faker\Generator as Faker;

$factory->define(Pitch::class, function (Faker $faker) {
    return [
        'name' => $faker->name(),
        'phone' => $faker->phoneNumber(),
        'location' => $faker->streetAddress(),
        'discription' => $faker->sentence($nbWords = 30, $variableNbWords = true),
        'price' => $faker->numberBetween($min = 100, $max = 1000),
        'area_id' => function(){
            return factory(Area::class)->create()->id;
        },
        'owner_id' => function(){
            return factory(Owner::class)->create()->id;
        },
    ];
});
