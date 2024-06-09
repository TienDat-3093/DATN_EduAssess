<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\QuestionsAdminController;
use App\Http\Controllers\Web\TopicsController;
use App\Http\Controllers\Web\TagsController;
use App\Http\Controllers\Web\UsersController;
use App\Http\Controllers\Web\TestsController;
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
    Route::get('/', [UsersController::class, 'dashboard'])->name('dashboard.index');

    Route::prefix('/question')->name('question.')->group(function(){
        Route::get('/',[QuestionsAdminController::class,'index'])->name('index');
        Route::post('/create',[QuestionsAdminController::class,'create'])->name('create');
        Route::get('edit/{id}',[QuestionsAdminController::class,'edit'])->name('edit');
        Route::post('edit/{id}',[QuestionsAdminController::class,'editHandle'])->name('editHandle');
        Route::post('delete/{id}',[QuestionsAdminController::class,'deleteHandle'])->name('delete');

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
    
    Route::prefix('/test')->name('test.')->group(function(){
        Route::get('/',[TestsController::class,'index'])->name('index');
        Route::get('/create',[TestsController::class,'create'])->name('create');
        Route::post('/searchQuestion',[TestsController::class,'searchQuestion'])->name('searchQuestion');
        Route::post('/create',[TestsController::class,'createHandle'])->name('createHandle');
        Route::get('/getTags/{id}',[TestsController::class,'getTags'])->name('getTags');
        Route::get('/detail/{id}',[TestsController::class,'detail'])->name('detail');
        Route::post('/edit/{id}',[TestsController::class,'edit'])->name('edit');
        Route::get('/delete/{id}',[TestsController::class,'deleteHandle'])->name('delete');
    });
    Route::prefix('/user')->name('user.')->group(function () {
        Route::get('/', [UsersController::class, 'index'])->name('index');
        Route::post('/search', [UsersController::class, 'search'])->name('search');
        Route::post('/create', [UsersController::class, 'createHandle'])->name('createHandle');
        Route::get('/getUser/{id}', [UsersController::class, 'getUser'])->name('getUser');
        Route::post('/edit/{id}', [UsersController::class, 'editHandle'])->name('editHandle');
        Route::get('/delete/{id}', [UsersController::class, 'delete'])->name('delete');
    });
});
