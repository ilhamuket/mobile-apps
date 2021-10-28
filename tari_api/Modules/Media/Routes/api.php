<?php

use Illuminate\Http\Request;
// use Illuminate\Routing\Route;
use Modules\Classes\Http\Controllers\ClassesController;
use Modules\Media\Http\Controllers\ArticleController;
use Modules\Media\Http\Controllers\ImgAllController;
use Modules\Media\Http\Controllers\MediaController;
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

    Route::get('article', [ArticleController::class, 'index']);
    Route::post('article', [ArticleController::class, 'store']);
    Route::get('article/{id}', [ArticleController::class, 'show']);
    Route::patch('article/{id}', [ArticleController::class, 'update']);
    Route::delete('article/{id}', [ArticleController::class, 'destroyById']);
    Route::post('article/deletes', [ArticleController::class, 'destroy']);
    Route::post('article/approves', [ArticleController::class, 'approves']);
    Route::patch('article/approve/{id}', [ArticleController::class, 'approveById']);

    Route::prefix('all')->group(function () {
        Route::post('', [ImgAllController::class, 'store']);
    });
});

Route::prefix('summary')->middleware(['auth:sanctum'])->group(function () {
    Route::get('category', [MediaController::class, 'summary']);
});