<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminClassroomController;
use App\Http\Controllers\Admin\AdminSchoolController;
use App\Http\Controllers\Admin\AdminStudentController;
use App\Http\Controllers\Admin\AdminStudyController;
use App\Http\Controllers\Admin\AdminTeacherController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Client\Student\StudentDashboardController;
use App\Http\Controllers\Client\Student\StudentModuleController;
use App\Http\Controllers\Client\Student\StudentStudyController;
use App\Http\Controllers\Client\Student\StudentTaskController;
use App\Http\Controllers\Client\Teacher\TeacherDashbordController;
use App\Http\Controllers\Client\Teacher\TeacherClassroomController;
use App\Http\Controllers\Client\Teacher\TeacherConversationController;
use App\Http\Controllers\Client\Teacher\TeacherModuleController;
use App\Http\Controllers\Client\Teacher\TeacherTaskController;
use App\Http\Controllers\ClientProfileController;
use App\Http\Controllers\ErrorController;
use Illuminate\Support\Facades\Auth;
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
    return Inertia::render('LandingPage');
})->name('home');

Route::get('/dashboard', function() {
    if (Auth::user()->hasRole('student')) {
        return redirect()->route('student.dashboard');
    } else if (Auth::user()->hasRole('teacher')) {
        return redirect()->route('teacher.dashboard');
    } else if (Auth::user()->hasRole('super-admin') 
        || Auth::user()->hasRole('admin')) {
        return redirect()->route('admin.dashboard');
    } 
    abort(403);
})->name('dashboard')->middleware(['auth']);

Route::name('teacher.')
    ->prefix('/teacher')
    ->middleware(['auth', 'verified', 'role:teacher'])
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

        Route::get('/task/{taskId}/student/{studentId}', [TeacherTaskController::class, 'showStudentTask'])
            ->name('task.student');

        Route::post('/study/{studyId}/conversation', [TeacherConversationController::class, 'store'])
            ->name('conversation.store');

    });


Route::name('student.')
    ->prefix('/student')
    ->middleware(['auth', 'verified', 'role:student'])
    ->group(function () {
        Route::get('/dashboard', [StudentDashboardController::class, 'index'])
            ->name('dashboard');

        Route::get('/study', [StudentStudyController::class, 'index'])
            ->name('study.index');

        Route::get('/study/{studyId}', [StudentStudyController::class, 'show'])
            ->name('study.show');

        Route::get('/task', [StudentTaskController::class, 'index'])
            ->name('task.index');

        Route::get('/study/{studyId}/task', [StudentTaskController::class, 'show'])
            ->name('task.show');

        Route::post('/study/{studyId}/task/{taskId}', [StudentTaskController::class, 'store'])
            ->name('task.store');

        Route::get('/study/{studyId}/module', [StudentModuleController::class, 'index'])
            ->name('module.index');

        Route::get('/study/{studyId}/module/{moduleId}', [StudentModuleController::class, 'show'])
            ->name('module.show');
    });

Route::middleware(['auth', 'verified', 'role:teacher|student'])
    ->group(function() {
        Route::get('/client/profile', [ClientProfileController::class, 'index'])
            ->name('client.profile');
        Route::put('/client/profile', [ClientProfileController::class, 'update'])
            ->name('client.profile');
    });

Route::prefix('/admin')
    ->middleware(['auth', 'verified', 'role:super-admin|admin'])
    ->group(function() {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('admin.dashboard');
        
        Route::resource('schools', AdminSchoolController::class)
            ->middleware('role:super-admin');
        
        Route::put('/schools/{id}/restore', [AdminSchoolController::class, 'restore'])
            ->name('schools.restore')
            ->middleware('role:super-admin');
        
        Route::resource('classrooms', AdminClassroomController::class);
        Route::put('/classrooms/{id}/restore', [AdminClassroomController::class, 'restore'])
            ->name('classrooms.restore');
        
        Route::resource('studies', AdminStudyController::class);
        Route::put('/studies/{id}/restore', [AdminStudyController::class, 'restore'])
            ->name('studies.restore');
        
        Route::resource('users', AdminUserController::class);
        Route::resource('teachers', AdminTeacherController::class);
        Route::resource('students', AdminStudentController::class);
    });

Route::get('/error/{message}', [ErrorController::class, 'index'])->name('error-page');

require __DIR__ . '/auth.php';
