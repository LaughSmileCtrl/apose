<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\School;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $schoolCount = School::all()->count();
        $classroomCount = Classroom::when(
            Auth::user()->school_id,
            function ($query, $schoolId) {
                return $query->where('school_id', $schoolId);
            }
        )->count();

        $userCount = User::all()->when(
            Auth::user()->school_id,
            function ($query, $schoolId) {
                return $query->where('school_id', $schoolId);
            }
        )->count();
        
        $teacherCount = User::role('teacher')->when(
            Auth::user()->school_id,
            function ($query, $schoolId) {
                return $query->where('school_id', $schoolId);
            }
        )->count();
        $studentCount = User::role('student')->when(
            Auth::user()->school_id,
            function ($query, $schoolId) {
                return $query->where('school_id', $schoolId);
            }
        )->count();

        return Inertia::render('Admin/Dashboard', [
            'schoolCount' => $schoolCount,
            'classroomCount' => $classroomCount,
            'userCount' => $userCount,
            'teacherCount' => $teacherCount,
            'studentCount' => $studentCount,
        ]);
    }
}
