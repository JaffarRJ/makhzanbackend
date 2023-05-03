<?php

use App\Http\Controllers\Api\Admin\AccountController;
use App\Http\Controllers\Api\Admin\AccountSubAccountController;
use App\Http\Controllers\Api\Admin\PartyAccountTransactionController;
use App\Http\Controllers\Api\Admin\PartyController;
use App\Http\Controllers\Api\Admin\PartyTransactionController;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Auth\ForgetController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\User\ProfileController;
use App\Http\Controllers\Api\Admin\UserController;
use App\Http\Controllers\Api\Admin\RoleController;
use App\Http\Controllers\Api\Admin\PermissionController;
use App\Http\Controllers\Api\Admin\SubAccountController;
use App\Http\Controllers\Api\Admin\TransactionController;
use Illuminate\Support\Facades\Route;

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
// Authentication Routes
Route::prefix('auth')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::post('login', 'login');
        Route::post('logout', 'logout');
    });
    Route::controller(RegisterController::class)->group(function () {
        Route::post('register', 'register');
        Route::post('verifyEmailVerificationCode', 'verifyEmailVerificationCode');
        Route::post('verificationCodeResend', 'verificationCodeResend');
    });
    Route::controller(ForgetController::class)->group(function () {
        Route::post('forgetPasswordMail', 'forgetPasswordMail');
        Route::post('verifyResetCode', 'verifyResetCode');
        Route::post('resetPassword', 'resetPassword');
    });
});

//Route::middleware(['auth:sanctum'])->prefix('admin')->group(function () {
//Route::prefix('admin')->group(function () {
    Route::prefix('profile')->group(function () {
        Route::controller(ProfileController::class)->group(function () {
            Route::get('getUser', 'getUser');
            Route::post('uploadPhoto', 'uploadPhoto');
            Route::post('storeGeneralData', 'storeGeneralData');
            Route::post('updatePassword', 'updatePassword');
        });
    });
    Route::prefix('user')->group(function () {
        Route::controller(UserController::class)->group(function () {
            Route::get('listing', 'listing');
            Route::post('detail', 'detail');
            Route::get('role/listing', 'roleListing');
            Route::post('store', 'store');
            Route::post('update', 'update');
            Route::post('delete', 'delete');
            Route::post('updateIsActive', 'updateIsActive');
            Route::post('UpdateIsShow', 'UpdateIsShow');
        });
    });
    Route::prefix('transaction')->group(function () {
        Route::controller(TransactionController::class)->group(function () {
            Route::get('listing', 'listing');
            Route::post('detail', 'detail');
            Route::post('store', 'store');
            Route::post('update', 'update');
            Route::post('delete', 'delete');
            Route::post('updateIsActive', 'updateIsActive');
            Route::post('updateIsShow', 'updateIsShow');
        });
    });
    Route::prefix('party')->group(function () {
        Route::controller(PartyController::class)->group(function () {
            Route::get('listing', 'listing');
            Route::post('detail', 'detail');
            Route::post('store', 'store');
            Route::post('update', 'update');
            Route::post('delete', 'delete');
            Route::post('updateIsActive', 'updateIsActive');
            Route::post('updateIsShow', 'updateIsShow');
        });
    });
    Route::prefix('account')->group(function () {
        Route::controller(AccountController::class)->group(function () {
            Route::get('listing', 'listing');
            Route::post('detail', 'detail');
            Route::post('store', 'store');
            Route::post('update', 'update');
            Route::post('delete', 'delete');
            Route::post('updateIsActive', 'updateIsActive');
            Route::post('updateIsShow', 'updateIsShow');
        });
    });
    Route::prefix('party_transaction')->group(function () {
        Route::controller(PartyTransactionController::class)->group(function () {
            Route::get('listing', 'listing');
            Route::post('detail', 'detail');
            Route::post('store', 'store');
            Route::post('update', 'update');
            Route::post('delete', 'delete');
            Route::post('updateIsActive', 'updateIsActive');
            Route::post('updateIsShow', 'updateIsShow');
        });
    });
    Route::prefix('party_account_transaction')->group(function () {
        Route::controller(PartyAccountTransactionController::class)->group(function () {
            Route::get('listing', 'listing');
            Route::post('detail', 'detail');
            Route::post('store', 'store');
            Route::post('update', 'update');
            Route::post('delete', 'delete');
            Route::post('updateIsActive', 'updateIsActive');
            Route::post('updateIsShow', 'updateIsShow');
        });
    });
    Route::prefix('sub_account')->group(function () {
        Route::controller(SubAccountController::class)->group(function () {
            Route::get('listing', 'listing');
            Route::post('detail', 'detail');
            Route::post('store', 'store');
            Route::post('update', 'update');
            Route::post('delete', 'delete');
            Route::post('updateIsActive', 'updateIsActive');
            Route::post('updateIsShow', 'updateIsShow');
        });
    });
    Route::prefix('account_sub_account')->group(function () {
        Route::controller(AccountSubAccountController::class)->group(function () {
            Route::get('listing', 'listing');
            Route::post('detail', 'detail');
            Route::post('store', 'store');
            Route::post('update', 'update');
            Route::post('delete', 'delete');
            Route::post('updateIsActive', 'updateIsActive');
            Route::post('updateIsShow', 'updateIsShow');
        });
    });
    Route::prefix('role')->group(function () {
        Route::controller(RoleController::class)->group(function () {
            Route::get('listing', 'listing');
            Route::post('detail', 'detail');
            Route::post('store', 'store');
            Route::post('update', 'update');
            Route::post('delete', 'delete');
            Route::post('updateIsActive', 'updateIsActive');
            Route::post('updateIsShow', 'updateIsShow');
        });
    });
    Route::prefix('permission')->group(function () {
        Route::controller(PermissionController::class)->group(function () {
            Route::get('listing', 'listing');
            Route::post('detail', 'detail');
            Route::post('store', 'store');
            Route::post('update', 'update');
            Route::post('delete', 'delete');
            Route::post('updateIsActive', 'updateIsActive');
            Route::post('updateIsShow', 'updateIsShow');
        });
    });
//});

