<?php

use Illuminate\Support\Facades\Route;
use App\Models\Location;
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



Route::group([
  'excluded_middleware' => ['auth'],
], function () {
    Route::post('/contact_us', [App\Http\Controllers\HomeController::class, 'sendEmail'])->name('contact_us');
});

Route::get('/', function () {
    $locations = Location::all();
    return view('welcome', compact(['locations']));
})->name('/');

Auth::routes();
Route::get('/SeeMore', [App\Http\Controllers\HomeController::class, 'SeeMore'])->name('SeeMore');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/UserStatus', [App\Http\Controllers\HomeController::class, 'UserStatus'])->name('UserStatus');
Route::get('/registerAdmin', [App\Http\Controllers\HomeController::class, 'registerAdmin']);
//WebSite
Route::get('/track', [App\Http\Controllers\websiteController::class, 'track']);
Route::get('/trackresult', [App\Http\Controllers\websiteController::class, 'trackresult'])->name('trackresult');
Route::get('/CheckShappingRate', [App\Http\Controllers\websiteController::class, 'CheckShappingRate']);
Route::get('/Services', [App\Http\Controllers\websiteController::class, 'Services']);
Route::get('/Clients', [App\Http\Controllers\websiteController::class, 'Clients']);
Route::get('/Contact', [App\Http\Controllers\websiteController::class, 'Contact']);
//Reports
Route::get('/Report', [App\Http\Controllers\ReportController::class, 'ordersReports'])->name('Reports');
Route::get('/Search', [App\Http\Controllers\ReportController::class, 'Search'])->name('Search');

//Financial Accounts
Route::get('/FinancialAccounts', [App\Http\Controllers\FinancialAccountsController::class, 'FinancialAccountsPage']);
Route::get('/Accounts', [App\Http\Controllers\FinancialAccountsController::class, 'Accounts']);
Route::get('/DriverFinance', [App\Http\Controllers\FinancialAccountsController::class, 'DriverFinance']);
Route::get('/ClientFinance', [App\Http\Controllers\FinancialAccountsController::class, 'ClientFinance']);
Route::post('/amountRecived', [App\Http\Controllers\FinancialAccountsController::class, 'amountRecived'])->name('amountRecived');
Route::post('/SaveAccounts', [App\Http\Controllers\FinancialAccountsController::class, 'SaveAccounts'])->name('SaveAccounts');

//Notifications
Route::get('/notificationOrder', [App\Http\Controllers\NotificationController::class, 'notificationOrder'])->name('notificationOrder');
//Admin
Route::get('/view_requests', [App\Http\Controllers\adminController::class, 'view_requests']);

Route::get('/register-admin', [App\Http\Controllers\adminController::class, 'RegisterAdmin']);

Route::get('/location-prices/{id}', [App\Http\Controllers\adminController::class, 'location_prices'])->name('location-prices');

Route::get('/cities-prices', [App\Http\Controllers\adminController::class, 'cities_prices'])->name('cities-prices');

Route::get('/districts-prices', [App\Http\Controllers\adminController::class, 'districts_prices'])->name('districts-prices');

Route::post('/submitDistrictsPrices', [App\Http\Controllers\adminController::class, 'submitDistrictsPrices'])->name('submitDistrictsPrices');

Route::get('/getcity', [App\Http\Controllers\adminController::class, 'getcity'])->name('getcity');

Route::get('/getUserDistrict', [App\Http\Controllers\adminController::class, 'getUserDistrict'])->name('getUserDistrict');

Route::get('/getdistricts', [App\Http\Controllers\adminController::class, 'getdistricts'])->name('getdistricts');

Route::get('/getAllDistricts', [App\Http\Controllers\adminController::class, 'getAllDistricts'])->name('getAllDistricts');

Route::get('/getAllClients', [App\Http\Controllers\adminController::class, 'getAllClients'])->name('getAllClients');

Route::get('/admin', [App\Http\Controllers\adminController::class, 'admin']);

Route::get('/editadmin', [App\Http\Controllers\adminController::class, 'editadmin']);

Route::post('nedco/SubmitEditAdmin', [App\Http\Controllers\adminController::class, 'SubmitEditAdmin']);

Route::get('/deleteadmin', [App\Http\Controllers\adminController::class, 'deleteadmin']);

Route::post('/SubmitRegisterAdmin', [App\Http\Controllers\adminController::class, 'SubmitRegisterAdmin'])->name('SubmitRegisterAdmin');

Route::get('/client', [App\Http\Controllers\adminController::class, 'client']);

Route::get('/editclient', [App\Http\Controllers\adminController::class, 'editclient']);

Route::get('/EditMyProfile', [App\Http\Controllers\adminController::class, 'EditMyProfile'])->name('EditMyProfile');

Route::get('/register-user', [App\Http\Controllers\adminController::class, 'registerUser']);

Route::get('/viewAllUsers', [App\Http\Controllers\adminController::class, 'viewAllUsers']);

Route::post('/SubmitEditall', [App\Http\Controllers\adminController::class, 'SubmitEditall'])->name('SubmitEditall');

Route::post('/SubmitEditallprofile', [App\Http\Controllers\adminController::class, 'SubmitEditallprofile'])->name('SubmitEditallprofile');

Route::post('/RegisterByAdmin', [App\Http\Controllers\adminController::class, 'RegisterByAdmin'])->name('RegisterByAdmin');

Route::get('/deleteclient', [App\Http\Controllers\adminController::class, 'deleteclient']);

Route::post('/SubmitRegisterclient', [App\Http\Controllers\adminController::class, 'SubmitRegisterclient']);

Route::get('/deletedriver', [App\Http\Controllers\adminController::class, 'deletedriver']);

Route::get('/editdriver', [App\Http\Controllers\adminController::class, 'editdriver']);

Route::get('/driver', [App\Http\Controllers\adminController::class, 'driver']);

Route::get('/deletefinance', [App\Http\Controllers\adminController::class, 'deletefinance']);

Route::get('/editfinance', [App\Http\Controllers\adminController::class, 'editfinance']);

Route::get('/finance', [App\Http\Controllers\adminController::class, 'finance']);

Route::get('/deletedispatcher', [App\Http\Controllers\adminController::class, 'deletedispatcher']);

Route::get('/editdispatcher', [App\Http\Controllers\adminController::class, 'editdispatcher']);

Route::get('/dispatcher', [App\Http\Controllers\adminController::class, 'dispatcher']);

Route::get('/deletedmonitor', [App\Http\Controllers\adminController::class, 'deletedmonitor']);

Route::get('/editmonitor', [App\Http\Controllers\adminController::class, 'editmonitor']);

Route::get('/monitor', [App\Http\Controllers\adminController::class, 'monitor']);

Route::get('/addlocation', [App\Http\Controllers\adminController::class, 'addlocation']);

Route::post('/SubmitLocation', [App\Http\Controllers\adminController::class, 'SubmitLocation'])->name('SubmitLocation');

Route::get('/location', [App\Http\Controllers\adminController::class, 'location']);

Route::get('/deleteLocation', [App\Http\Controllers\adminController::class, 'deleteLocation']);

Route::get('/editLocation', [App\Http\Controllers\adminController::class, 'editLocation']);

Route::post('/SubmitEditLocation', [App\Http\Controllers\adminController::class, 'SubmitEditLocation'])->name('SubmitEditLocation');

Route::get('/viewAllOrders', [App\Http\Controllers\adminController::class, 'viewAllOrders']);

Route::get('/requestAllLocations', [App\Http\Controllers\adminController::class, 'requestAllLocations']);

Route::get('/addOrder', [App\Http\Controllers\adminController::class, 'addOrder']);

Route::get('/addMultipleOrder', [App\Http\Controllers\adminController::class, 'addMultipleOrder']);

Route::post('/submitAddOrderFromTable', [App\Http\Controllers\adminController::class, 'submitAddOrderFromTable'])->name('submitAddOrderFromTable');

Route::post('/submitAddOrder', [App\Http\Controllers\adminController::class, 'submitAddOrder'])->name('submitAddOrder');

Route::post('/getDeliveryPrice', [App\Http\Controllers\adminController::class, 'getDeliveryPrice'])->name('getDeliveryPrice');

Route::post('/getClientDeliveryPrice', [App\Http\Controllers\adminController::class, 'getClientDeliveryPrice'])->name('getClientDeliveryPrice');

Route::post('/getDeliveryPrice2', [App\Http\Controllers\adminController::class, 'getDeliveryPrice2'])->name('getDeliveryPrice2');

Route::get('/ViewDetailsOrder', [App\Http\Controllers\adminController::class, 'ViewDetailsOrder']);

Route::get('/view_pickups', [App\Http\Controllers\adminController::class, 'view_pickups']);

Route::get('/coupon_codes', [App\Http\Controllers\adminController::class, 'view_coupon_codes']);

Route::get('/add_coupon', [App\Http\Controllers\adminController::class, 'add_coupon']);

Route::post('/submit_add_coupon', [App\Http\Controllers\adminController::class, 'submit_add_coupon'])->name('submit_add_coupon');

Route::post('/delete_coupon', [App\Http\Controllers\adminController::class, 'delete_coupon'])->name('delete_coupon');

Route::get('/dispatch', [App\Http\Controllers\adminController::class, 'scannerDispatch']);

Route::post('/dispatchOrder', [App\Http\Controllers\adminController::class, 'dispatchOrder'])->name('dispatchOrder');

Route::post('/resetOrderData', [App\Http\Controllers\adminController::class, 'resetOrderData'])->name('resetOrderData');

//Client

Route::get('/Order', [App\Http\Controllers\ClientController::class, 'Order']);

Route::post('/submitOrdes', [App\Http\Controllers\ClientController::class, 'submitOrdes'])->name('submitOrdes');

Route::get('/editOrder', [App\Http\Controllers\ClientController::class, 'editOrder']);

Route::post('/updateOrder', [App\Http\Controllers\ClientController::class, 'updateOrder'])->name('updateOrder');

Route::get('/viewOrder', [App\Http\Controllers\ClientController::class, 'viewOrder']);

Route::get('/Viewclient', [App\Http\Controllers\ClientController::class, 'Viewclient']);

Route::post('/clientDeliveryPrice', [App\Http\Controllers\ClientController::class, 'getDeliveryPrice'])->name('clientDeliveryPrice');

//Dispatcher

Route::get('/DispatcherOrder', [App\Http\Controllers\dispatcherController::class, 'viewOrder']);

Route::post('/assign', [App\Http\Controllers\dispatcherController::class, 'assignOrder'])->name('assign');

Route::post('/assignMultiOrder', [App\Http\Controllers\dispatcherController::class, 'assignMultiOrder'])->name('assignMultiOrder');

Route::get('/ViewAllDrivers', [App\Http\Controllers\dispatcherController::class, 'ViewAllDrivers']);

//driver

Route::get('/driverOrder', [App\Http\Controllers\driverController::class, 'driverOrders']);

Route::post('/checkPayment', [App\Http\Controllers\dispatcherController::class, 'checkPayment'])->name('checkPayment');

Route::post('/changeStatus', [App\Http\Controllers\driverController::class, 'changeStatus'])->name('changeStatus');

Route::get('/ViewDetailsDriver', [App\Http\Controllers\driverController::class, 'ViewDetailsDriver']);

//Monitor
Route::get('/monitor-clients', [App\Http\Controllers\MonitorController::class, 'clients']);

Route::get('/monitor-orders', [App\Http\Controllers\MonitorController::class, 'orders']);

Route::get('/monitor-drivers', [App\Http\Controllers\MonitorController::class, 'drivers']);

Route::post('/cheangeStatus', [App\Http\Controllers\MonitorController::class, 'cheangeStatus'])->name('cheangeStatus');

Route::get('/monitor-assigned-orders', [App\Http\Controllers\MonitorController::class, 'assignedOrders']);

//Locations
Route::get('/addCities', [App\Http\Controllers\CityController::class, 'addCities']);

Route::POST('/SubmitCities', [App\Http\Controllers\CityController::class, 'SubmitCities'])->name('SubmitCities');

Route::get('/editCities', [App\Http\Controllers\CityController::class, 'editCities']);

Route::get('/deleteCities', [App\Http\Controllers\CityController::class, 'deleteCities']);

Route::POST('/SubmitEditCities', [App\Http\Controllers\CityController::class, 'SubmitEditCities'])->name('SubmitEditCities');

Route::get('/addDistricts', [App\Http\Controllers\CityController::class, 'addDistricts']);

Route::POST('/SubmitDistricts', [App\Http\Controllers\CityController::class, 'SubmitDistricts'])->name('SubmitDistricts');

Route::get('/editDistricts', [App\Http\Controllers\CityController::class, 'editDistricts']);

Route::get('/deleteDistricts', [App\Http\Controllers\CityController::class, 'deleteDistricts']);

Route::POST('/SubmitEditDistricts', [App\Http\Controllers\CityController::class, 'SubmitEditDistricts'])->name('SubmitEditDistricts');

// pickups
Route::get('/pickups', [App\Http\Controllers\PickupsController::class, 'index']);
Route::get('/editpickup', [App\Http\Controllers\PickupsController::class, 'editpickup']);
Route::get('/deletepickup', [App\Http\Controllers\PickupsController::class, 'deletepickup']);
Route::post('/changePickupStatus', [App\Http\Controllers\PickupsController::class, 'changeStatus'])->name('changePickupStatus');
Route::post('/MultiStatusChange', [App\Http\Controllers\PickupsController::class, 'multiStatusChange'])->name('MultiStatusChange');

// 
Route::get('/confirmLocation', [App\Http\Controllers\OrderController::class, 'confirmLocation']);
Route::post('/changeOrderLocation', [App\Http\Controllers\OrderController::class, 'changeOrderLocation'])->name('changeOrderLocation');
Route::post('/cancellOrder', [App\Http\Controllers\OrderController::class, 'cancellOrder'])->name('cancellOrder');
Route::post('/setLocationConfirmSent', [App\Http\Controllers\OrderController::class, 'setLocationConfirmSent'])->name('setLocationConfirmSent');

// exel
Route::get('/add-orders-from-excel', [App\Http\Controllers\OrderController::class, 'addFromExel']);
Route::post('/importExcel', [App\Http\Controllers\OrderController::class, 'importExcel'])->name('importExcel');

Route::post('/print', [App\Http\Controllers\PrintController::class, 'print'])->name('print');

// locations  
Route::get('/clientsDeliverPrices', [App\Http\Controllers\LocationsPricesController::class, 'clientsDeliverPrices']);
Route::post('/submitLocationPrice', [App\Http\Controllers\LocationsPricesController::class, 'submitLocationPrice'])->name('submitLocationPrice');
Route::post('/submitCitiesPrice', [App\Http\Controllers\LocationsPricesController::class, 'submitCitiesPrice'])->name('submitCitiesPrice');
Route::post('/submitDistictsPrice', [App\Http\Controllers\LocationsPricesController::class, 'submitDistictsPrice'])->name('submitDistictsPrice');
Route::post('/updateDistictsPrice', [App\Http\Controllers\LocationsPricesController::class, 'updateDistictsPrice'])->name('updateDistictsPrice');
Route::get('/defaultDeliveryPrices', [App\Http\Controllers\LocationsPricesController::class, 'defaultDeliveryPrices']);
Route::post('/updatedefaultDeliveryPrices', [App\Http\Controllers\LocationsPricesController::class, 'updatedefaultDeliveryPrices'])->name('updatedefaultDeliveryPrices');
Route::post('/updateRegionPrice', [App\Http\Controllers\LocationsPricesController::class, 'updateRegionPrice'])->name('updateRegionPrice');
Route::post('/updateCityPrices', [App\Http\Controllers\LocationsPricesController::class, 'updateCityPrices'])->name('updateCityPrices');
// Locations For driver
Route::get('/driversDeliverPrices', [App\Http\Controllers\LocationsPricesController::class, 'driversDeliverPrices']);
Route::post('/defaultPrices', [App\Http\Controllers\LocationsPricesController::class, 'defaultPrices'])->name('defaultPrices');
Route::get('/driverDefaultDeliveryPrices', [App\Http\Controllers\LocationsPricesController::class, 'driverDefaultDeliveryPrices']);
Route::post('/updateDriverDefaultDeliveryPrices', [App\Http\Controllers\LocationsPricesController::class, 'updateDriverDefaultDeliveryPrices'])->name('updateDriverDefaultDeliveryPrices');
Route::post('/updateDriverRegionPrice', [App\Http\Controllers\LocationsPricesController::class, 'updateDriverRegionPrice'])->name('updateDriverRegionPrice');
Route::post('/updateDriverCityPrices', [App\Http\Controllers\LocationsPricesController::class, 'updateDriverCityPrices'])->name('updateDriverCityPrices');
