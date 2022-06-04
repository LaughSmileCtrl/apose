<?php

namespace App\Http\Controllers\Client\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Study;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

use function PHPUnit\Framework\isEmpty;

class TeacherClassroomController extends Controller
{

    public function index(Request $request)
    {
        $studies = Study::select('id', 'name', 'classroom_id')
            ->whereHas('teacher', function($q, ) {
                return $q->where('user_id', Auth::id());
            })
            ->with('classroom:name,id')
            ->get();

        return Inertia::render('Teacher/ListClass', [
            'studies' => $studies,
        ]);
    }

    public function show($classroomid, $studyId) 
    {
        $study = Classroom::find($classroomid)
            ->studies()->where('id', $studyId)
            ->first();

        if ($study === null) {
            abort(403);
        }

        $study = [
            'class_id' => $study->classroom->id,
            'class' => $study->classroom->name,
            'study_id' => $study->id,
            'study' => $study->name,
            'conversation_url' => $study->conversation_url,
        ];

        return Inertia::render('Teacher/DetailClass', [
            'study' => $study,
        ]);
    }


}
