<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
// use Illuminate\Routing\Route;
use Modules\StudioOwners\Entities\ClassesOwnerStudio;
use Modules\StudioOwners\Entities\StudioTeacher;
use Modules\StudioOwners\Entities\SubClassOwnerStudio;
use Modules\StudioOwners\Entities\UserHaveClass;
use Modules\StudioOwners\Http\Controllers\BankAccountController;
use Modules\StudioOwners\Http\Controllers\CartClassController;
use Modules\StudioOwners\Http\Controllers\CategoryImgController;
use Modules\StudioOwners\Http\Controllers\ClassesOwnerStudioController;
use Modules\StudioOwners\Http\Controllers\DiscussController;
use Modules\StudioOwners\Http\Controllers\FormRegisterController;
use Modules\StudioOwners\Http\Controllers\FormRegisterEnsiklovideoController;
use Modules\StudioOwners\Http\Controllers\ImagesStudioController;
use Modules\StudioOwners\Http\Controllers\ImgClassesController;
use Modules\StudioOwners\Http\Controllers\ImgListClassController;
use Modules\StudioOwners\Http\Controllers\InstructorProfileVidioController;
use Modules\StudioOwners\Http\Controllers\ReviewOwnerController;
use Modules\StudioOwners\Http\Controllers\StudioClassVidioController;
use Modules\StudioOwners\Http\Controllers\StudioOwnerCategoryController;
use Modules\StudioOwners\Http\Controllers\StudioOwnersController;
use Modules\StudioOwners\Http\Controllers\StudioOwnerVidioController;
use Modules\StudioOwners\Http\Controllers\StudioTeacherController;
use Modules\StudioOwners\Http\Controllers\SubClassOwnerStudioController;
use Modules\StudioOwners\Http\Controllers\UserAndStudioController;
use Modules\StudioOwners\Http\Controllers\UserHaveClassController;
use Modules\User\Entities\Role;

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
    // Student have Class
    Route::prefix('have-class')->group(function () {
        Route::get('user', [UserHaveClassController::class, 'userHasClass']);
        Route::prefix('summary')->group(function () {
            Route::get('', [UserHaveClassController::class, 'summary']);
        });
        Route::post('send-reviews', [UserHaveClassController::class, 'sendAReviews']);
        Route::get('{id}', [UserHaveClassController::class, 'index']);
        // classes has user
        Route::get('student/{keyword}/class', [UserHaveClassController::class, 'classHasUser']);
        Route::post('student/absent', [UserHaveClassController::class, 'absent']);
        // Summary
    });
    // Form Register
    Route::prefix('form-register')->group(function () {
        Route::post('', [FormRegisterController::class, 'store']);
        Route::post('video', [FormRegisterEnsiklovideoController::class, 'store']);
        Route::get('{id}', [FormRegisterController::class, 'show']);
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
        Route::get('summary', [ClassesOwnerStudioController::class, 'summary']);
        Route::post('change-list', [ImgListClassController::class, 'change']);
        Route::patch('update/{id}', [ClassesOwnerStudioController::class, 'update']);
        Route::delete('destroy/{id}', [ClassesOwnerStudioController::class, 'destroy']);
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
        Route::get('{slug}', [StudioTeacherController::class, 'show']);
        Route::post('', [StudioTeacherController::class, 'store']);
        Route::post('deletes', [StudioTeacherController::class, 'deletedBroadCast']);
        Route::post('approved', [StudioTeacherController::class, 'approvedBroadcast']);
        Route::prefix('summary')->group(function () {
            Route::get('index', [StudioTeacherController::class, 'summary']);
        });
        Route::prefix('file')->group(function () {
            Route::post('', [StudioTeacherController::class, 'uploadImg']);
            Route::post('{id}', [StudioTeacherController::class, 'changeImg']);
        });
        Route::prefix('vidio-profile')->group(function () {
            Route::post('create', [InstructorProfileVidioController::class, 'store']);
            Route::post('approved', [InstructorProfileVidioController::class, 'approvedItems']);
            Route::post('destroy', [InstructorProfileVidioController::class, 'destroyArr']);
            Route::post('create-vidio-profile', [InstructorProfileVidioController::class, 'storeVidioProfile']);
            Route::patch('{id}', [InstructorProfileVidioController::class, 'update']);
            Route::delete('{id}', [InstructorProfileVidioController::class, 'destroy']);
            Route::patch('hidden/{id}', [InstructorProfileVidioController::class, 'deactive']);
            Route::patch('approve/{id}', [InstructorProfileVidioController::class, 'approvedById']);
            Route::get('instructor/{slug}', [InstructorProfileVidioController::class, 'index']);
            Route::prefix('summary')->group(function () {
                Route::get('{slug}', [InstructorProfileVidioController::class, 'summary']);
            });
        });
        Route::patch('edit/{id}', [StudioTeacherController::class, 'update']);
        Route::patch('deactive/{id}', [StudioTeacherController::class, 'deactive']);
        Route::delete('delete/{id}', [StudioTeacherController::class, 'destroy']);
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
        Route::post('delete', [StudioOwnerCategoryController::class, 'deleteAll']);
        Route::post('approve', [StudioOwnerCategoryController::class, 'approvedAll']);
        Route::get('summary', [StudioOwnerCategoryController::class, 'summary']);
        Route::post('thumbnail', [CategoryImgController::class, 'thumbnail']);
        Route::post('change-thumbnail', [CategoryImgController::class, 'changeThumbnail']);
        Route::patch('update/{id}', [StudioOwnerCategoryController::class, 'update']);
        Route::patch('approve/{id}', [StudioOwnerCategoryController::class, 'approve']);
        Route::delete('delete/{id}', [StudioOwnerCategoryController::class, 'destroy']);
    });

    Route::prefix('user-and-studio')->group(function () {
        Route::get('summary/{studio_id}', [UserAndStudioController::class, 'summary']);
        Route::get('{studio_id}', [UserAndStudioController::class, 'studioHasUser']);
    });

    Route::prefix('discusses')->group(function () {
        Route::get('/index', [DiscussController::class, 'index']);
        Route::post('/replies', [DiscussController::class, 'replies']);
        Route::post('/delete', [DiscussController::class, 'deleteAll']);
        Route::post('/hide', [DiscussController::class, 'toHide']);
        Route::delete('/{id}', [DiscussController::class, 'destroy']);
    });

    Route::prefix('reviews')->group(function () {
        Route::get('/', [ReviewOwnerController::class, 'index']);
        Route::post('/', [ReviewOwnerController::class, 'store']);
        Route::post('/delete', [ReviewOwnerController::class, 'deleteAll']);
        Route::post('/hide', [ReviewOwnerController::class, 'hide']);
        Route::post('/show', [ReviewOwnerController::class, 'show']);
        Route::delete('/{id}', [ReviewOwnerController::class, 'destroy']);
        Route::get('summary-class/{class_id}', [ReviewOwnerController::class, 'summaryByClass']);
        Route::post('reply/{id}', [ReviewOwnerController::class, 'replyReviewsClassVidio']);
    });

    Route::prefix('class-vidio')->group(function () {
        Route::post('', [StudioClassVidioController::class, 'store']);
        Route::get('', [StudioClassVidioController::class, 'index']);
        Route::post('publish', [StudioClassVidioController::class, 'setPublish']);
        Route::post('delete', [StudioClassVidioController::class, 'deleteBroadcast']);
        Route::patch('{id}', [StudioClassVidioController::class, 'update']);
        Route::patch('hidden/{id}', [StudioClassVidioController::class, 'deactive']);
        Route::delete('{id}', [StudioClassVidioController::class, 'destroy']);
        Route::prefix('summary')->group(function () {
            Route::get('', [StudioClassVidioController::class, 'summary']);
        });
    });

    Route::prefix('files')->group(function () {
        Route::post('', [ImagesStudioController::class, 'storeThumbnail']);
        Route::post('update', [ImagesStudioController::class, 'update']);
    });

    Route::prefix('bank-account')->group(function () {
        Route::get('', [BankAccountController::class, 'index']);
        Route::post('', [BankAccountController::class, 'store']);
        Route::post('activated', [BankAccountController::class, 'activated']);
        Route::delete('{id}', [BankAccountController::class, 'destroy']);
        Route::patch('{id}', [BankAccountController::class, 'update']);
    });

    Route::prefix('cart')->group(function () {
        Route::get('', [CartClassController::class, 'index']);
        Route::get('summary', [CartClassController::class, 'summary']);
    });
});
