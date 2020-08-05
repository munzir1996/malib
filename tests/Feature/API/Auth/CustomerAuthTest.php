<?php

namespace Tests\Feature\API\Auth;

use App\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Laravel\Sanctum\Sanctum;

class CustomerAuthTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function customer_can_register()
    {
        $response = $this->post('/api/customer/register', [
            'name' => 'name',
            'email' => 'email@email.com',
            'phone' => '0114949901',
            'address' => 'address',
            'password' => 'password',
            'password_confirmation' => 'password'
        ]);

        $this->assertDatabaseHas('customers', [
            'name' => 'name',
            'email' => 'email@email.com',
            'address' => 'address',
            'phone' => '0114949901',
        ]);

    }

    /** @test */
    public function customer_can_update_his_profile()
    {

        $this->withoutExceptionHandling();

        $customer = $this->customerApiLogin();

        $this->put('/api/customer/profile', [
            'name' => 'Updated',
            'email' => 'updated@test.com',
            'phone' => '0114949901',
            'address' => 'address',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertDatabaseHas('customers', [
            'name' => 'Updated',
            'email' => 'updated@test.com',
        ]);

    }

    /**
     * @test
     */
    public function customer_can_login_and_issue_token()
    {
        $customer = factory(Customer::class)->create([
            'phone' => '0114949901',
        ]);

        $response = $this->post('/api/customer/login', [
            'phone' => '0114949901',
            'password' => 'password',
        ]);

        $customer = Customer::first();

        $response->assertJson([
            'customer' => $customer->only(['id', 'name', 'email', 'phone', 'address']),
        ]);

    }

    /** @test */
    public function customer_can_logout_and_delete_his_token()
    {
        $this->withoutExceptionHandling();

        $customer = factory(Customer::class)->create([
            'phone' => '0114949901',
        ]);

        Sanctum::actingAs(
            $customer,
            ['*']
        );

        $customer->createToken('customer-application');

        $this->post('/api/customer/logout');

        $this->assertCount(0, $customer->tokens);
    }

}
