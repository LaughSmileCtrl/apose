<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\School;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;

class SuperAdminTeacherController extends Controller
{
    public function index()
    {
        $users = User::select('id', 'name', 'email', 'school_id')
            ->whereHas('roles', function(Builder $query) {
                $query->where('name', 'teacher');
            })
            ->with([
                'teachs:id'
            ])
            ->paginate(50);
    
        $schools = School::select('id', 'name')
            ->pluck('name', 'id');
        
        $studiesBySchool = School::select('id')
            ->with(['classrooms:id,name,school_id',
                    'classrooms.studies:id,name,classroom_id'
            ])
            ->get()
            ->pluck('classrooms', 'id')
            ->toArray();


        return Inertia::render('Admin/Teacher/Teacher', [
            'users' => $users,
            'schools' => $schools,
            'studiesBySchool' => $studiesBySchool,
        ]);
    }
}
