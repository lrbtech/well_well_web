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

Route::post('/update-package-exception', [App\Http\Controllers\ApiController::class, 'updatePackageException']);

Route::post('/update-package-details', [App\Http\Controllers\ApiController::class, 'updatePackageDetails']);


Route::post('/change-password', [App\Http\Controllers\ApiController::class, 'changePassword']);

Route::post('/scan-package', [App\Http\Controllers\ApiController::class, 'scanPackage']);
Route::post('/scan-package-sku', [App\Http\Controllers\ApiController::class, 'scanPackageSku']);
Route::post('/barcode-package', [App\Http\Controllers\ApiController::class, 'barcodePackage']);

Route::post('/barcode-scan', [App\Http\Controllers\ApiController::class, 'barcodeScan']);
Route::get('/mobile-print-label/{id}', [App\Http\Controllers\ApiController::class, 'mobilePrintLabel']);
Route::get('/exception-category', [App\Http\Controllers\ApiController::class, 'exceptionCategory']);
Route::get('/get-today-station', [App\Http\Controllers\ApiController::class, 'getTodayStation']);
Route::get('/get-today-data/{id}', [App\Http\Controllers\ApiController::class, 'getTodayData']);
Route::get('/print-today-data/{id}', [App\Http\Controllers\ApiController::class, 'printTodayData']);
Route::get('/get-exception-shipment', [App\Http\Controllers\ApiController::class, 'getExceptionShipment']);
Route::get('/get-exception-details/{id}', [App\Http\Controllers\ApiController::class, 'getExceptionDetails']);


Route::post('/transist-in', [App\Http\Controllers\ApiController::class, 'transistIn']);
Route::post('/transist-out', [App\Http\Controllers\ApiController::class, 'transistOut']);
Route::post('/van-scan', [App\Http\Controllers\ApiController::class, 'vanScan']);
Route::post('/package-at-station', [App\Http\Controllers\ApiController::class, 'packageAtStation']);
Route::post('/update-pickup', [App\Http\Controllers\ApiController::class, 'updatePickup']);
Route::post('/update-delivery', [App\Http\Controllers\ApiController::class, 'updateDelivery']);
Route::post('/delivery-exception', [App\Http\Controllers\ApiController::class, 'deliveryException']);




//user
Route::post('/tracking', [App\Http\Controllers\UserApiController::class, 'Tracking']);
Route::get('/track-history/{id}', [App\Http\Controllers\UserApiController::class, 'trackHistory']);
