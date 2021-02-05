<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Clear route cache:
Route::get('/route-cache', function() {
    $exitCode = Artisan::call('route:cache');
    return 'Routes cache cleared';
});

//Clear config cache:
Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return 'Config cache cleared';
}); 

// Clear application cache:
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return 'Application cache cleared';
});
Route::get('/', function() {
 return view('page.coomingsoon');
});

// Clear view cache:
Route::get('/view-clear', function() {
    $exitCode = Artisan::call('view:clear');
    return 'View cache cleared';
});


Auth::routes(['register' => false]);

// Route::get('/', [App\Http\Controllers\PageController::class, 'Home']);
Route::get('/home', [App\Http\Controllers\PageController::class, 'Home']);
Route::get('/home-arabic', [App\Http\Controllers\PageController::class, 'HomeArabic']);
Route::get('/track/{id}', [App\Http\Controllers\PageController::class, 'Track']);

Route::get('/ship-now', [App\Http\Controllers\PageController::class, 'shipNow']);
Route::get('/get-area-price/{weight}', [App\Http\Controllers\PageController::class, 'getAreaPrice']);
Route::post('/save-mobile-verify', [App\Http\Controllers\PageController::class, 'saveMobileVerify']);
Route::get('/verify-otp/{mobile}/{otp}', [App\Http\Controllers\PageController::class, 'verifyOtp']);
Route::post('/save-new-shipment', [App\Http\Controllers\PageController::class, 'saveNewShipment']);

Route::get('/register', [App\Http\Controllers\PageController::class, 'userRegister']);
Route::post('/save-user-register', [App\Http\Controllers\PageController::class, 'saveUserRegister']);

Route::get('/send-mail/{id}', [App\Http\Controllers\PageController::class, 'sendMail']);

Route::get('/verify-account/{id}', [App\Http\Controllers\PageController::class, 'verifyAccount']);

Route::get('/get-area/{id}', [App\Http\Controllers\PageController::class, 'getArea']);


Route::group(['prefix' => 'admin'],function(){

	Route::get('/login', [App\Http\Controllers\AdminLogin\LoginController::class, 'showLoginForm'])->name('admin.login');
	Route::post('/login', [App\Http\Controllers\AdminLogin\LoginController::class, 'login'])->name('admin.login.submit');
	Route::get('/logout', [App\Http\Controllers\AdminLogin\LoginController::class, 'logout'])->name('admin.logout');

	Route::post('/password/email', [App\Http\Controllers\AdminLogin\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('admin.password.email');
	Route::get('/password/reset', [App\Http\Controllers\AdminLogin\ForgotPasswordController::class, 'showLinkRequestForm'])->name('admin.password.request');
	Route::post('/password/reset', [App\Http\Controllers\AdminLogin\ResetPasswordController::class, 'reset']);
	Route::get('/password/reset/{token}', [App\Http\Controllers\AdminLogin\ResetPasswordController::class, 'showResetForm'])->name('admin.password.reset');


	Route::get('/dashboard', [App\Http\Controllers\Admin\HomeController::class, 'dashboard'])->name('admin.dashboard');

    Route::get('/view-customer', [App\Http\Controllers\Admin\CustomerController::class, 'viewCustomer']);
    
    Route::get('/view-profile/{id}', [App\Http\Controllers\Admin\CustomerController::class, 'viewProfile']);

    Route::get('/edit-customer/{id}', [App\Http\Controllers\Admin\CustomerController::class, 'editCustomer']);
    
    Route::post('/update-verify-status', [App\Http\Controllers\Admin\CustomerController::class, 'updateVerifyStatus']);

    Route::post('/save-sales-team-process', [App\Http\Controllers\Admin\CustomerController::class, 'saveSalesTeamProcess']);
    Route::post('/update-sales-team-process', [App\Http\Controllers\Admin\CustomerController::class, 'updateSalesTeamProcess']);

    Route::get('/update-account-status/{id}/{status}', [App\Http\Controllers\Admin\CustomerController::class, 'updateAccountStatus']);

    Route::get('/update-sales-status/{id}/{status}', [App\Http\Controllers\Admin\CustomerController::class, 'updateSalestStatus']);

    Route::get('/get-rate-card-staus/{id}', [App\Http\Controllers\Admin\CustomerController::class, 'getRateCardStaus']);

    Route::get('/edit-rate-card/{id}', [App\Http\Controllers\Admin\CustomerController::class, 'editRateCard']);

	//user
	Route::get('/user', [App\Http\Controllers\Admin\UserController::class, 'User']);
    Route::POST('/save-user', [App\Http\Controllers\Admin\UserController::class, 'saveUser']);
    Route::POST('/update-user', [App\Http\Controllers\Admin\UserController::class, 'updateUser']);
    Route::get('/edit-user/{id}', [App\Http\Controllers\Admin\UserController::class, 'editUser']);
	Route::get('/delete-user/{id}', [App\Http\Controllers\Admin\UserController::class, 'deleteUser']);
	
	//role
	Route::get('/role', [App\Http\Controllers\Admin\UserController::class, 'Role']);
    Route::POST('/save-role', [App\Http\Controllers\Admin\UserController::class, 'saveRole']);
    Route::POST('/update-role', [App\Http\Controllers\Admin\UserController::class, 'updateRole']);
    Route::get('/edit-role/{id}', [App\Http\Controllers\Admin\UserController::class, 'editRole']);
    Route::get('/delete-role/{id}', [App\Http\Controllers\Admin\UserController::class, 'deleteRole']);

    //country
	Route::get('/country', [App\Http\Controllers\Admin\CityController::class, 'Country']);
    Route::POST('/save-country', [App\Http\Controllers\Admin\CityController::class, 'saveCountry']);
    Route::POST('/update-country', [App\Http\Controllers\Admin\CityController::class, 'updateCountry']);
    Route::get('/country/{id}', [App\Http\Controllers\Admin\CityController::class, 'editCountry']);
    Route::get('/country-delete/{id}', [App\Http\Controllers\Admin\CityController::class, 'deleteCountry']);

    //city
	Route::get('/city/{id}', [App\Http\Controllers\Admin\CityController::class, 'City']);
    Route::POST('/save-city', [App\Http\Controllers\Admin\CityController::class, 'saveCity']);
    Route::POST('/update-city', [App\Http\Controllers\Admin\CityController::class, 'updateCity']);
    Route::get('/edit-city/{id}', [App\Http\Controllers\Admin\CityController::class, 'editCity']);
    Route::get('/city-delete/{id}', [App\Http\Controllers\Admin\CityController::class, 'deleteCity']);

    //area
	Route::get('/area/{id}/{country}', [App\Http\Controllers\Admin\CityController::class, 'Area']);
    Route::POST('/save-area', [App\Http\Controllers\Admin\CityController::class, 'saveArea']);
    Route::POST('/update-area', [App\Http\Controllers\Admin\CityController::class, 'updateArea']);
    Route::get('/edit-area/{id}', [App\Http\Controllers\Admin\CityController::class, 'editArea']);
    Route::get('/area-delete/{id}', [App\Http\Controllers\Admin\CityController::class, 'deleteArea']);


    //drop-point
	Route::get('/drop-point', [App\Http\Controllers\Admin\SettingsController::class, 'DropPoint']);
    Route::POST('/save-drop-point', [App\Http\Controllers\Admin\SettingsController::class, 'saveDropPoint']);
    Route::POST('/update-drop-point', [App\Http\Controllers\Admin\SettingsController::class, 'updateDropPoint']);
    Route::get('/edit-drop-point/{id}', [App\Http\Controllers\Admin\SettingsController::class, 'editDropPoint']);
    Route::get('/drop-point-delete/{id}', [App\Http\Controllers\Admin\SettingsController::class, 'deleteDropPoint']);

    //package-category
	Route::get('/package-category', [App\Http\Controllers\Admin\SettingsController::class, 'packageCategory']);
    Route::POST('/save-package-category', [App\Http\Controllers\Admin\SettingsController::class, 'savepackageCategory']);
    Route::POST('/update-package-category', [App\Http\Controllers\Admin\SettingsController::class, 'updatepackageCategory']);
    Route::get('/edit-package-category/{id}', [App\Http\Controllers\Admin\SettingsController::class, 'editpackageCategory']);
    Route::get('/package-category-delete/{id}', [App\Http\Controllers\Admin\SettingsController::class, 'deletepackageCategory']);

    //station
	Route::get('/station', [App\Http\Controllers\Admin\SettingsController::class, 'Station']);
    Route::POST('/save-station', [App\Http\Controllers\Admin\SettingsController::class, 'saveStation']);
    Route::POST('/update-station', [App\Http\Controllers\Admin\SettingsController::class, 'updateStation']);
    Route::get('/edit-station/{id}', [App\Http\Controllers\Admin\SettingsController::class, 'editStation']);
    Route::get('/station-delete/{id}', [App\Http\Controllers\Admin\SettingsController::class, 'deleteStation']);


    //agent
	Route::get('/agent', [App\Http\Controllers\Admin\AgentController::class, 'Agent']);
    Route::POST('/save-agent', [App\Http\Controllers\Admin\AgentController::class, 'saveAgent']);
    Route::POST('/update-agent', [App\Http\Controllers\Admin\AgentController::class, 'updateAgent']);
    Route::get('/edit-agent/{id}', [App\Http\Controllers\Admin\AgentController::class, 'editAgent']);
    Route::get('/agent-delete/{id}', [App\Http\Controllers\Admin\AgentController::class, 'deleteAgent']);

    //settings
    Route::get('/settings', [App\Http\Controllers\Admin\SettingsController::class, 'Settings']);
    Route::POST('/update-settings', [App\Http\Controllers\Admin\SettingsController::class, 'updateSettings']);

    //shipment
    Route::get('/shipment', [App\Http\Controllers\Admin\ShipmentController::class, 'Shipment']);
    Route::get('/view-shipment/{id}', [App\Http\Controllers\Admin\ShipmentController::class, 'viewShipment']);
    Route::POST('/get-shipment', [App\Http\Controllers\Admin\ShipmentController::class, 'getShipment']);

    Route::get('/new-shipment', [App\Http\Controllers\Admin\ShipmentController::class, 'newShipment']);
    Route::get('/view-shipment/{id}', [App\Http\Controllers\Admin\ShipmentController::class, 'viewShipment']);
    
    Route::POST('/save-new-address', [App\Http\Controllers\Admin\ShipmentController::class, 'saveNewAddress']);
    Route::POST('/save-new-shipment', [App\Http\Controllers\Admin\ShipmentController::class, 'saveNewShipment']);
    Route::POST('/save-shipment-notes', [App\Http\Controllers\Admin\ShipmentController::class, 'saveShipmentNotes']);

    Route::get('/print-label/{id}', [App\Http\Controllers\Admin\ShipmentController::class, 'printLabel']);
    Route::get('/print-invoice/{id}', [App\Http\Controllers\Admin\ShipmentController::class, 'printInvoice']);


    Route::get('/get-area-price/{weight}/{to_address}/{shipment_mode}/{user_id}', [App\Http\Controllers\Admin\ShipmentController::class, 'getAreaPrice']);

    Route::get('/get-price-details/{id}', [App\Http\Controllers\Admin\ShipmentController::class, 'getPriceDetails']);

    Route::post('/assign-agent', [App\Http\Controllers\Admin\ShipmentController::class, 'assignAgent']);
    Route::post('/assign-agent-station', [App\Http\Controllers\Admin\ShipmentController::class, 'AssignAgentStation']);
    Route::post('/assign-agent-delivery', [App\Http\Controllers\Admin\ShipmentController::class, 'AssignAgentDelivery']);

    Route::get('/pickup-station/{id}', [App\Http\Controllers\Admin\ShipmentController::class, 'pickupStation']);
    Route::post('/update-pickup-station', [App\Http\Controllers\Admin\ShipmentController::class, 'updatePickupStation']);

    Route::get('/received-station/{id}', [App\Http\Controllers\Admin\ShipmentController::class, 'receivedStation']);
    Route::post('/update-received-station', [App\Http\Controllers\Admin\ShipmentController::class, 'updateReceivedStation']);

    Route::get('/shipment-delivery/{id}', [App\Http\Controllers\Admin\ShipmentController::class, 'ShipmentDelivery']);
    Route::post('/update-shipment-delivery', [App\Http\Controllers\Admin\ShipmentController::class, 'updateShipmentDelivery']);


    Route::get('/user-search', [App\Http\Controllers\Admin\AutoCompleteController::class, 'userSearch']);
    Route::get('/get-user-id/{id}', [App\Http\Controllers\Admin\AutoCompleteController::class, 'getUserId']);

    Route::get('/get-to-address', [App\Http\Controllers\Admin\AutoCompleteController::class, 'getToAddress']);
    Route::get('/get-to-address-id/{id}', [App\Http\Controllers\Admin\AutoCompleteController::class, 'getToddressID']);

    Route::get('/get-from-address', [App\Http\Controllers\Admin\AutoCompleteController::class, 'getFromAddress']);
    Route::get('/get-from-address-id/{id}', [App\Http\Controllers\Admin\AutoCompleteController::class, 'getFromAddressID']);

    Route::get('/common-price', [App\Http\Controllers\Admin\SettingsController::class, 'getCommonPrice']);
    Route::POST('/save-common-price', [App\Http\Controllers\Admin\SettingsController::class, 'saveCommonPrice']);

    Route::get('/change-password', [App\Http\Controllers\Admin\SettingsController::class, 'changePassword']);
    Route::POST('/change-password', [App\Http\Controllers\Admin\SettingsController::class, 'updateChangePassword']);


    //report
    Route::get('/shipment-report', [App\Http\Controllers\Admin\ReportController::class, 'ShipmentReport']);
    Route::POST('/get-shipment-report/{status}', [App\Http\Controllers\Admin\ReportController::class, 'getShipmentReport']);

    Route::get('/revenue-report', [App\Http\Controllers\Admin\ReportController::class, 'RevenueReport']);
    Route::POST('/get-revenue-report/{date1}/{date2}', [App\Http\Controllers\Admin\ReportController::class, 'getRevenueReport']);

});


Route::group(['prefix' => 'user'],function(){

    Route::get('/dashboard', [App\Http\Controllers\User\HomeController::class, 'dashboard'])->name('user.dashboard');
    
    Route::get('/new-shipment', [App\Http\Controllers\User\ShipmentController::class, 'newShipment']);
    
    Route::POST('/save-new-address', [App\Http\Controllers\User\ShipmentController::class, 'saveNewAddress']);
    Route::POST('/save-new-shipment', [App\Http\Controllers\User\ShipmentController::class, 'saveNewShipment']);
    Route::get('/shipment', [App\Http\Controllers\User\ShipmentController::class, 'Shipment']);
    Route::POST('/get-shipment', [App\Http\Controllers\User\ShipmentController::class, 'getShipment']);

    Route::get('/print-label/{id}', [App\Http\Controllers\User\ShipmentController::class, 'printLabel']);
    Route::get('/print-invoice/{id}', [App\Http\Controllers\User\ShipmentController::class, 'printInvoice']);


    Route::get('/get-area-price/{weight}/{to_address}/{shipment_mode}', [App\Http\Controllers\User\ShipmentController::class, 'getAreaPrice']);

    Route::get('/get-price-details/{id}', [App\Http\Controllers\User\ShipmentController::class, 'getPriceDetails']);


    Route::get('/get-to-address', [App\Http\Controllers\User\AutoCompleteController::class, 'getToAddress']);
    Route::get('/get-to-address-id/{id}', [App\Http\Controllers\User\AutoCompleteController::class, 'getToddressID']);

    Route::get('/get-from-address', [App\Http\Controllers\User\AutoCompleteController::class, 'getFromAddress']);
    Route::get('/get-from-address-id/{id}', [App\Http\Controllers\User\AutoCompleteController::class, 'getFromAddressID']);


    Route::get('/edit-profile', [App\Http\Controllers\User\ProfileController::class, 'editProfile']);
    Route::POST('/update-profile', [App\Http\Controllers\User\ProfileController::class, 'updateProfile']);

    Route::get('/change-password', [App\Http\Controllers\User\ProfileController::class, 'changePassword']);
    Route::POST('/change-password', [App\Http\Controllers\User\ProfileController::class, 'updateChangePassword']);

});

