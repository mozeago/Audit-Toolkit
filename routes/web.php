<?php

use App\Http\Controllers\SectionController;
use App\Http\Controllers\ControlController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\RecommendationController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\RiskProfileController;
use App\Http\Controllers\RiskSectionController;
use App\Http\Controllers\RiskSubSectionController;
use App\Http\Controllers\RiskInformationController;
use App\Http\Controllers\RiskRecommendationController;
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
Route::get('/templates-download', [TemplateController::class, 'show'])->name('templates-download');
Route::get('/risk-profile-dashboard', [RiskProfileController::class, 'index'])->name('risk-profile-dashboard');
Route::get('/risk-analysis-section', [RiskSectionController::class, 'index'])->name('risk-analysis-section');
Route::get('/risk-analysis-subsection', [RiskSubSectionController::class, 'index'])->name('risk-analysis-subsection');
Route::get('/risk-analysis-information', [RiskInformationController::class, 'index'])->name('risk-analysis-information');
Route::get('/risk-analysis-recommendation', [RiskRecommendationController::class, 'index'])->name('risk-analysis-recommendation');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
