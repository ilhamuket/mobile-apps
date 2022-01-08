<?php

use Illuminate\Http\Request;
// use Illuminate\Routing\Route;
use Modules\Classes\Http\Controllers\ClassesController;
use Modules\Media\Http\Controllers\ArticleController;
use Modules\Media\Http\Controllers\ImgAllController;
use Modules\Media\Http\Controllers\MediaController;
use Modules\Media\Http\Controllers\PostController;
use Modules\Studio\Http\Controllers\StudioArticleController;

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

// Route::middleware('auth:api')->get('/media1', function (Request $request) {
//     return $request->user();
// });

Route::prefix('media')->middleware(['auth:sanctum'])->group(function () {
    Route::get('post', [PostController::class, 'index']);
    Route::post('post', [PostController::class, 'store']);
    Route::get('class', [ClassesController::class, 'store']);

    Route::get('category', [MediaController::class, 'index']);
    Route::post('category', [MediaController::class, 'store']);
    Route::patch('category/{id}', [MediaController::class, 'update']);
    Route::delete('category/{id}', [MediaController::class, 'destroy']);


    Route::prefix('article')->group(function () {
        Route::get('', [ArticleController::class, 'index']);
        Route::post('', [ArticleController::class, 'store']);
        Route::get('{id}', [ArticleController::class, 'show']);
        Route::patch('{id}', [ArticleController::class, 'update']);
        Route::delete('{id}', [ArticleController::class, 'destroyById']);
        Route::get('{id}/studio/{studio_slug}/{slug}', [StudioArticleController::class, 'showArticle']);
        Route::post('deletes', [ArticleController::class, 'destroy']);
        Route::post('approves', [ArticleController::class, 'approves']);
        Route::patch('approve/{id}', [ArticleController::class, 'approveById']);
    });


    Route::prefix('all')->group(function () {
        Route::post('', [ImgAllController::class, 'store']);
    });
});

Route::prefix('summary')->middleware(['auth:sanctum'])->group(function () {
    Route::get('category', [MediaController::class, 'summary']);
});
