<?php

namespace Tests\Feature\API;

use App\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CustomerTest extends TestCase
{
    use RefreshDatabase;

    /**  */
    public function can_create_customer()
    {
        $this->login();

        $this->post('api/customer/customers', [
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

    /**  */
    public function can_update_customer()
    {
        $customer = factory(Customer::class)->create();

        $this->login();

        $this->put('api/customer/customers/'. $customer->id, [
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

}
