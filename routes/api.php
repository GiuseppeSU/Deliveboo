<?php

use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\TypeController;
use App\Http\Controllers\Api\RestaurantController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Braintree\Gateway;
use App\Http\Controllers\StatsController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// *** TYPE ***
// Rotta per la richiesta dei tipi di cucina
Route::get('/types', [TypeController::class, 'index']);

// *** RESTAURANT ***
// Rotta per la richiesta di una lista di ristoranti
Route::get('/restaurants', [RestaurantController::class, 'index']);

// *** PRODUCT ***
// Rotta per la richiesta di piatti di un ristorante
Route::get('/restaurants/{slug}', [RestaurantController::class, 'show']);


// *** TOKEN ***
// Rotta per la richiesta di un token per creare il dropin
Route::get('/generate-client-token',[PaymentController::class, 'getToken']);
// *** PAYMENT ***
Route::post('/process-payment',[PaymentController::class, 'processPayment']);

Route::get('/stats', [StatsController::class, 'index'])



    


