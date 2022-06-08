<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\ClassroomStudent;
use App\Models\School;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AdminStudentController extends Controller
{
    public function index(Request $request)
    {
        $users = User::select('id', 'name', 'email', 'school_id')
            ->when(
                Auth::user()->school_id,
                function ($query, $schoolId) {
                    return $query->where('school_id', $schoolId);
                }
            )
            ->when($request->search, function($query, $search) {
                return $query->where('email', 'LIKE', '%'.$search.'%');
            })
            ->role('student')
            ->with([
                'classroom:classrooms.id,name'
            ])
            ->paginate(50);
    
        $schools = School::select('id', 'name')
            ->pluck('name', 'id');
        
        $classroomsBySchool = School::with('classrooms:id,name,school_id')->get()
            ->pluck('classrooms', 'id');

        return Inertia::render('Admin/Student/Student', [
            'users' => $users,
            'schools' => $schools,
            'classroomsBySchool' => $classroomsBySchool,
        ]);
    }

    public function update($user, Request $request)
    {
        $user = User::find($user);

        $user->studentTasks()->delete();

        ClassroomStudent::updateOrCreate(
            ['user_id' => $user->id],
            ['classroom_id' => $request->classroom]
        );

        return back()->with([
            'message' => $user->name.' berhasil diatur',
        ]);
    }
}
