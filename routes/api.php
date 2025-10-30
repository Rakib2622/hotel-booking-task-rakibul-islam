<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AvailabilityController;

Route::get('/available-dates', [AvailabilityController::class, 'getAvailableDates']);
Route::post('/check-availability', [AvailabilityController::class, 'checkAvailability']);

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application.
| These routes are loaded by the RouteServiceProvider and assigned
| the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('api')->group(function () {
    Route::get('/test', function () {
        return response()->json(['message' => 'API working fine!']);
    });
});
