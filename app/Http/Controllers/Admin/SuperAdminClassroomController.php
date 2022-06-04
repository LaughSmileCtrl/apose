<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\School;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SuperAdminClassroomController extends Controller
{
    public function index(Request $request)
    {
        $classrooms = Classroom::withTrashed()
            ->has('school')
            ->with('school:id,name')
            ->when($request->search, function($query, $search) {
                return $query->where('name', 'LIKE', '%'.$search.'%')
                    ->orWhere('id', $search);
            })
            ->when($request->school_id, function($query, $schoolId) {
                return $query->whereHas('school', function (Builder $q) use ($schoolId) {
                    return $q->where('id', $schoolId);
                });
            })
            ->paginate(50);

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

    public function restore($id)
    {
        Classroom::withTrashed()
            ->where('id', $id)
            ->restore();

        $classroom = Classroom::find($id);

        return back()->with([
            'message' => $classroom->name.' berhasil direstore',
        ]);
    }
}
