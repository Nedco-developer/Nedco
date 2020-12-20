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

Route::get('/clear-cache', function() {
    $exitCode = \Artisan::call('cache:clear');
    return $exitCode;
});

Route::post('/login', [App\Http\Controllers\Api\AuthController::class, 'login']);
Route::post('/user_register', [App\Http\Controllers\Api\AuthController::class, 'register']);
Route::post('/forgotPassword', [App\Http\Controllers\Api\AuthController::class, 'forgotPassword']);
Route::post('/verifyForgetPassword', [App\Http\Controllers\Api\AuthController::class, 'verifyForgetPassword']);
Route::post('/changePassword', [App\Http\Controllers\Api\AuthController::class, 'changePassword']);

Route::middleware('auth:api')->group(function () {
    Route::get('/user', [App\Http\Controllers\Api\AuthController::class, 'getUser']);
    Route::post('/update_profile', [App\Http\Controllers\Api\AuthController::class, 'update_profile']);
    Route::get('/getStatistics', [App\Http\Controllers\Api\UserController::class, 'getStatistics']);
    Route::get('/getLocations', [App\Http\Controllers\Api\UserController::class, 'getLocations']);
    Route::get('/getCities', [App\Http\Controllers\Api\UserController::class, 'getCities']);
    Route::get('/getDistricts', [App\Http\Controllers\Api\UserController::class, 'getDistricts']);
    // Client
    Route::get('/getClientStatistics', [App\Http\Controllers\Api\ClientController::class, 'getClientStatistics']);
    Route::get('/getClientHomeStatistics', [App\Http\Controllers\Api\ClientController::class, 'getClientHomeStatistics']);
    Route::get('/getDeliveryPrice', [App\Http\Controllers\Api\ClientController::class, 'getDeliveryPrice']);
    // Driver 
    Route::get('/getDriverStatistics', [App\Http\Controllers\Api\DriverController::class, 'getDriverStatistics']);
    Route::get('/getDriverHomeStatistics', [App\Http\Controllers\Api\DriverController::class, 'getDriverHomeStatistics']);
    Route::get('/getAllDrivers', [App\Http\Controllers\Api\DriverController::class, 'getAllDrivers']);
    Route::get('/getDriver', [App\Http\Controllers\Api\DriverController::class, 'getDriver']);
    Route::get('/getDriverUpcoming', [App\Http\Controllers\Api\DriverController::class, 'getDriverUpcoming']);
    // Dispatcher
    Route::get('/getDisptcherStatistics', [App\Http\Controllers\Api\DisptcherController::class, 'getDisptcherStatistics']);
    Route::get('/getDisptcherHomeStatistics', [App\Http\Controllers\Api\DisptcherController::class, 'getDisptcherHomeStatistics']);
    // 
    Route::get('/getPickUpStatistics', [App\Http\Controllers\Api\PickUpController::class, 'getPickUpStatistics']);
    // Orders
    Route::post('/addOrder', [App\Http\Controllers\Api\OrdersController::class, 'addOrder']);
    Route::post('/changeOrderStatus', [App\Http\Controllers\Api\OrdersController::class, 'changeOrderStatus']);
    Route::post('/assignOrder', [App\Http\Controllers\Api\OrdersController::class, 'assignOrder']);
    Route::post('/getSingleOrder', [App\Http\Controllers\Api\OrdersController::class, 'getSingleOrder']);
    Route::post('/getSingleOrderByBarcod', [App\Http\Controllers\Api\OrdersController::class, 'getSingleOrderByBarcod']);
    // Messages
    Route::get('/getMessages', [App\Http\Controllers\Api\MessagesController::class, 'getMessages']);
    Route::post('/sendMessage', [App\Http\Controllers\Api\MessagesController::class, 'saveMessage']);
    // Notificaons 
    Route::get('/getNotifications', [App\Http\Controllers\Api\NotificationsController::class, 'getNotifications']);
    Route::post('/updateToIsSeen', [App\Http\Controllers\Api\NotificationsController::class, 'updateToIsSeen']);
    Route::post('/markAllAsRead', [App\Http\Controllers\Api\NotificationsController::class, 'markAllAsRead']);
    // Logs
    Route::get('/orderLogs', [App\Http\Controllers\Api\orderLogs::class, 'orderLogs']);
    Route::post('/addLog', [App\Http\Controllers\Api\OrdersLogsController::class, 'addLog']);
    // pickup
    Route::post('/changePickUpOrderStatus', [App\Http\Controllers\Api\OrdersController::class, 'changePickUpOrderStatus']);
});
