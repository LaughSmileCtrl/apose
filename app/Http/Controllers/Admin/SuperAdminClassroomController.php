<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\School;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SuperAdminClassroomController extends Controller
{
    public function index()
    {
        $classrooms = Classroom::with('school:id,name')->paginate(50);
        $schools = School::all(['id', 'name']);

        return Inertia::render('Admin/Classroom/Classroom', [
            'classrooms' => $classrooms,
            'schools' => $schools,
        ]);
    }

    public function store(Request $request)
    {
        $school = School::find($request->schoolId);
        $school->classrooms()->create([
            'name' => $request->classroom,
        ]);

        return back()->with([
            'message' => 'kelas '.$request->classroom.' | '.$school->name.' telah dibuat',
        ]);
    }

    public function destroy(Classroom $classroom)
    {
        $classroom->delete();

        return back()->with([
            'message' => 'kelas '.$classroom->name.' | '.$classroom->school->name.' telah dihapus',
        ]);
    }
}
