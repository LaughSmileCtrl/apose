<?php

namespace App\Http\Controllers\Client\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Study;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Requests\Client\FileStoreRequest;
use App\Models\Module;
use Illuminate\Support\Facades\Storage;

class TeacherModuleController extends Controller
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

    
    public function store($studyId, FileStoreRequest $request)
    {
        $pathFile = $request->file->store('modules');

        Study::find($studyId)->modules()->create([
            'name' => $request->name,
            'file_path' => $pathFile,
        ]);

        return back()->with([
            'message' => 'sukses menambah materi '.$request->name,
        ]);
    }


    public function show($studyId, $moduleId)
    {
        $module = Study::find($studyId)->modules()
            ->where('id', $moduleId)
            ->first();
        
        return Storage::download($module->file_path, $module->name);
    }


    public function destroy($studyId, $moduleId)
    {
        $module = Study::find($studyId)->modules()
            ->where('id', $moduleId)
            ->first();

        Storage::delete($module->file_path);

        $module->delete();

        return back()->with([
            'message' => 'sukses menghapus materi '.$module->name,
        ]);
    }
}
