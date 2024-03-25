<?php

use App\Http\Controllers\SectionController;
use App\Http\Controllers\ControlController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});
Route::get('/sections', [SectionController::class, 'index'])->name('sections');
Route::get('/controls', [ControlController::class, 'index'])->name('controls');
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
