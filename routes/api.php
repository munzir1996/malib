<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('/customer')->group(function () {

    Route::middleware('auth:sanctum')->group(function () {
        // Auth
        Route::post('/logout', 'API\Auth\CustomerAuthController@logout'); //Done
        Route::put('/profile', 'API\Auth\CustomerAuthController@updateProfile'); //Done
        // Booking
        Route::get('/previous/bookings', 'API\Customers\BookingController@previous'); //Done
        Route::get('/bookings', 'API\Customers\BookingController@index');//Done
        Route::get('/bookings/{booking}', 'API\Customers\BookingController@show');//Done
        Route::post('/bookings', 'API\Customers\BookingController@store');//Done
        Route::put('/bookings/{booking}', 'API\Customers\BookingController@update'); //Done
        // Pitch Comment
        Route::post('/pitch/comments', 'API\Customers\PitchCommentController@store');//Done
    });

    // Auth
    Route::post('/login', 'API\Auth\CustomerAuthController@login');//Done
    Route::post('/register', 'API\Auth\CustomerAuthController@register');//Done
    Route::post('/check/phonenumber', 'API\Auth\CustomerAuthController@checkPhoneNumber');//Done
    Route::post('/reset/password', 'API\Auth\CustomerAuthController@resetPassword');//Done
    // Area
    Route::get('/areas','API\Customers\AreaController@index');//Done
    // Pitch Comment
    Route::get('/pitch/comments/{pitch}', 'API\Customers\PitchCommentController@index');//Done
    // Pitch
    Route::get('/pitchs', 'API\Customers\PitchController@index');//Done
    Route::get('/pitchs/{pitch}', 'API\Customers\PitchController@show');//Done
    Route::get('/pitchs/filter/{area}', 'API\Customers\PitchController@filter');//Done
    // Pitch Schedule
    Route::get('/pitchschedules/{pitch}', 'API\Customers\PitchScheduleController@index');//Done
    // Customer
    // Route::apiResource('/customers', 'API\Customers\CustomerController', ['destroy' => false]);

});


Route::prefix('/owner')->group(function () {

    Route::middleware('auth:sanctum')->group(function () {
        // Auth
        Route::post('/logout', 'API\Auth\OwnerAuthController@logout');//Done
        Route::put('/profile', 'API\Auth\OwnerAuthController@updateProfile');//Done
        // Pitch same
        Route::apiResource('/pitchs', 'API\Owners\PitchController', ['destroy' => false]);//Done
        Route::get('/pitch/pitchschedules/{pitch}', 'API\Owners\PitchController@pitchSchedule');//Done
        // Area
        Route::get('/areas','API\Owners\AreaController@index');//Done
        // Booking
        Route::post('/bookings/confirm/{booking}', 'API\Owners\BookingController@confirmed');//Done
        Route::post('/bookings/decline/{booking}', 'API\Owners\BookingController@declined');//Done
        Route::get('/bookings/booked', 'API\Owners\BookingController@booked');//Done
        Route::get('/bookings/{booking}', 'API\Owners\BookingController@show');//Done
        //Pitch Schedule same
        Route::get('/pitchschedules/{pitchschedule}', 'API\Owners\PitchSchedulesController@show');//Done
        Route::post('/pitchschedules', 'API\Owners\PitchSchedulesController@store');//Done
        Route::put('/pitchschedules/{pitchschedule}', 'API\Owners\PitchSchedulesController@update');//Done
    });

    // Auth
    Route::post('/register', 'API\Auth\OwnerAuthController@register');//Done
    Route::post('/login', 'API\Auth\OwnerAuthController@login');//Done
    Route::post('/check/phonenumber', 'API\Auth\OwnerAuthController@checkPhoneNumber');//Done
    Route::post('/reset/password', 'API\Auth\OwnerAuthController@resetPassword');//Done
    //Pitch Schedule
    // Route::apiResource('/pitchschedules', 'API\Owners\PitchScheduleController', ['destroy' => false]);
    // Owner
    // Route::apiResource('/owners', 'API\Owners\OwnerController', ['destroy' => false]);

});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


