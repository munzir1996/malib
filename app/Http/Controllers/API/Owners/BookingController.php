<?php

namespace App\Http\Controllers\API\Owners;

use App\Booking;
use App\Http\Controllers\Controller;
use App\Pitch;
use Illuminate\Http\Request;
use App\Http\Resources\BookingCollection;
use App\Http\Resources\Booking as BookingResource;
use Illuminate\Support\Facades\Config;

class BookingController extends Controller
{

    public function booked()
    {
        $bookings = Booking::booked()->get();

        return new BookingCollection($bookings);

    }

    public function confirmed(Booking $booking)
    {
        $booking->update([
            'status' => Config::get('constants.booking.status_confirmed')
        ]);
        return response()->json(Config::get('constants.booking.status_confirmed'));

    }

    public function declined(Booking $booking)
    {
        $booking->update([
            'status' => Config::get('constants.booking.status_declined')
        ]);

        return response()->json(Config::get('constants.booking.status_declined'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        return new BookingResource($booking);
    }

}
