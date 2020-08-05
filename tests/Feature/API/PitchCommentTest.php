<?php

namespace Tests\Feature\API;

use App\Pitch;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PitchCommentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function customer_can_create_comment()
    {
        $customer = $this->customerApiLogin();
        $pitch = factory(Pitch::class)->create();

        $response = $this->post('api/customer/pitch/comments', [
            'comment' => 'comment',
            'customer_id' => $customer->id,
            'pitch_id' => $pitch->id,
        ]);

        $this->assertDatabaseHas('pitch_comments',[
            'comment' => 'comment',
            'customer_id' => $customer->id,
            'pitch_id' => $pitch->id,
        ]);
    }
}
