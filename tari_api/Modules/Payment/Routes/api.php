<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Modules\Administrator\Http\Controllers\ChartController;
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
    Route::get('', [PaymentController::class, 'index']);
    Route::get('summary', [PaymentController::class, 'summary']);
    Route::prefix('chart')->group(function () {
        Route::get('', [ChartController::class, 'index']);
    });
    Route::post('verification-live', [PaymentController::class, 'verificationPaidLive']);
    Route::post('pay-live/{id}', [PaymentController::class, 'payLive']);
    Route::post('pay-video/{id}', [PaymentController::class, 'payVideo']);
    Route::post(
        'photo/{id}',
        [PaymentController::class, 'sendProof']
    );
    Route::post(
        'photo/{id}/video',
        [PaymentController::class, 'sendProofVideo']
    );
    Route::post('transfer/{id}', [PaymentController::class, 'transferToStudio']);
    Route::delete('delete/{id}', [PaymentController::class, 'deletePayment']);
    Route::patch('update/{id}', [PaymentController::class, 'updatePayment']);
});
