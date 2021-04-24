<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PassportAuthController;
use App\Http\Controllers\TicketController;

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

// Public methods
Route::post('register', [PassportAuthController::class, 'register']);
Route::post('login', [PassportAuthController::class, 'login']);

// Private authorized methods
Route::middleware('auth:api')->group(function () {

    // Restfull Tickets CRUD
    Route::resource('tickets', TicketController::class);

    // GET Returns data from authorized user
    Route::get('profile', [PassportAuthController::class, 'profile']);

    // // PUT Update data from authorized user
    Route::put('profile', [PassportAuthController::class, 'update']);

    // // PUT Update password from authorized user
    // Route::put('changePassword', [PassportAuthController::class, 'changePassword']);
});
