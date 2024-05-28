<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionsController;
use App\Http\Controllers\UsersController;

// Route::get('/', function () {
//     return view('login');
// });
Route::get('/question', function () {
    return view('question.index');
});
/* Route::prefix('/question')->name('question.')->group(function(){
    Route::get('/',[QuestionsController::class,'index'])->name('index');
}); */
Route::middleware('guest')->group(function () {

    Route::get('/login', [UsersController::class, 'login'])->name('login');
    Route::post('/login', [UsersController::class, 'loginHandle'])->name('loginHandle');
});

Route::middleware('auth')->group(function () {

    Route::get('/logout', [UsersController::class, 'logout'])->name('logout');
    Route::get('/', [UsersController::class, 'index'])->name('dashboard.index');
});