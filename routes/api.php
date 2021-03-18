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
Route::get('/exception-category/{status}', [App\Http\Controllers\ApiController::class, 'exceptionCategory']);
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



//order api

Route::post('/ext/order/get-area', [App\Http\Controllers\OrderApiController::class, 'getArea']);
Route::post('/ext/order/create-order', [App\Http\Controllers\OrderApiController::class, 'createOrder']);


// Route::group(['prefix' => 'user'],function(){
// $token = $request->header('APP_KEY');
// if($token != '$2y$10$/e.dAudOkbZZ2iec4zSNa.eHxLeElTAaeonpe6qtuD14O4VgYR0s2'){
//     return response()->json(['message' => 'App Key Not Found'], 401);
// }
// else{
    //user
    Route::post('/user-login', [App\Http\Controllers\UserApiController::class, 'userLogin']);

    Route::post('/tracking', [App\Http\Controllers\UserApiController::class, 'Tracking']);
    Route::get('/track-history/{id}', [App\Http\Controllers\UserApiController::class, 'trackHistory']);

    Route::get('/get-city', [App\Http\Controllers\UserApiController::class, 'getCity']);
    Route::get('/get-area/{id}', [App\Http\Controllers\UserApiController::class, 'getArea']);

    Route::get('/get-package-category', [App\Http\Controllers\UserApiController::class, 'getPackageCategory']);
    //ship-now save
    Route::post('/save-shipnow', [App\Http\Controllers\UserApiController::class, 'saveShipNow']);
    Route::post('/save-shipnow-package', [App\Http\Controllers\UserApiController::class, 'saveShipNowPackage']);

    Route::post('/save-mobile-verify', [App\Http\Controllers\UserApiController::class, 'saveMobileVerify']);
    Route::get('/verify-otp/{mobile}/{otp}', [App\Http\Controllers\UserApiController::class, 'verifyOtp']);

    //ship-now-guest
    Route::get('/get-shipping-price/{weight}/{declared_value}', [App\Http\Controllers\UserApiController::class, 'getShippingPrice']);

    //get dimensiget-dimensionon
    Route::get('/get-dimension/{weight}/{length}/{width}/{height}', [App\Http\Controllers\UserApiController::class, 'getDimension']);

    Route::get('/get-shipment-price/{user_id}/{weight}/{to_address}/{shipment_mode}/{declared_value}/{cod_enable}', [App\Http\Controllers\UserApiController::class, 'getShipmentPrice']);



    Route::post('/save-shipment', [App\Http\Controllers\UserApiController::class, 'saveShipment']);
    Route::post('/save-shipment-package', [App\Http\Controllers\UserApiController::class, 'saveShipmentPackage']);

    Route::post('/schedule-shipment', [App\Http\Controllers\UserApiController::class, 'scheduleShipment']);

    Route::post('/save-register', [App\Http\Controllers\UserApiController::class, 'saveRegister']);

    //email exist
    Route::get('/get-email/{email}', [App\Http\Controllers\UserApiController::class, 'getEmail']);

    //mobile exist
    Route::get('/get-mobile/{mobile}', [App\Http\Controllers\UserApiController::class, 'getMobile']);

    Route::get('/get-available-time/{date}', [App\Http\Controllers\UserApiController::class, 'getAvailableTime']);

    Route::get('/get-terms', [App\Http\Controllers\UserApiController::class, 'getTerms']);

    Route::get('/get-dashboard/{user_id}', [App\Http\Controllers\UserApiController::class, 'getDashboard']);
    Route::get('/get-dummy-record/{count}', [App\Http\Controllers\ApiController::class, 'dummyRecordCreate']);

    Route::get('/get-from-address/{user_id}', [App\Http\Controllers\UserApiController::class, 'getFromAddress']);
    Route::get('/get-to-address/{user_id}', [App\Http\Controllers\UserApiController::class, 'getToAddress']);

    Route::post('/save-address', [App\Http\Controllers\UserApiController::class, 'saveAddress']);



    Route::get('/get-pending-shipment/{user_id}', [App\Http\Controllers\UserApiController::class, 'pendingShipment']);

    Route::get('/delete-pending-shipment/{id}', [App\Http\Controllers\UserApiController::class, 'deletePendingShipment']);

    Route::get('/get-all-shipment/{user_id}', [App\Http\Controllers\UserApiController::class, 'getAllShipment']);

    //shipment delivery report
    Route::get('/get-delivered-shipment/{user_id}', [App\Http\Controllers\UserApiController::class, 'getDeliveredShipment']);

    Route::POST('/get-payments-in-report/{date1}/{date2}/{user_id}', [App\Http\Controllers\UserApiController::class, 'getPaymentsInReport']);

    Route::get('/settlement-details/{user_id}', [App\Http\Controllers\UserApiController::class, 'settlementDetails']);

    Route::POST('/get-revenue-report/{date1}/{date2}/{user_id}', [App\Http\Controllers\UserApiController::class, 'getRevenueReport']);

    Route::POST('/get-shipment-report/{status}/{date1}/{date2}/{user_id}', [App\Http\Controllers\UserApiController::class, 'getShipmentReport']);

    Route::POST('/get-invoice/{date1}/{date2}/{user_id}', [App\Http\Controllers\UserApiController::class, 'getInvoice']);

    Route::get('/hold-shipment/{id}/{status}', [App\Http\Controllers\UserApiController::class, 'HoldShipment']);

    Route::post('/cancel-shipment', [App\Http\Controllers\UserApiController::class, 'CancelShipment']);

    Route::get('/excel-shipment-report/{status}/{date1}/{date2}/{user_id}', [App\Http\Controllers\UserApiController::class, 'excelShipmentReport']);
    Route::get('/excel-revenue-report/{date1}/{date2}/{user_id}', [App\Http\Controllers\UserApiController::class, 'excelRevenueReport']);
    
// }

// });
