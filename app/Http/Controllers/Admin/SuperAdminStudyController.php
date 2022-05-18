<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\School;
use App\Models\Study;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SuperAdminStudyController extends Controller
{
    public function index()
    {
        $schools = School::select('id', 'name')->get();

        $classrooms = Classroom::select('id', 'name', 'school_id')
            ->get()
            ->mapToGroups(function($classroom, $key) {
                return [
                    $classroom['school_id'] => $classroom,
                ];
            })
            ->all();
        
        $studies = Study::with('classroom.school')
            ->paginate(50);

        return Inertia::render('Admin/Study/Study', [
            'schools' => $schools,
            'classrooms' => $classrooms,
            'studies' => $studies,
        ]);
    }


    public function store(Request $request)
    {
        Classroom::find($request->classroom_id)->studies()
            ->create([
                'name' => $request->study_name,
            ]);

        return back()->with([
            'message' => $request->study_name.' berhasil dibuat'
        ]);
    }

    public function update(Study $study, Request $request)
    {
        $study->update([
            'name' => $request->study_name,
        ]);

        return back()->with([
            'message' => $request->study_name.' berhasil diubah'
        ]);
    }

    public function destroy(Study $study)
    {
        $study->delete();

        return back()->with([
            'message' => $study->name.' berhasil dihapus'
        ]);
    }
}
