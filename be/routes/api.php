<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiUsersController;
use App\Http\Controllers\Api\ApiTestsController;
use App\Http\Controllers\Api\ApiQuestionsUserController;
use App\Http\Controllers\Api\ApiUserStatsController;

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

Route::prefix('/exams')->group(function (){
    Route::get('/index',[ApiTestsController::class,'index']);
    Route::get('/show/{id}',[ApiTestsController::class,'show']);
    Route::get('/index-user',[ApiTestsController::class,'indexUser']);
    Route::get('/get-question',[ApiTestsController::class,'getQuestion']);
    Route::post('/create',[ApiTestsController::class,'create']);
    Route::post('/edit',[ApiTestsController::class,'edit']);
    Route::get('/show-edit',[ApiTestsController::class,'showExamEdit']);
    Route::post('/delete',[ApiTestsController::class,'delete']);
    Route::get('/search',[ApiTestsController::class,'search']);
    Route::get('/filter',[ApiTestsController::class,'filter']);

});
Route::prefix('/questions')->group(function (){
    Route::get('/index',[ApiQuestionsUserController::class,'index']);
    Route::get('show',[ApiQuestionsUserController::class,'show']);
    Route::get('/filter',[ApiQuestionsUserController::class,'filter']);
    Route::get('/search',[ApiQuestionsUserController::class,'search']);
    Route::post('/create',[ApiQuestionsUserController::class,'create']);
    Route::post('/edit',[ApiQuestionsUserController::class,'edit']);
    Route::post('/delete',[ApiQuestionsUserController::class,'delete']);
});
Route::prefix('/user-stats')->group(function (){
    Route::post('/create',[ApiUserStatsController::class,'create']);
    Route::get('/index-user',[ApiUserStatsController::class,'indexUserStatsToUser']);
    /* Route::get('show',[ApiQuestionsUserController::class,'show']);
    Route::get('/filter',[ApiQuestionsUserController::class,'filter']);
    Route::get('/search',[ApiQuestionsUserController::class,'search']);
    Route::post('/create',[ApiQuestionsUserController::class,'create']);
    Route::post('/edit',[ApiQuestionsUserController::class,'edit']);
    Route::post('/delete',[ApiQuestionsUserController::class,'delete']); */
});
