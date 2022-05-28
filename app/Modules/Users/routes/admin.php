<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Users\Controllers\Admin\UsersController;
use App\Modules\Users\Controllers\Site\Auth\LoginController;
use App\Modules\Users\Controllers\Site\Auth\LogoutController;
use App\Modules\Users\Controllers\Admin\UsersGroupsController;
use App\Modules\Users\Controllers\Site\Auth\ResetPasswordController;
use App\Modules\Users\Controllers\Site\Auth\UpdateAccountController;
use App\Modules\Users\Controllers\Site\Auth\ForgetPasswordController;
use App\Modules\Users\Controllers\Site\Auth\VerifyResetPasswordCodeController;

/*
|--------------------------------------------------------------------------
| Users Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your admin "back office/dashboard" application.
| Please note that this file is auto imported in the main routes file, so it will inherit the main "prefix"
| and "namespace", so don't edit it to add for example "admin" as a prefix.
|
| Also, all routes have `admin.` as route name prefix so it prevents the duplicate routes conflict.
|
| If route method is set to restfulApi() then api resource is patchable therefore a PATCH handler
| method is added automatically to RestfulApiController, the additional route will be Route::patch('/module', [ControllerClass::class, 'patch'])
*/


Route::group([
    'middleware' => ['auth:guest'],
], function () {
    // db seed default admin
    Route::post('seed-user', [UsersController::class, 'seedDefaultAdmin']);
    // user login
    Route::post('login', [LoginController::class, 'login']);
    // user forget password
    Route::post('/forget-password', [ForgetPasswordController::class, 'forgetPassword']);
    // user verify account
    Route::post('/verify-code', [VerifyResetPasswordCodeController::class, 'verifyCode']);
    // user reset password
    Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword']);
});

Route::group([
    'middleware' => ['auth:admin'],
], function () {
    // Sub API routes DO NOT remove this line
    //Admin Logout
    Route::post('logout', [LogoutController::class, 'logout']);

    //Admin Update Password
    Route::post('update-password', [UpdateAccountController::class, 'updatePassword']);

    //Admin Update profile
    Route::put('update-profile', [UpdateAccountController::class, 'updateProfile']);

    //get current admin
    Route::get('me', [UpdateAccountController::class, 'me']);

    // UsersGroups
    Route::restfulApi('users-groups', UsersGroupsController::class);

    // Main API CRUD routes
    Route::restfulApi('users', UsersController::class);
});
