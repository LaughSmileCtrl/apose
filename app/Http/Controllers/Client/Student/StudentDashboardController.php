<?php

namespace App\Http\Controllers\Client\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class StudentDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->avatar_path != null) {
            $user->avatar_path = Storage::url($user->avatar_path);
        }
        
        $classroom = $user->classroom()
            ->select('classrooms.id', 'name', 'school_id')->first();

        if ($classroom == null) {
            return redirect()->route('error-page', 
                'Mohon hubungi admin untuk menetapkan kelas anda');
        }

        $school = $classroom->school()->first();
        $studies = $classroom->studies()
            ->select('id', 'name', 'icon_path')
            ->limit(7)->get()
            ->map(function($study, $key) {
                $study->icon_path = Storage::url($study->icon_path);
                return $study;
            });

        $tasks = $user->studentTasks()
            ->wherePivot('status', 0)
            ->select('id', 'study_id', 'name', 'description','deadline')
            ->with('study:id,name')->get();

        return Inertia::render('Student/Dashboard', [
            'school' => $school->name,
            'classroom' => $classroom,
            'studies' => $studies,
            'tasks' => $tasks,  
        ]);
    }
}
