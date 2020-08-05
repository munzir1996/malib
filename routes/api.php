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


Route::group(['prefix' => 'owner', 'middleware' => 'auth:sanctum'], function () {

    Route::post('/logout', 'API\Auth\OwnerAuthController@logout');
    Route::put('/profile', 'API\Auth\OwnerAuthController@updateProfile');

});

Route::group(['prefix' => 'customer', 'middleware' => 'auth:sanctum'], function () {

    Route::post('/logout', 'API\Auth\CustomerAuthController@logout');
    Route::put('/profile', 'API\Auth\CustomerAuthController@updateProfile');
    Route::apiResource('/bookings', 'API\Customers\BookingController', ['destroy' => false]);
    Route::post('/pitch/comments', 'API\Customers\PitchCommentController@store');

});

Route::group(['prefix' => '/owner'], function ()
{
    Route::post('/register', 'API\Auth\OwnerAuthController@register');
    Route::post('/login', 'API\Auth\OwnerAuthController@login');
    Route::apiResource('/owners', 'API\Owners\OwnerController', ['destroy' => false]);
    Route::apiResource('/areas', 'API\Owners\AreaController', ['destroy' => false]);
    Route::apiResource('/pitchs', 'API\Owners\PitchController', ['destroy' => false]);
    Route::apiResource('/pitchschedules', 'API\Owners\PitchScheduleController', ['destroy' => false]);
});

Route::group(['prefix' => 'customer'], function ()
{
    Route::post('/register', 'API\Auth\CustomerAuthController@register');
    Route::post('/login', 'API\Auth\CustomerAuthController@login');
    Route::apiResource('/customers', 'API\Customers\CustomerController', ['destroy' => false]);
    Route::get('/pitchs', 'API\Customers\PitchController@index');
    Route::get('/pitchs/{pitch}', 'API\Customers\PitchController@show');
    Route::get('/pitchs/filter/{area}', 'API\Customers\PitchController@filter');
    Route::get('/pitch/comments/{pitch}', 'API\Customers\PitchCommentController@index');
});



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


