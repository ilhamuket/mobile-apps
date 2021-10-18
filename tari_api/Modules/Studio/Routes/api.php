<?php

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
// use Illuminate\Routing\Route;
use Modules\Studio\Entities\ClassesScheduleStudio;
use Modules\Studio\Entities\StudioClass;
use Modules\Studio\Http\Controllers\CartClassController;
use Modules\Studio\Http\Controllers\CategoryController;
use Modules\Studio\Http\Controllers\ClassesScheduleStudioController;
use Modules\Studio\Http\Controllers\CommentStudioVidioController;
use Modules\Studio\Http\Controllers\DiscussController;
use Modules\Studio\Http\Controllers\FollowStudioController;
use Modules\Studio\Http\Controllers\ImagesStudioController;
use Modules\Studio\Http\Controllers\LikeStudioController;
use Modules\Studio\Http\Controllers\ReviewController;
use Modules\Studio\Http\Controllers\RoomController;
use Modules\Studio\Http\Controllers\StudioArticleController;
use Modules\Studio\Http\Controllers\StudioClassController;
use Modules\Studio\Http\Controllers\StudioClassVidiosController;
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
        Route::get('c/search', [StudioClassController::class, 'indexSearch']);
        Route::get('classes/vidio', [StudioClassVidiosController::class, 'index']);
        Route::post('classes/vidio', [StudioClassVidiosController::class, 'store']);


        // describtion Classes
        Route::get('classes/populer', [StudioClassController::class, 'populer']);
        Route::post('class/describe/post', [StudioClassController::class, 'store']);
        Route::get('class/date', [StudioClassController::class, 'date']);
        Route::get('classes/recomendation/{studio_slug}', [StudioClassController::class, 'recomendation']);
        Route::get('class/describe/{slug}', [StudioClassController::class, 'index']);


        // Schedules Classes
        Route::get('class/schedules/{class_id}', [ClassesScheduleStudioController::class, 'index']);



        // Following
        Route::post('following/{slug}', [FollowStudioController::class, 'following']);
        Route::post('unfollow/{slug}', [FollowStudioController::class, 'unFollow']);


        // Likes
        Route::post('likes/{slug}', [LikeStudioController::class, 'likes']);
        Route::post('unlike/{slug}', [LikeStudioController::class, 'unlike']);

        // Discueess
        Route::prefix('discuss')->group(function () {
            Route::post('/', [DiscussController::class, 'store']);
            Route::get('/{slug}', [DiscussController::class, 'index']);
        });

        // article
        Route::get('article/{slug}', [StudioArticleController::class, 'index']);
        Route::get('class/{studio_slug}/{slug}', [StudioClassController::class, 'indexBySlug']);

        //  category
        Route::prefix('categories')->group(function () {
            Route::get('/', [CategoryController::class, 'index']);
            Route::get('/{name}', [CategoryController::class, 'show']);
            Route::post('/follow/{id}', [CategoryController::class, 'follow']);
            Route::post('/unfollow/{id}', [CategoryController::class, 'unfollow']);
            Route::post('/likes/{id}', [CategoryController::class, 'likes']);
        });

        // class - vidio
        Route::prefix('class-vidio')->group(function () {
            Route::get("{slug}", [StudioClassVidiosController::class, 'show']);
        });
    });
    Route::prefix('cart')->group(function () {
        Route::post('', [CartClassController::class, 'storeWistlist']);
        Route::get('', [CartClassController::class, 'index']);
    });
    Route::prefix('reviews')->group(function () {
        Route::post('class', [ReviewController::class, 'store']);
        Route::get('class/{slug}', [ReviewController::class, 'byClass']);
        Route::get('avarage/{slug}', [ReviewController::class, 'avarage']);
        Route::get('studio/{slug}', [ReviewController::class, 'reviewsStudio']);
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