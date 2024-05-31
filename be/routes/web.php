<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\QuestionsAdminController;
use App\Http\Controllers\Web\TopicsController;
use App\Http\Controllers\Web\TagsController;
use App\Http\Controllers\Web\UsersController;
use App\Models\QuestionsAdmin;

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

    Route::prefix('/question')->name('question.')->group(function(){
        Route::get('/',[QuestionsAdminController::class,'index'])->name('index');
    });
    Route::prefix('/topic')->name('topic.')->group(function(){
        Route::get('/',[TopicsController::class,'index'])->name('index');
        Route::post('/create',[TopicsController::class,'createHandle'])->name('create');
        Route::post('/edit/{id}',[TopicsController::class,'editHandle'])->name('edit');
        Route::get('/delete/{id}',[TopicsController::class,'deleteHandle'])->name('delete');
    });
    Route::prefix('/tag')->name('tag.')->group(function(){
        Route::get('/',[TagsController::class,'index'])->name('index');
        Route::post('/create',[TagsController::class,'createHandle'])->name('create');
        Route::post('/edit/{id}',[TagsController::class,'editHandle'])->name('edit');
        Route::get('/delete/{id}',[TagsController::class,'deleteHandle'])->name('delete');
    });
});
