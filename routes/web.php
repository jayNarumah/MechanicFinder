<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\PayStackController;

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

Route::get('/', function () {
    return view('map');

});
Route::get('/map', function () {
    return view('route-garage');

});
Route::post('/pay/callback', [PayStackController::class, 'payCallback'])->name('pay.callback');
Route::post('/charge', [PayStackController::class, 'makePayment']);
Route::any('/payment', [PaypalController::class, 'index']);
Route::any('/verify-payment/{response}', [PayStackController::class, 'verify']);
Route::any('/charge', [PaypalController::class, 'charge']);
Route::any('/success', [PaypalController::class, 'success']);

