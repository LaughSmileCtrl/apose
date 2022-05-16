<?php

use App\Http\Controllers\Client\Student\StudentDashboardController;
use App\Http\Controllers\Client\Student\StudentModuleController;
use App\Http\Controllers\Client\Student\StudentStudyController;
use App\Http\Controllers\Client\Student\StudentTaskController;
use App\Http\Controllers\Client\Teacher\TeacherDashbordController;
use App\Http\Controllers\Client\Teacher\TeacherClassroomController;
use App\Http\Controllers\Client\Teacher\TeacherConversationController;
use App\Http\Controllers\Client\Teacher\TeacherModuleController;
use App\Http\Controllers\Client\Teacher\TeacherTaskController;
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

Route::name('teacher.')
    ->prefix('/teacher')
    ->middleware(['auth', 'verified', 'teacher'])
    ->group(function () {
        Route::get('/dashboard', [TeacherDashbordController::class, 'index'])
            ->name('dashboard');

        Route::get('/classroom', [TeacherClassroomController::class, 'index'])
            ->name('classroom.index');

        Route::get('/classroom/{id}/study/{studyId}', [TeacherClassroomController::class, 'show'])
            ->name('classroom.show');

        Route::get('/study/{studyId}/module', [TeacherModuleController::class, 'index'])
            ->name('module.index');

        Route::post('/study/{studyId}/module', [TeacherModuleController::class, 'store'])
            ->name('module.store');

        Route::get('/study/{studyId}/module/{moduleId}', [TeacherModuleController::class, 'show'])
            ->name('module.show');

        Route::delete('/study/{studyId}/module/{moduleId}', [TeacherModuleController::class, 'destroy'])
            ->name('module.destroy');

        Route::get('/study/{studyId}/task', [TeacherTaskController::class, 'index'])
            ->name('task.index');

        Route::post('/study/{studyId}/task', [TeacherTaskController::class, 'store'])
            ->name('task.store');

        Route::get('/study/{studyId}/task/{taskId}', [TeacherTaskController::class, 'show'])
            ->name('task.show');

        Route::delete('/study/{studyId}/task/{taskId}', [TeacherTaskController::class, 'destroy'])
            ->name('task.destroy');

        Route::get('/task/{taskId}/student/{studentId}', [StudentTaskController::class, 'show'])
            ->name('task.student');

        Route::post('/study/{studyId}/conversation', [TeacherConversationController::class, 'store'])
            ->name('conversation.store');

    });


Route::name('student.')
    ->prefix('/student')
    ->middleware(['auth', 'verified', 'student'])
    ->group(function () {
        Route::get('/dashboard', [StudentDashboardController::class, 'index'])
            ->name('dashboard');

        Route::get('/study', [StudentStudyController::class, 'index'])
            ->name('study.index');

        Route::get('/study/{studyId}', [StudentStudyController::class, 'show'])
            ->name('study.show');

        Route::get('/study/{studyId}/task', [StudentTaskController::class, 'index'])
            ->name('task.index');

        Route::post('/study/{studyId}/task/{taskId}', [StudentTaskController::class, 'store'])
            ->name('task.store');

        Route::get('/study/{studyId}/module', [StudentModuleController::class, 'index'])
            ->name('module.index');

        Route::get('/study/{studyId}/module/{moduleId}', [StudentModuleController::class, 'show'])
            ->name('module.show');
    });


Route::get('/task', function () {
    return Inertia::render('Task');
})->name('task');


Route::get('/module', function () {
    return Inertia::render('Module');
})->name('module');

Route::get('/detail-study', function () {
    return Inertia::render('DetailStudy');
})->name('detail-study');

require __DIR__ . '/auth.php';
