<?php

namespace Tests\Feature\API;

use App\Booking;
use App\Customer;
use App\Pitch;
use App\PitchSchedule;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class BookingTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    private $startDate;

    protected function startDate(){

        // Random datetime of the current week
        $this->startDate = $this->faker->dateTimeBetween('this week', '+6 days');

    }

    /** @test */
    public function customer_can_create_booking()
    {
        $this->withoutExceptionHandling();

        $pitch = factory(Pitch::class)->create();
        $pitchSchedule = factory(PitchSchedule::class)->create();

        $customer = $this->customerApiLogin();

        $this->startDate();

        $this->post('api/customer/bookings', [
            'book_date' => $this->startDate,
            'status' => Config::get('constants.booking.status_booked'),
            'customer_id' => $customer->id,
            'pitch_id' => $pitch->id,
            'pitch_schedule_id' => $pitchSchedule->id,
        ]);

        $this->assertDatabaseHas('bookings', [
            'book_date' => $this->startDate,
            'status' => Config::get('constants.booking.status_booked'),
            'customer_id' => $customer->id,
            'pitch_id' => $pitch->id,
            'pitch_schedule_id' => $pitchSchedule->id,
        ]);
    }

    /** @test */
    public function customer_can_update_booking()
    {
        $booking = factory(Booking::class)->create();

        $customer = $this->customerApiLogin($booking->customer);

        $this->startDate();

        $this->put('api/customer/bookings/'. $booking->id, [
            'book_date' => $this->startDate,
            'status' => Config::get('constants.booking.status_booked'),
            'customer_id' => $customer->id,
            'pitch_id' => $booking->pitch->id,
            'pitch_schedule_id' => $booking->pitchSchedule->id,
        ]);

        $this->assertDatabaseHas('bookings', [
            'book_date' => $this->startDate,
            'status' => Config::get('constants.booking.status_booked'),
            'customer_id' => $customer->id,
            'pitch_id' => $booking->pitch->id,
            'pitch_schedule_id' => $booking->pitchSchedule->id,
        ]);
    }

    /** @test */
    public function owner_can_confirm_booking()
    {
        $this->withoutExceptionHandling();

        $booking = factory(Booking::class)->create();

        $owner = $this->ownerApiLogin();

        $this->post('api/owner/bookings/confirmed/'. $booking->id);

        $this->assertDatabaseHas('bookings', [
            'id' => $booking->id,
            'book_date' => $booking->book_date,
            'status' => Config::get('constants.booking.status_confirmed'),
            'customer_id' => $booking->customer->id,
            'pitch_id' => $booking->pitch->id,
            'pitch_schedule_id' => $booking->pitchSchedule->id,
        ]);
    }

    /** @test */
    public function owner_can_declined_booking()
    {
        $this->withoutExceptionHandling();

        $booking = factory(Booking::class)->create();

        $owner = $this->ownerApiLogin();

        $this->post('api/owner/bookings/declined/'. $booking->id);

        $this->assertDatabaseHas('bookings', [
            'id' => $booking->id,
            'book_date' => $booking->book_date,
            'status' => Config::get('constants.booking.status_declined'),
            'customer_id' => $booking->customer->id,
            'pitch_id' => $booking->pitch->id,
            'pitch_schedule_id' => $booking->pitchSchedule->id,
        ]);
    }


}



