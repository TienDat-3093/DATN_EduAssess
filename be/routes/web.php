<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionsController;

Route::get('/', function () {
    return view('dashboard');
});
Route::get('/question', function () {
    return view('question.index');
});
/* Route::prefix('/question')->name('question.')->group(function(){
    Route::get('/',[QuestionsController::class,'index'])->name('index');
}); */
