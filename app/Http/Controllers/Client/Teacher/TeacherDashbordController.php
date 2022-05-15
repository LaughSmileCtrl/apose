<?php

namespace App\Http\Controllers\Client\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\School;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class TeacherDashbordController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $classroomsCollect = Classroom::select('id', 'name')
            ->whereHas('users', function($q, ) {
                return $q->where('id', Auth::id());
            })
            ->get();

        $i = 1;
        foreach ($classroomsCollect as $classroom) {
            foreach ($classroom->studies as $study) {
                $classrooms[] = [
                    'class_id' => $classroom->id,
                    'class' => $classroom->name,
                    'study_id' => $study->id,
                    'study' => $study->name,
                ];

                if ($i++ == 7)
                    break;
            }
        }

        $schoolId = $user->classrooms()->first()->school_id;
        $school = School::select('name')
            ->where('id', $schoolId)
            ->first();

        return Inertia::render('Teacher/Dashboard', [
            'school' => $school->name,
            'classrooms' => $classrooms,
        ]);
    }
}
