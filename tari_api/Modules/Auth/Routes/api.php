<?php

use Illuminate\Http\Request;
use Modules\Auth\Http\Controllers\AuthController;
use Modules\Auth\Http\Controllers\AuthStudioController;
use Modules\User\Http\Controllers\PasswordResetController;
use Modules\User\Http\Controllers\UserController;
use Modules\User\Http\Controllers\VerificationEmailController;

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

Route::middleware('auth:api')->get('/auth', function (Request $request) {
    return $request->user();
});

Route::prefix('auth')->group(function () {
    Route::post('register/superadmin', [AuthController::class, 'registerAsSuperAdmin']);
    Route::post('register/user', [AuthController::class, 'registerForUser']);
    Route::post('register/instructor', [AuthController::class, 'registerAsInstructor']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::get('logout', [AuthController::class, 'logout'])->middleware(['auth:sanctum']);

    Route::get('verifications', [VerificationEmailController::class, 'verificationsEmail'])->middleware(['auth:sanctum']);
    Route::get('verifications/resend', [VerificationEmailController::class, 'resend'])->middleware(['auth:sanctum']);

    Route::prefix('password')->group(function () {
        Route::post('forgot', [PasswordResetController::class, 'create']);
        Route::post('reset', [PasswordResetController::class, 'reset']);
        Route::get('find/{token}', [PasswordResetController::class, 'find']);
    });

    // Owners

    Route::post('register/studio', [AuthStudioController::class, 'registerAsStudio']);
    Route::post('login/studio', [AuthController::class, 'studioLogin']);
});