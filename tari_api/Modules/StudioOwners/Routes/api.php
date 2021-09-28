<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
// use Illuminate\Routing\Route;
use Modules\StudioOwners\Entities\ClassesOwnerStudio;
use Modules\StudioOwners\Entities\StudioTeacher;
use Modules\StudioOwners\Entities\SubClassOwnerStudio;
use Modules\StudioOwners\Http\Controllers\ClassesOwnerStudioController;
use Modules\StudioOwners\Http\Controllers\DiscussController;
use Modules\StudioOwners\Http\Controllers\ImgClassesController;
use Modules\StudioOwners\Http\Controllers\ImgListClassController;
use Modules\StudioOwners\Http\Controllers\StudioOwnerCategoryController;
use Modules\StudioOwners\Http\Controllers\StudioOwnersController;
use Modules\StudioOwners\Http\Controllers\StudioOwnerVidioController;
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
    // Studio
    Route::prefix('studio')->group(function () {
        Route::prefix('summary')->group(function () {
            Route::get('', [StudioOwnersController::class, 'summary']);
            Route::get('reviews', [StudioOwnersController::class, 'summaryRatings']);
        });
        Route::get('me', [StudioOwnersController::class, 'meStudio']);
        Route::post('update', [StudioOwnersController::class, 'update']);
        Route::get('responses', [StudioOwnersController::class, 'response']);
    });
    // Classes
    Route::prefix('classes')->group(function () {
        Route::get('myClass', [ClassesOwnerStudioController::class, 'index']);
        Route::post('thumbnail-list', [ImgListClassController::class, 'thumbnail']);
        Route::post('create', [ClassesOwnerStudioController::class, 'store']);
        Route::post('delBroadcast', [ClassesOwnerStudioController::class, 'delBroadcast']);
        Route::post('approveBroadcast', [ClassesOwnerStudioController::class, 'approvedBroadcast']);
        Route::post('thumbnail', [ImgClassesController::class, 'thumbnail']);
        Route::post('change-thumbnail', [ImgClassesController::class, 'changeThumbnail']);
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
        Route::post('deletes', [StudioTeacherController::class, 'deletedBroadCast']);
        Route::post('approved', [StudioTeacherController::class, 'approvedBroadcast']);
        Route::patch('edit/{id}', [StudioTeacherController::class, 'update']);
        Route::delete('delete/{id}', [StudioTeacherController::class, 'destroy']);
        Route::prefix('summary')->group(function () {
            Route::get('', [StudioTeacherController::class, 'summary']);
        });
    });

    Route::prefix('vidio')->group(function () {
        Route::get('', [StudioOwnerVidioController::class, 'index']);
        Route::post('', [StudioOwnerVidioController::class, 'store']);
        Route::delete('{id}', [StudioOwnerVidioController::class, 'destroy']);
        Route::post('go-publish', [StudioOwnerVidioController::class, 'goPublish']);
        Route::post('deletes', [StudioOwnerVidioController::class, 'delBroadcast']);
        Route::prefix('summary')->group(function () {
            Route::get('', [StudioOwnerVidioController::class, 'summary']);
        });
    });

    Route::prefix('categories')->group(function () {
        Route::get('', [StudioOwnerCategoryController::class, 'index']);
        Route::post('', [StudioOwnerCategoryController::class, 'store']);
    });

    Route::prefix('discusses')->group(function () {
        Route::get('/index', [DiscussController::class, 'index']);
        Route::post('/replies', [DiscussController::class, 'replies']);
        Route::delete('/{id}', [DiscussController::class, 'destroy']);
    });
});