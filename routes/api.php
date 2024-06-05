<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\TestController;
use App\Http\Controllers\Api\v1\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group([
    'prefix' => 'v1/',
    'as' => 'api.v1.',
    'controller' => TestController::class
], function() {
    // Testing route.
    Route::get('/ping', 'ping')->name('ping');

    Route::group([
        'middleware' => 'api',
        'as' => 'auth.',
        'controller' => AuthController::class
    ], function() {
        Route::post('/login', 'login')->name('login');
    });
});

