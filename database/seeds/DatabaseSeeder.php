<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);

        factory(\App\Area::class, 2)->create();
        factory(\App\Booking::class, 2)->create();
        factory(\App\Customer::class, 1)->create();
        factory(\App\Owner::class, 1)->create();
        factory(\App\Pitch::class, 2)->create();
        factory(\App\PitchSchedule::class, 2)->create();
        factory(\App\PitchComment::class, 2)->create();
    }
}
