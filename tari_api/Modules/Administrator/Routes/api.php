<?php

use Illuminate\Http\Request;
use Modules\Administrator\Http\Controllers\StudioController;

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
    Route::prefix('studio')->group(function () {
        Route::get('', [StudioController::class, 'index']);
        Route::get('summary', [StudioController::class, 'summary']);
        Route::post('verifications', [StudioController::class, 'verificationStudios']);
        Route::patch('{user_id}', [StudioController::class, 'verificationStudio']);
    });
});
