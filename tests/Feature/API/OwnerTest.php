<?php

namespace Tests\Feature\API;

use App\Owner;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OwnerTest extends TestCase
{
    use RefreshDatabase;

    /**  */
    public function can_create_owner()
    {
        $this->login();

        $this->post('api/owner/owners', [
            'name' => 'name',
            'email' => 'email@email.com',
            'phone' => '0114949901',
            'address' => 'address',
            'password' => 'password',
            'password_confirmation' => 'password'
        ]);

        $this->assertDatabaseHas('owners', [
            'name' => 'name',
            'email' => 'email@email.com',
            'address' => 'address',
            'phone' => '0114949901',
        ]);
    }

    /**  */
    public function can_update_owner()
    {
        $owner = factory(Owner::class)->create();

        $this->login();

        $this->put('api/owner/owners/'. $owner->id, [
            'name' => 'name',
            'email' => 'email@email.com',
            'phone' => '0114949901',
            'address' => 'address',
            'password' => 'password',
            'password_confirmation' => 'password'
        ]);

        $this->assertDatabaseHas('owners', [
            'name' => 'name',
            'email' => 'email@email.com',
            'address' => 'address',
            'phone' => '0114949901',
        ]);
    }

}
