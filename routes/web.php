<?php

use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\ReportController;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('template', 'layouts.template')
    ->middleware(['auth', 'verified'])
    ->name('template');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('/report', [ReportController::class,'index'])->name('report.index');
    Route::get('/assessment', [AssessmentController::class,'index'])->name('assessment.index');
    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__.'/auth.php';
