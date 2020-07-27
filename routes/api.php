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


Route::group(['prefix' => '/owner'],function ()
{
    Route::apiResource('/owners', 'API\Owners\OwnerController')->except(['destroy']);
    Route::apiResource('/areas', 'API\Owners\AreaController')->except(['destroy']);
    Route::apiResource('/pitchs', 'API\Owners\PitchController')->except(['destroy']);
    Route::apiResource('/pitchschedules', 'API\Owners\PitchScheduleController')->except(['destroy']);
});

Route::group(['prefix' => 'customer'],function ()
{
    Route::apiResource('/customers', 'API\Customers\CustomerController')->except(['destroy']);
    Route::apiResource('/bookings', 'API\Customers\BookingController')->except(['destroy']);
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
