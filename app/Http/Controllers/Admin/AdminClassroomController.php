<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\School;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AdminClassroomController extends Controller
{
    public function index(Request $request)
    {
        $classrooms = Classroom::withTrashed()
            ->has('school')
            ->with('school:id,name')
            ->when($request->search, function ($query, $search) {
                return $query->where('name', 'LIKE', '%' . $search . '%');
            })
            ->when(
                Auth::user()->school_id,
                function ($query, $schoolId) {
                    return $query->where('school_id', $schoolId);
                }
            )
            ->paginate(50);


        $schools = School::select('id', 'name')->when(
            Auth::user()->school_id,
            function ($query, $schoolId) {
                return $query->where('id', $schoolId);
            }
        )->get();

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
            'message' => 'kelas ' . $request->classroom . ' | ' . $school->name . ' telah dibuat',
        ]);
    }

    public function update(Classroom $classroom, Request $request)
    {
        $classroom->update([
            'name' => $request->name,
        ]);

        return back()->with([
            'message' => 'kelas ' . $classroom->name . ' | ' . $classroom->school->name . ' telah diubah',
        ]);
    }

    public function destroy(Classroom $classroom)
    {
        $classroom->delete();

        return back()->with([
            'message' => 'kelas ' . $classroom->name . ' | ' . $classroom->school->name . ' telah dihapus',
        ]);
    }

    public function restore($id)
    {
        Classroom::withTrashed()
            ->where('id', $id)
            ->restore();

        $classroom = Classroom::find($id);

        return back()->with([
            'message' => $classroom->name . ' berhasil direstore',
        ]);
    }
}
