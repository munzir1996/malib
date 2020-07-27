<?php

namespace Tests\Feature\API;

use App\Area;
use App\Owner;
use App\Pitch;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PitchTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_create_pitch()
    {
        $owner = factory(Owner::class)->create();
        $area = factory(Area::class)->create();
        $this->login();

        $this->post('api/owner/pitchs', [
            'name' => 'name',
            'phone' => '0114949901',
            'price' => 200,
            'area_id' => $area->id,
            'owner_id' => $owner->id,
        ]);

        $this->assertDatabaseHas('pitches', [
            'name' => 'name',
            'phone' => '0114949901',
            'price' => 200,
            'area_id' => $area->id,
            'owner_id' => $owner->id,
        ]);
    }

    /** @test */
    public function can_update_pitch()
    {
        $pitch = factory(Pitch::class)->create();

        $this->login();

        $this->put('api/owner/pitchs/'. $pitch->id, [
            'name' => 'name',
            'phone' => '0114949901',
            'price' => 200,
            'area_id' => $pitch->area->id,
            'owner_id' => $pitch->owner->id,
        ]);

        $this->assertDatabaseHas('pitches', [
            'name' => 'name',
            'phone' => '0114949901',
            'price' => 200,
            'area_id' => $pitch->area->id,
            'owner_id' => $pitch->owner->id,
        ]);
    }


}



