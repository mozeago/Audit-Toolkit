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
use App\Http\Controllers\RiskAnalysisResponseController;
use App\Http\Controllers\GoogleLoginController;
use App\Http\Controllers\ResearchContributors;
use App\Http\Controllers\UsersSettings;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

Route::get('/', function () {
    return View('welcome');
});
Route::get('/sections', [SectionController::class, 'index'])
    ->middleware(['auth'])->name('sections');
Route::get('/controls', [ControlController::class, 'index'])
    ->middleware(['auth'])->name('controls');
Route::get('/questions', [QuestionController::class, 'index'])
    ->middleware(['auth'])->name('questions');
Route::get('/information', [InformationController::class, 'index'])
    ->middleware(['auth'])->name('information');
Route::get('/recommendations', [RecommendationController::class, 'index'])
    ->middleware(['auth'])->name('recommendations');
Route::get('/questionnaire', [QuestionController::class, 'show'])
    ->middleware(['auth'])->name('questionnaire');
Route::get('/templates-upload', [TemplateController::class, 'index'])
    ->middleware(['auth'])->name('templates-upload');
Route::get('/templates-download', [TemplateController::class, 'show'])
    ->middleware(['auth'])->name('templates-download');
Route::get('/risk-profile-dashboard', [RiskProfileController::class, 'index'])
    ->middleware(['auth'])->name('risk-profile-dashboard');
Route::get('/risk-analysis-section', [RiskSectionController::class, 'index'])
    ->middleware(['auth'])->name('risk-analysis-section');
Route::get('/risk-analysis-subsection', [RiskSubSectionController::class, 'index'])
    ->middleware(['auth'])->name('risk-analysis-subsection');
Route::get('/risk-analysis-information', [RiskInformationController::class, 'index'])
    ->middleware(['auth'])->name('risk-analysis-information');
Route::get('/risk-analysis-recommendation', [RiskRecommendationController::class, 'index'])
    ->middleware(['auth'])->name('risk-analysis-recommendation');
Route::get('/risk-analysis-questionnaire', [RiskAnalysisResponseController::class, 'index'])
    ->middleware(['auth'])->name('risk-analysis-questionnaire');
Route::get('user-settings', [UsersSettings::class, 'index'])
    ->middleware(['auth'])->name('user-settings');
Route::get('research-contributors', [ResearchContributors::class, 'index'])
    ->middleware(['auth'])->name('research-contributors');

// google login routes
Route::get('/google/redirect', [GoogleLoginController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/google/callback', [GoogleLoginController::class, 'handleGoogleCallback'])->name('google.callback');
// end google login
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
