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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/agent-login', [App\Http\Controllers\ApiController::class, 'agentLogin']);


Route::get('/get-pickup/{agent_id}', [App\Http\Controllers\ApiController::class, 'getPickup']);
Route::get('/get-delivery/{agent_id}', [App\Http\Controllers\ApiController::class, 'getDelivery']);

Route::get('/get-pickup-details/{id}', [App\Http\Controllers\ApiController::class, 'getPickupDetails']);
Route::get('/get-delivery-details/{id}', [App\Http\Controllers\ApiController::class, 'getDeliveryDetails']);

Route::get('/get-station/{agent_id}', [App\Http\Controllers\ApiController::class, 'getStation']);

Route::get('/get-shipment-package/{id}', [App\Http\Controllers\ApiController::class, 'getShipmentPacakgae']);


Route::post('/update-pickup', [App\Http\Controllers\ApiController::class, 'updatePickup']);
Route::post('/update-delivery', [App\Http\Controllers\ApiController::class, 'updateDelivery']);

Route::post('/change-password', [App\Http\Controllers\ApiController::class, 'changePassword']);

Route::post('/scan-package', [App\Http\Controllers\ApiController::class, 'scanPackage']);

Route::get('/exception-category', [App\Http\Controllers\ApiController::class, 'exceptionCategory']);

Route::get('/get-today-station', [App\Http\Controllers\ApiController::class, 'getTodayStation']);
Route::get('/get-today-data', [App\Http\Controllers\ApiController::class, 'getTodayData']);

Route::get('/get-exception-shipment', [App\Http\Controllers\ApiController::class, 'getExceptionShipment']);

Route::get('/get-exception-details/{id}', [App\Http\Controllers\ApiController::class, 'getExceptionDetails']);
