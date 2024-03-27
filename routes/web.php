<?php

use App\Http\Controllers\SectionController;
use App\Http\Controllers\ControlController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\RecommendationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});
Route::get('/sections', [SectionController::class, 'index'])->name('sections');
Route::get('/controls', [ControlController::class, 'index'])->name('controls');
Route::get('/questions', [QuestionController::class, 'index'])->name('questions');
Route::get('/information', [InformationController::class, 'index'])->name('information');
Route::get('/recommendations', [RecommendationController::class, 'index'])->name('recommendations');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
