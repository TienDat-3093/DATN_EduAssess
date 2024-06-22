<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiUsersController;
use App\Http\Controllers\Api\AuthController;

/* Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum'); */

Route::group(['middleware' => 'api'], function ($router) {
    Route::post('login', [ApiUsersController::class, 'login']);
    Route::post('register',[ApiUsersController::class, 'register']);
});
Route::middleware(['auth:api'])->group(function () {
    Route::post('logout', [ApiUsersController::class, 'logout']);
    Route::post('refresh', [ApiUsersController::class, 'refresh']);
    Route::post('profile', [ApiUsersController::class, 'profile']);
});


/* Route::group([
    'middleware' => 'api',
], function ($router) {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');
    Route::post('/refresh', [AuthController::class, 'refresh'])->middleware('auth:api');
    Route::post('/profile', [AuthController::class, 'profile'])->middleware('auth:api');
}); */
