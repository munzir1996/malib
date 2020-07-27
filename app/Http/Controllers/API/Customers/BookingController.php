<?php

namespace App\Http\Controllers\API\Customers;

use App\Booking;
use App\Http\Controllers\Controller;
use App\Http\Requests\BookingStoreRequest;
use App\Http\Requests\BookingUpdateRequest;
use App\Http\Resources\BookingCollection;
use App\Http\Resources\Booking as BookingResource;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookings = Booking::with(['pitch', 'customer', 'pitchSchedule'])->get();

        return new BookingCollection($bookings);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookingStoreRequest $request)
    {
        $request->validated();

        Booking::create($request->all());

        return response()->json("Booking Create", 201);
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(BookingUpdateRequest $request, Booking $booking)
    {
        $request->validated();

        $booking->update($request->all());

        return response()->json('Update Booking' , 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        //
    }
}
