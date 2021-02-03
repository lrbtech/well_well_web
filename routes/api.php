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
