<?php

use Illuminate\Http\Request;
use Modules\Auth\Http\Controllers\AuthController;
use Modules\Studio\Http\Controllers\ImagesStudioController;
use Modules\User\Http\Controllers\ImageUserController;
use Modules\User\Http\Controllers\PasswordResetController;
use Modules\User\Http\Controllers\RoleController;
use Modules\User\Http\Controllers\UserController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('user')->middleware(['auth:sanctum'])->group(function () {
    Route::get('roles', [RoleController::class, 'index']);
    Route::post('roles', [RoleController::class, "store"]);

    Route::get('', [UserController::class, 'index']);
    Route::get('me', [UserController::class, 'me']);
    Route::get('indexAll', [UserController::class, 'indexAll'])->middleware('permission:see_users|free');
    Route::patch('changepassword', [AuthController::class, 'changePassword']);
    Route::post('img', [ImageUserController::class, 'thumbnail']);
    Route::post('change-thumbnail', [ImageUserController::class, 'changeThumbnail']);
    Route::patch('{id}', [UserController::class, 'update']);

    Route::get('summary', [UserController::class, 'summary']);
});