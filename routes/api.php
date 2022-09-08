<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API;

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

Route::controller(API\AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
});

Route::middleware('auth:api')->group(function() {
    Route::get('get-user', [API\AuthController::class, 'details']);
});
