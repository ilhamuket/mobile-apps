<?php

use Illuminate\Http\Request;
use Modules\Administrator\Http\Controllers\BankController;
use Modules\Administrator\Http\Controllers\StudioController;
use Modules\Administrator\Http\Controllers\TransactionEnsikloLiveController;
use Modules\Administrator\Http\Controllers\UserController;

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

Route::middleware('auth:api')->get('/administrator', function (Request $request) {
    return $request->user();
});

Route::prefix('administrator')->middleware(['auth:sanctum'])->group(function () {
    Route::prefix('user')->group(function () {
        Route::get('', [UserController::class, 'index']);
    });
    Route::prefix('studio')->group(function () {
        Route::get('', [StudioController::class, 'index']);
        Route::get('summary', [StudioController::class, 'summary']);
        Route::post('verifications', [StudioController::class, 'verificationStudios']);
        Route::patch('{user_id}', [StudioController::class, 'verificationStudio']);
    });
    Route::prefix('transaction')->group(function () {
        Route::prefix('ensiklo-live')->group(function () {
            Route::get('', [TransactionEnsikloLiveController::class, 'index']);
            Route::get('summary', [TransactionEnsikloLiveController::class, 'summary']);
        });
    });
    Route::prefix("bank")->group(function () {
        Route::get('', [BankController::class, 'index']);
        // Route::get('summary', [BankController::class, 'summary']);
    });
    Route::prefix('confirmation')->group(function () {
        Route::post('live/{cart_id}', [TransactionEnsikloLiveController::class, 'confirmationPaidEnsikloLive']);
        Route::post('live/{cart_id}/rejected', [TransactionEnsikloLiveController::class, 'rejectedConfirmationEnsikloLive']);
    });
});
