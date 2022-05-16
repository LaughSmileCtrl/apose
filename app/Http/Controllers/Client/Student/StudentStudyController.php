<?php

namespace App\Http\Controllers\Client\Student;

use App\Http\Controllers\Controller;
use App\Models\Study;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class StudentStudyController extends Controller
{
    public function index()
    {
        $studies = Auth::user()->classrooms()->first()
            ->studies()->select('id', 'name', 'conversation_url', 'icon_path')->get()
            ->map(function ($study, $key) {
                $study->icon_path = Storage::url($study->icon_path);
                return $study;
            });

        return Inertia::render('Student/ListStudy', [
            'studies' => $studies,
        ]);
    }

    public function show($studyId)
    {
        $study = Auth::user()->classrooms()->first()
            ->studies()->find($studyId);

        return Inertia::render('Student/DetailStudy', [
            'study' => $study,
        ]);
    }
}
