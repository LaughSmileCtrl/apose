<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\School;
use App\Models\Study;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class AdminStudyController extends Controller
{
    public function index(Request $request)
    {
        $schools = School::select('id', 'name')->when(
            Auth::user()->school_id,
            function ($query, $schoolId) {
                return $query->where('id', $schoolId);
            }
        )->get();

        $classrooms = Classroom::select('id', 'name', 'school_id')
            ->when(
                Auth::user()->school_id,
                function ($query, $schoolId) {
                    return $query->where('school_id', $schoolId);
                }
            )
            ->get()
            ->mapToGroups(function ($classroom, $key) {
                return [
                    $classroom['school_id'] => $classroom,
                ];
            })
            ->all();

        $studies = Study::withTrashed()
            ->has('classroom')
            ->with('classroom.school')
            ->when($request->search, function ($query, $search) {
                return $query->where('name', 'LIKE', '%' . $search . '%');
            })
            ->when(Auth::user()->school_id, function ($query, $schoolId) {
                return $query->whereHas(
                    'classroom', 
                    function(Builder $q) use($schoolId) {
                        return $q->where('school_id', $schoolId);
                    });
            })
            ->paginate(50);
        
        $studies->getCollection()->transform(function ($study, $key) {
            $study->icon_path = Storage::url($study->icon_path);
            return $study;
        });

        return Inertia::render('Admin/Study/Study', [
            'schools' => $schools,
            'classrooms' => $classrooms,
            'studies' => $studies,
        ]);
    }


    public function store(Request $request)
    {
        $study = Classroom::findOrFail($request->classroom_id)
            ->studies()
            ->create([
                'name' => $request->study_name,
            ]);

        if ($request->icon != null) {
            $iconPath = $request->icon->store('public/studies/icons');
            $study->update([
                'icon_path' => $iconPath,
            ]);
        }

        return back()->with([
            'message' => $request->study_name . ' berhasil dibuat'
        ]);
    }

    public function update(Study $study, Request $request)
    {
        $study->update([
            'name' => $request->study_name,
        ]);

        if ($request->icon != null) {
            $iconPath = $request->icon->store('public/studies/icons');
            $study->update([
                'icon_path' => $iconPath,
            ]);
        }

        return back()->with([
            'message' => $request->study_name . ' berhasil diubah'
        ]);
    }

    public function destroy(Study $study)
    {
        $study->delete();

        return back()->with([
            'message' => $study->name . ' berhasil dihapus'
        ]);
    }

    public function restore($id)
    {
        Study::withTrashed()
            ->where('id', $id)
            ->restore();

        $study = Study::find($id);

        return back()->with([
            'message' => $study->name . ' berhasil direstore',
        ]);
    }
}
