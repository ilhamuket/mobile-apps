<?php

use Illuminate\Http\Request;
use Modules\Classes\Http\Controllers\ClassesController;
use Modules\Classes\Http\Controllers\ScheduleController;
use Modules\Classes\Http\Controllers\TheoryController;

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

// Route::middleware('auth:api')->get('/classes', function (Request $request) {
//     return $request->user();
// });

Route::prefix('classes')->middleware(['auth:sanctum'])->group(function () {
    Route::get('', [ClassesController::class, 'index']);
    Route::post('', [ClassesController::class, 'store']);
    Route::patch('{id}', [ClassesController::class, 'update']);
    Route::delete('{id}', [ClassesController::class, 'destroy']);

    Route::get('schedule', [ScheduleController::class, 'index']);
    Route::get('schedule/me', [ScheduleController::class, 'haveSchedules']);
    Route::post('schedule', [ScheduleController::class, 'store']);
    Route::get('schedule/show', [ScheduleController::class, 'autoPlay']);

    Route::get('summary', [ClassesController::class, 'summary']);
});

Route::prefix('theories')->middleware(['auth:sanctum'])->group(function () {
    Route::get('', [TheoryController::class, 'index']);
    Route::post('', [TheoryController::class, 'store']);
});