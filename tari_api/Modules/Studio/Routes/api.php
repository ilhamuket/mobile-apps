<?php

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
// use Illuminate\Routing\Route;
use Modules\Studio\Entities\ClassesScheduleStudio;
use Modules\Studio\Entities\StudioClass;
use Modules\Studio\Http\Controllers\ClassesScheduleStudioController;
use Modules\Studio\Http\Controllers\CommentStudioVidioController;
use Modules\Studio\Http\Controllers\FollowStudioController;
use Modules\Studio\Http\Controllers\ImagesStudioController;
use Modules\Studio\Http\Controllers\LikeStudioController;
use Modules\Studio\Http\Controllers\RoomController;
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

Route::prefix('studio')->middleware(['auth:sanctum'])->group(function () {
    Route::get('', [StudioController::class, 'index']);
    Route::post('', [StudioController::class, 'store']);
    Route::patch('', [StudioController::class, 'destroy']);
    Route::get('populer', [StudioController::class, 'mostPopuler']);
    Route::post('approve', [StudioController::class, 'studioApprove']);
    // u
    Route::prefix('u')->group(function () {
        // classes 
        Route::get('classes', [StudioClassController::class, 'indexClasses']);
        // describtion Classes
        Route::get('classes/populer', [StudioClassController::class, 'populer']);
        Route::post('class/describe/post', [StudioClassController::class, 'store']);
        Route::get('class/describe/{slug}', [StudioClassController::class, 'index']);
        // Schedules Classes
        Route::get('class/schedules/{class_id}', [ClassesScheduleStudioController::class, 'index']);
        // Following
        Route::post('following/{slug}', [FollowStudioController::class, 'following']);
        Route::post('unfollow/{slug}', [FollowStudioController::class, 'unFollow']);
        // Likes
        Route::post('likes/{slug}', [LikeStudioController::class, 'likes']);
        Route::post('unlike/{slug}', [LikeStudioController::class, 'unlike']);
        // article
        Route::get('article/{slug}', [StudioArticleController::class, 'index']);
        Route::get('class/{studio_slug}/{slug}', [StudioClassController::class, 'indexBySlug']);
    });
    // Rooms
    Route::prefix('rooms')->group(function () {
        Route::get('', [RoomController::class, 'index']);
        Route::post('', [RoomController::class, 'store']);
    });
    // files
    Route::post('files/thumbnail', [ImagesStudioController::class, 'thumbnail']);
    Route::post('files', [ImagesStudioController::class, 'store']);
    Route::get('files/index', [ImagesStudioController::class, 'index']);
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
    Route::patch('{id}', [StudioController::class, 'update']);
    Route::patch('{id}', [StudioController::class, 'approveStudio']);
    Route::delete('{id}', [StudioController::class, 'destroyById']);
    Route::get('{id}', [StudioController::class, 'show']);
    // Users
    Route::get('u/{slug}', [StudioController::class, 'bySlug']);
});