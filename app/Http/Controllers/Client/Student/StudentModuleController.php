<?php

namespace App\Http\Controllers\Client\Student;

use App\Http\Controllers\Controller;
use App\Models\Study;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class StudentModuleController extends Controller
{
    public function index($studyId)
    {
        $study = Study::find($studyId);
        $studyName = $study->name;
        $modules = $study->modules()->get();

        return Inertia::render('ListModule', [
            'modules' => $modules,
            'studyName' => $studyName,
        ]);
    }

    public function show($studyId, $moduleId)
    {
        $module = Study::find($studyId)->modules()
            ->where('id', $moduleId)
            ->first();
        
        $filename = $module->name.'.'.$module->file_type;
        return Storage::download($module->file_path, $filename);
    }
}
