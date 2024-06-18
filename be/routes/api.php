<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiUsersController;

/* Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum'); */

Route::group(['middleware' => 'api'], function ($router) {
    Route::post('login', [ApiUsersController::class, 'login']);
});
Route::middleware(['auth:api'])->group(function () {
    Route::post('logout', [ApiUsersController::class, 'logout']);
    Route::post('refresh', [ApiUsersController::class, 'refresh']);
    Route::post('me', [ApiUsersController::class, 'me']);
});
