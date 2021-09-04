<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Modules\StudioOwners\Entities\ClassesOwnerStudio;
use Modules\StudioOwners\Entities\SubClassOwnerStudio;
use Modules\StudioOwners\Http\Controllers\ClassesOwnerStudioController;
use Modules\StudioOwners\Http\Controllers\StudioTeacherController;
use Modules\StudioOwners\Http\Controllers\SubClassOwnerStudioController;

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

Route::prefix('owner')->middleware(['auth:sanctum'])->group(function () {
    // Classes
    Route::prefix('classes')->group(function () {
        Route::get('myClass', [ClassesOwnerStudioController::class, 'index']);
        Route::post('create', [ClassesOwnerStudioController::class, 'store']);
        Route::post('delBroadcast', [ClassesOwnerStudioController::class, 'delBroadcast']);
        Route::post('approveBroadcast', [ClassesOwnerStudioController::class, 'approvedBroadcast']);
        Route::patch('update/{id}', [ClassesOwnerStudioController::class, 'update']);
        Route::delete('destroy/{id}', [ClassesOwnerStudioController::class, 'destroy']);
        Route::get('summary', [ClassesOwnerStudioController::class, 'summary']);
    });
    Route::prefix('sub-classes')->group(function () {
        Route::get('my-sub', [SubClassOwnerStudioController::class, 'index']);
        Route::post('my-sub', [SubClassOwnerStudioController::class, 'store']);
        Route::patch('my-sub/{id}', [SubClassOwnerStudioController::class, 'update']);
        Route::delete('my-sub/{id}', [SubClassOwnerStudioController::class, 'destroy']);
        Route::post('my-sub/delestes', [SubClassOwnerStudioController::class, 'delBroadcast']);
        Route::post('my-sub/approves', [SubClassOwnerStudioController::class, 'approvedBroadcast']);
        Route::prefix('summary')->group(function () {
            Route::get('', [SubClassOwnerStudioController::class, 'summary']);
        });
    });

    Route::prefix('instructor')->group(function () {
        Route::get('', [StudioTeacherController::class, 'index']);
        Route::post('', [StudioTeacherController::class, 'store']);
    });
});