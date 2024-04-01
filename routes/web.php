<?php

use App\Http\Controllers\SectionController;
use App\Http\Controllers\ControlController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\RecommendationController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\RiskProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});
Route::get('/sections', [SectionController::class, 'index'])->name('sections');
Route::get('/controls', [ControlController::class, 'index'])->name('controls');
Route::get('/questions', [QuestionController::class, 'index'])->name('questions');
Route::get('/information', [InformationController::class, 'index'])->name('information');
Route::get('/recommendations', [RecommendationController::class, 'index'])->name('recommendations');
Route::get('/questionnaire', [QuestionController::class, 'show'])->name('questionnaire');
Route::get('/templates', [TemplateController::class, 'index'])->name('templates');
Route::get('/risk-profile-dashboard', [RiskProfileController::class, 'index'])->name('risk-profile-dashboard');
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
