<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\StatisticController;
use App\Http\Controllers\CarProductController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\AreaSpecializationController;

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

Route::apiResource('/mechanic', MechanicController::class);

Route::apiResource('/car-product', CarProductController::class);

Route::apiResource('/request', RequestController::class);

Route::apiResource('/users', UserController::class);

Route::apiResource('/areaspecialization', AreaSpecializationController::class);

Route::get('/mechanic-count', [StatisticController::class, 'mechanic']);
Route::get('/user-count', [StatisticController::class, 'user']);
Route::get('/request-count', [StatisticController::class, 'request']);
Route::get('/request-count', [StatisticController::class, 'payment']);

Route::any('/payment', [PaypalController::class, 'index']);
Route::any('/charge', [PaypalController::class, 'charge']);
Route::any('/success', [PaypalController::class, 'success']);
Route::get('/terms-and-conditions', [NotificationController::class, 'termsConditions']);
