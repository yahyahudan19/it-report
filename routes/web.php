<?php

use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\HandlingController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserControllers;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Models\Room;
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
    Route::post('/report/store', [ReportController::class,'store'])->name('report.store');
    Route::delete('/reports/{id}', [ReportController::class, 'destroy'])->name('reports.destroy');
    Route::post('/reports/assign', [ReportController::class, 'assign'])->name('report.assign');
    Route::get('/reports/detail/{id}', [ReportController::class, 'detail'])->name('report.detail');
    Route::put('/reports/{id}', [ReportController::class, 'update'])->name('report.update');
    
    Route::get('/handling', [HandlingController::class,'index'])->name('handling.index');
    Route::get('/handling/detail/{id}', [HandlingController::class, 'detail'])->name('handling.detail');
    Route::post('/handling/store', [HandlingController::class,'store'])->name('handling.store');
    Route::put('/handling/{id}', [HandlingController::class, 'update'])->name('handling.update');
    Route::delete('/handling/{id}', [HandlingController::class, 'destroy'])->name('handling.destroy');

    Route::delete('/assign/{id}', [ReportController::class, 'destroyAssignment'])->name('assign.destroy');

    Route::get('/assessment/my', [AssessmentController::class,'index'])->name('assessment.index');
    Route::post('/assessment/store', [AssessmentController::class,'store'])->name('assessment.store');
    Route::resource('assessment', AssessmentController::class);

    Route::get('/evaluation/my', [EvaluationController::class,'index'])->name('evaluation.index');
    
    Route::get('/evaluation/hou', [EvaluationController::class,'index_hou'])->name('evaluation.hou');
    Route::get('/assessment/hou', [AssessmentController::class,'index_hou'])->name('assessment.index.hou');

    Route::get('/users', [UserControllers::class,'index'])->name('users.index');
    Route::post('/users/store', [UserControllers::class,'store'])->name('users.store');
    Route::get('/users/check-username', [UserControllers::class, 'checkUsername'])->name('users.checkUsername');
    Route::get('/users/{id}/edit', [UserControllers::class, 'edit']);
    Route::put('/users/{id}', [UserControllers::class, 'update']);
    Route::delete('/users/{id}', [UserControllers::class, 'destroy']);

    Route::get('/get-positions/{departmentId}', [UserControllers::class, 'getPositionsByDepartment']);

    Route::get('/department', [DepartmentController::class,'index'])->name('department.index');
    Route::post('/department/store', [DepartmentController::class,'store'])->name('department.store');
    Route::post('/positions/store', [DepartmentController::class,'store_positions'])->name('positions.store');

    Route::get('/positions/hou', [DepartmentController::class,'index_hou'])->name('positions.index.hou');
    Route::get('/staff/hou', [DepartmentController::class,'staff_hou'])->name('positions.staff.hou');

    Route::get('/users', [UserControllers::class,'index'])->name('users.index');

    Route::get('/category', [CategoryController::class,'index'])->name('category.index');
    Route::post('/category/store', [CategoryController::class,'store'])->name('category.store');
    Route::get('/category/{id}', [CategoryController::class, 'show'])->name('category.show');
    Route::put('/category/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/category/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');

    Route::get('/reporters/search', [UserControllers::class, 'searchReporters'])->name('reporters.search');
    Route::get('/locations/search', [DepartmentController::class, 'searchRoom'])->name('locations.search');

    Route::get('/task/my', [TaskController::class,'index'])->name('task.index');
    Route::get('/task/hou', [TaskController::class,'index_hou'])->name('task.hou');
    Route::post('/task/store', [TaskController::class,'store'])->name('task.store');
    Route::delete('/task/{id}', [TaskController::class, 'destroy'])->name('task.destroy');
    Route::put('/task/{id}', [TaskController::class, 'update'])->name('task.update');
    Route::get('/task/my/{id}', [TaskController::class, 'detail'])->name('task.detail');
    Route::get('/task/task-by-staff/{staffId}', [TaskController::class, 'getTasksByStaff'])->name('task.getTasksByStaff');
    Route::delete('/task/attachment/{id}', [TaskController::class, 'destroy_attachment'])->name('task.attachment.destroy');




    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__.'/auth.php';
