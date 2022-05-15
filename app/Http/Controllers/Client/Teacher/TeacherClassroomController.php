<?php

namespace App\Http\Controllers\Client\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

use function PHPUnit\Framework\isEmpty;

class TeacherClassroomController extends Controller
{

    public function index(Request $request)
    {
        $classroomsCollect = Classroom::select('id', 'name')
            ->whereHas('users', function($q, ) {
                return $q->where('id', Auth::id());
            })
            ->get();

        foreach ($classroomsCollect as $classroom) {
            foreach ($classroom->studies as $study) {
                $classrooms[] = [
                    'class_id' => $classroom->id,
                    'class' => $classroom->name,
                    'study_id' => $study->id,
                    'study' => $study->name,
                ];
            }
        }

        return Inertia::render('Teacher/ListClass', [
            'classrooms' => $classrooms,
        ]);
    }

    public function show($id, $studyId) 
    {
        $study = Auth::user()->classrooms()
            ->where('id', $id)
            ->first()
            ->studies()
            ->where('id', $studyId)
            ->first();

        if ($study === null) {
            abort(403);
        }

        $study = [
            'class_id' => $study->classroom->id,
            'class' => $study->classroom->name,
            'study_id' => $study->id,
            'study' => $study->name,
        ];

        return Inertia::render('Teacher/DetailClass', [
            'study' => $study,
        ]);
    }


}
