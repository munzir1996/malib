<?php

namespace Tests\Feature\API;

use App\Area;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AreaTest extends TestCase
{
    use RefreshDatabase;

    /**  */
    public function can_create_area()
    {
        $this->login();

        $this->post('api/owner/areas', [
            'name' => 'name',
        ]);

        $this->assertDatabaseHas('areas', [
            'name' => 'name',
        ]);
    }

    /**  */
    public function can_update_area()
    {
        $area = factory(Area::class)->create();

        $this->login();

        $this->put('api/owner/areas/'. $area->id, [
            'name' => 'name',
        ]);

        $this->assertDatabaseHas('areas', [
            'name' => 'name',
        ]);
    }
}
