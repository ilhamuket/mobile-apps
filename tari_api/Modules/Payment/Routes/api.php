<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Modules\Payment\Http\Controllers\PaymentController;

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

Route::middleware('auth:api')->get('/payment', function (Request $request) {
    return $request->user();
});

Route::prefix("payments")->middleware(['auth:sanctum'])->group(function () {
    Route::post('pay', [PaymentController::class, 'store']);
});
