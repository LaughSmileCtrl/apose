<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\School;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SuperAdminDashboardController extends Controller
{
    public function index()
    {
        $schoolCount = School::all()->count();
        $classroomCount = Classroom::all()->count();
        $userCount = User::all()->count();

        return Inertia::render('Admin/Dashboard', [
            'schoolCount' => $schoolCount,
            'classroomCount' => $classroomCount,
            'userCount' => $userCount,
        ]);
    }
}
