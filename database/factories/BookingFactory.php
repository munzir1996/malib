<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Booking;
use App\Customer;
use App\Pitch;
use App\PitchSchedule;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Config;

$factory->define(Booking::class, function (Faker $faker) {
    $startingDate = $faker->dateTimeThisYear('+1 month');
    return [
        'book_date' => $startingDate,
        'status' => Config::get('constants.booking.status_booked'),
        'pitch_id' => function(){
            return factory(Pitch::class)->create()->id;
        },
        'customer_id' => function(){
            return factory(Customer::class)->create()->id;
        },
        'pitch_schedule_id' => function(){
            return factory(PitchSchedule::class)->create()->id;
        },
    ];
});
