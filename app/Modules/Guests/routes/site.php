<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Guests\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| Guests Site Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your main "front office" application.
| Please note that this file is auto imported in the main routes file, so it will inherit the main "prefix"
| and "namespace", so don't edit it to add for example "api" as a prefix.
*/

//guest Login
Route::post('login/guests', [LoginController::class, 'login'])->middleware('api-auth');
