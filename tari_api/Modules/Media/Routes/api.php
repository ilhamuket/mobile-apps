<?php

use Illuminate\Http\Request;
use Modules\Classes\Http\Controllers\ClassesController;
use Modules\Media\Http\Controllers\PostController;
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

Route::middleware('auth:api')->get('/media1', function (Request $request) {
    return $request->user();
});

Route::prefix('media')->middleware(['auth:sanctum'])->group(function () {
    Route::get('post', [PostController::class, 'index']);
    Route::post('post', [PostController::class, 'store']);
    Route::get('class', [ClassesController::class, 'store']);
});