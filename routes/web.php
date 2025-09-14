<?php

use App\Http\Middleware\Role;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController; 
use App\Http\Controllers\ScoresController;
use App\Http\Controllers\AnswersController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\InterviewsController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard',[AdminController::class,'dashboard'])->name('/admin/dashboard');
    Route::get('/admin/interviews',[InterviewsController::class,'index'])->name('/admin/interviews');
    Route::get('/admin/interviews/create',[InterviewsController::class,'create'])->name('interviews.create'); 
    Route::post('/admin/interviews/store',[InterviewsController::class,'store'])->name('interviews.store'); 
    Route::get('/admin/interviews/{id}/edit',[InterviewsController::class,'edit'])->name('interviews.edit'); 
    Route::put('/admin/interviews/{id}/update',[InterviewsController::class,'update'])->name('interviews.update'); 
    Route::delete('/admin/interviews/{id}/destroy',[InterviewsController::class,'destroy'])->name('interviews.destroy'); 
    Route::get('/admin/scores',[ScoresController::class,'index'])->name('/admin/scores');
    Route::get('/admin/scores/edit/{interviews_answers_id}',[ScoresController::class,'edit'])->name('scores.edit'); 
    Route::put('/admin/scores/{id}/update',[ScoresController::class,'update'])->name('scores.update'); 
});

Route::middleware(['auth', 'role:candidate'])->group(function () {
    Route::get('/candidate/dashboard',[CandidateController::class,'dashboard']); 
    Route::get('/admin/answers',[AnswersController::class,'index'])->name('/admin/answers');
    Route::get('/admin/answers/{id}/edit',[AnswersController::class,'edit'])->name('answers.edit'); 
    Route::put('/admin/answers/{id}/update',[AnswersController::class,'update'])->name('answers.update'); 
});
require __DIR__.'/auth.php';
