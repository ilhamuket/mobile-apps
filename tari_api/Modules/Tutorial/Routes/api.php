<?php

use Illuminate\Http\Request;
use Modules\Tutorial\Http\Controllers\TutorialController;

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

Route::middleware('auth:api')->get('/tutorial', function (Request $request) {
    return $request->user();
});

Route::prefix('tutorial-free')->group(function () {
    Route::post('video', [TutorialController::class, 'store'])->middleware(['auth:sanctum']);
    Route::get('video-auto', [TutorialController::class, 'autoPlay']);
    Route::get('list-video', [TutorialController::class, 'listTutorial']);
    // Route::get('scan', [TutorialController::class, 'scanMe']);
    Route::patch('video/{id}', [TutorialController::class, 'update'])->middleware(['auth:sanctum']);
    // Route::get('video', [TutorialController::class, 'listTutorial'])->middleware(['auth:sanctum']);
});
