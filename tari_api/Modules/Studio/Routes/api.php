<?php

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Modules\Studio\Http\Controllers\CommentStudioVidioController;
use Modules\Studio\Http\Controllers\ImagesStudioController;
use Modules\Studio\Http\Controllers\StudioArticleController;
use Modules\Studio\Http\Controllers\StudioClassController;
use Modules\Studio\Http\Controllers\StudioController;
use Modules\Studio\Http\Controllers\StudioVidioController;

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

Route::prefix('studio')->middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('', [StudioController::class, 'index']);
    Route::post('', [StudioController::class, 'store']);
    Route::patch('{id}', [StudioController::class, 'update']);
    Route::patch('', [StudioController::class, 'destroy']);
    Route::patch('{id}', [StudioController::class, 'approveStudio']);
    Route::post('approve', [StudioController::class, 'studioApprove']);
    Route::delete('{id}', [StudioController::class, 'destroyById']);
    Route::get('{id}', [StudioController::class, 'show']);
    // Users
    Route::get('u/{slug}', [StudioController::class, 'bySlug']);

    // Studio Vidio
    Route::post('vidio', [StudioVidioController::class, 'store']);
    Route::get('vidio/index', [StudioVidioController::class, 'index']);
    Route::get('vidio/auto-play', [StudioVidioController::class, 'autoPlay']);
    Route::get('vidio/list-vidio', [StudioVidioController::class, 'listVidio']);

    // Commnents Studio Vidio
    Route::get('comments/index', [CommentStudioVidioController::class, 'index']);
    Route::post('comments/post', [CommentStudioVidioController::class, 'store']);
    // Child
    Route::get('comments/index/child', [CommentStudioVidioController::class, 'chidlIndex']);


    Route::prefix('u')->group(function () {
        // article
        Route::get('article/{slug}', [StudioArticleController::class, 'index']);
        // describtion Classes
        Route::get('class/describe/{slug}', [StudioClassController::class, 'index']);
        Route::post('class/describe/post', [StudioClassController::class, 'store']);
    });


    // files
    Route::post('files/thumbnail', [ImagesStudioController::class, 'thumbnail']);
    Route::post('files', [ImagesStudioController::class, 'store']);
    Route::get('files/index', [ImagesStudioController::class, 'index']);
});