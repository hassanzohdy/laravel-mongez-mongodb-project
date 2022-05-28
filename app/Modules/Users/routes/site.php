<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Users\Controllers\Site\UsersController;
use App\Modules\Users\Controllers\Site\UsersGroupsController;

/*
|--------------------------------------------------------------------------
| Users Site Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your main "front office" application.
| Please note that this file is auto imported in the main routes file, so it will inherit the main "prefix"
| and "namespace", so don't edit it to add for example "api" as a prefix.
*/

Route::group([
    'middleware' => ['auth:guest,customer'],
], function () {
    // Sub API routes DO NOT remove this line

    // UsersGroups
    Route::get('users-groups/{id}', [UsersGroupsController::class, 'show']);
    Route::get('users-groups', [UsersGroupsController::class, 'index']);

    // list records
    Route::get('users', [UsersController::class, 'index']);
    // one record
    Route::get('users/{id}', [UsersController::class, 'show']);
});
