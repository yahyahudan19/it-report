<?php

use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserControllers;
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

    Route::get('/assessment/my', [AssessmentController::class,'index'])->name('assessment.index');
    Route::post('/assessment/store', [AssessmentController::class,'store'])->name('assessment.store');
    Route::resource('assessment', AssessmentController::class);
    
    Route::get('/assessment/hou', [AssessmentController::class,'index_hou'])->name('assessment.index.hou');

    Route::get('/users', [UserControllers::class,'index'])->name('users.index');
    Route::post('/users/store', [UserControllers::class,'store'])->name('users.store');
    Route::get('/users/check-username', [UserControllers::class, 'checkUsername'])->name('users.checkUsername');
    Route::get('/users/{id}/edit', [UserControllers::class, 'edit']);
    Route::put('/users/{id}', [UserControllers::class, 'update']);
    Route::delete('/users/{id}', [UserControllers::class, 'destroy']);

    Route::get('/get-positions/{departmentId}', [UserControllers::class, 'getPositionsByDepartment']);


    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__.'/auth.php';
