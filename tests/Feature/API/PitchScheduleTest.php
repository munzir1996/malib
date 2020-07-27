<?php

namespace Tests\Feature\API;

use App\Pitch;
use App\PitchSchedule;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PitchScheduleTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    private $startDate;
    private $endDate;

    protected function startDate(){

        // Random datetime of the current week
        $this->startDate = $this->faker->dateTimeBetween('this week', '+6 days');

    }

    protected function endDate(){

        // Random datetime of the current week *after* `$startingDate`
        $this->endDate = $this->faker->dateTimeBetween($this->startDate, strtotime('+6 days'));

    }

    /** @test */
    public function can_create_pitchschedule()
    {
        $pitch = factory(Pitch::class)->create();

        $this->withoutExceptionHandling();
        $this->login();

        $this->startDate();
        $this->endDate();

        $this->post('api/owner/pitchschedules', [
            'day' => 5,
            'start' => $this->startDate,
            'end' => $this->endDate,
            'pitch_id' => $pitch->id,
        ]);

        $this->assertDatabaseHas('pitch_schedules', [
            'day' => 5,
            'start' => $this->startDate,
            'end' => $this->endDate,
            'pitch_id' => $pitch->id,
        ]);
    }

    /** @test */
    public function can_update_pitchschedule()
    {
        $pitchSchedules = factory(PitchSchedule::class)->create();

        $this->login();
        $this->startDate();
        $this->endDate();

        $this->put('api/owner/pitchschedules/'. $pitchSchedules->id, [
            'day' => 1,
            'start' => $this->startDate,
            'end' => $this->endDate,
            'pitch_id' => $pitchSchedules->pitch->id,
        ]);

        $this->assertDatabaseHas('pitch_schedules', [
            'day' => 1,
            'start' => $this->startDate,
            'end' => $this->endDate,
            'pitch_id' => $pitchSchedules->pitch->id,
        ]);
    }


}
