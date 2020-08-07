<?php

namespace App\Http\Controllers\API\CUstomers;

use App\Booking;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\API\BookingStoreRequest as APIBookingStoreRequest;
use App\Http\Requests\API\BookingUpdateRequest as APIBookingUpdateRequest;
use App\Http\Resources\BookingCollection;
use App\Http\Resources\Booking as BookingResource;
class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // return response()->json(auth()->user()->bookings);
        return new BookingCollection(auth()->user()->bookings);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(APIBookingStoreRequest $request)
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
    public function update(APIBookingUpdateRequest $request, Booking $booking)
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

    public function previous()
    {
        $previousBooking = Booking::where('customer_id', auth()->id())->latest('id')->take(5)->get();

        return new BookingCollection($previousBooking);

    }

}
