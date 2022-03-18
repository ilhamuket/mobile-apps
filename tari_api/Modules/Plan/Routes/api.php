<?php

use Illuminate\Http\Request;
use Modules\Plan\Http\Controllers\PlanController;
use Modules\Plan\Http\Controllers\SubscriptionController;

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

Route::middleware('auth:api')->get('/plan', function (Request $request) {
    return $request->user();
});

Route::prefix("plan")->middleware(['auth:sanctum'])->group(function () {
    Route::get('', [PlanController::class, 'index']);
    Route::post('', [PlanController::class, 'store']);
    Route::get('summary', [PlanController::class, 'summary']);
    Route::post('activate', [PlanController::class, 'activateItems']);
    Route::post('{id}', [PlanController::class, 'activatedPlan']);
    Route::patch('{id}', [PlanController::class, 'edit']);
    Route::delete('{id}', [PlanController::class, 'inactivate']);
});
Route::prefix("subscription")->middleware(['auth:sanctum'])->group(function () {
    Route::get('', [SubscriptionController::class, 'index']);
});
