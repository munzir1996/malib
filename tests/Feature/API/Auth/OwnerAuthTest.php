<?php

namespace Tests\Feature\API\Auth;

// use App\Http\Resources\Owner;
use App\Owner;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class OwnerAuthTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function owner_can_register()
    {
        $response = $this->post('/api/owner/register', [
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

    /** @test */
    public function owner_can_update_his_profile()
    {

        $this->withoutExceptionHandling();

        $owner = $this->ownerApiLogin();

        $this->put('/api/owner/profile', [
            'name' => 'Updated',
            'email' => 'updated@test.com',
            'phone' => '0114949901',
            'address' => 'address',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertDatabaseHas('owners', [
            'name' => 'Updated',
            'email' => 'updated@test.com',
        ]);

    }

    /**
     * @test
     */
    public function owner_can_login_and_issue_token()
    {
        $owner = factory(Owner::class)->create([
            'phone' => '0114949901',
        ]);

        $response = $this->post('/api/owner/login', [
            'phone' => '0114949901',
            'password' => 'password',
        ]);

        $owner = Owner::first();

        $response->assertJson([
            'owner' => $owner->only(['id', 'name', 'email', 'phone', 'address']),
        ]);

    }

    /** @test */
    public function owner_can_logout_and_delete_his_token()
    {
        $this->withoutExceptionHandling();

        $owner = factory(Owner::class)->create([
            'phone' => '0114949901',
        ]);

        Sanctum::actingAs(
            $owner,
            ['*']
        );

        $owner->createToken('owner-application');

        $this->post('/api/owner/logout');

        $this->assertCount(0, $owner->tokens);
    }

    /** @test */
    public function check_owner_phone_number()
    {
        $this->withoutExceptionHandling();

        $owner = factory(Owner::class)->create([
            'phone' => '0114949901',
        ]);

        $response = $this->post('/api/owner/check/phonenumber', [
            'phone' => '0114949901',
        ]);

        $this->assertEquals(1, $response->json());
    }

    /** @test */
    public function owner_can_reset_password()
    {
        $this->withoutExceptionHandling();

        $owner = factory(Owner::class)->create([
            'phone' => '0114949901',
        ]);

        $response = $this->post('/api/owner/reset/password', [
            'id' => $owner->id,
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertJsonFragment([
            "message" => "Password reset successfully",
        ]);
    }
}
