<?php

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Modules\Studio\Http\Controllers\StudioController;

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

Route::middleware('auth:api')->get('/studio', function (Request $request) {
    return $request->user();
});

Route::prefix('studio')->middleware(['auth:sanctum'])->group(function () {
    Route::get('', [StudioController::class, 'index']);
    Route::post('', [StudioController::class, 'store']);
    Route::patch('{id}', [StudioController::class, 'update']);
    Route::patch('', [StudioController::class, 'destroy']);
    Route::patch('{id}', [StudioController::class, 'approveStudio']);
    Route::post('approve', [StudioController::class, 'studioApprove']);
    Route::delete('{id}', [StudioController::class, 'destroyById']);
});