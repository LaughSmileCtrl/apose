<?php

use App\Http\Controllers\Client\Teacher\TeacherDashbordController;
use App\Http\Controllers\Client\Teacher\TeacherClassroomController;
use App\Http\Controllers\Client\Teacher\TeacherModuleController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // return Inertia::render('Welcome');
});

Route::get('/student/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('student.dashboard');

Route::name('teacher.')
    ->prefix('/teacher')
    ->middleware(['auth', 'verified', 'teacher'])
    ->group(function() {
    Route::get('/dashboard', [TeacherDashbordController::class, 'index'])
        ->name('dashboard');

    Route::get('/classroom', [TeacherClassroomController::class, 'index'])
        ->name('classroom.index');

    Route::get('/classroom/{id}/study/{studyId}', [TeacherClassroomController::class, 'show'])
        ->name('classroom.show');

    Route::get('/study/{id}/module', [TeacherModuleController::class, 'index'])
        ->name('module.index');

    Route::post('/study/{studyId}/module', [TeacherModuleController::class, 'store'])
        ->name('module.store');

    Route::get('/study/{studyId}/module/{moduleId}', [TeacherModuleController::class, 'show'])
        ->name('module.show');
    
    Route::delete('/study/{studyId}/module/{moduleId}', [TeacherModuleController::class, 'destroy'])
        ->name('module.destroy');
});

Route::get('/task', function() {
    return Inertia::render('Task');
})->name('task');

Route::get('/list-study', function() {
    return Inertia::render('ListStudy');
})->name('list-study');

Route::get('/module', function() {
    return Inertia::render('Module');
})->name('module');

Route::get('/detail-study', function() {
    return Inertia::render('DetailStudy');
})->name('detail-study');

require __DIR__.'/auth.php';

