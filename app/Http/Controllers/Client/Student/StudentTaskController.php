<?php

namespace App\Http\Controllers\Client\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\FileStoreRequest;
use App\Models\Study;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class StudentTaskController extends Controller
{
    public function index($studyId)
    {
        $study = Study::find($studyId);

        $tasks = Auth::user()->studentTasks()
            ->select('id', 'name', 'description', 'deadline')
            ->whereRelation('study', 'id', $studyId)
            ->get();

        return Inertia::render('Student/ListTask', [
            'study' => $study,
            'tasks' => $tasks,
        ]);
    }


    public function store($studyId, $taskId, FileStoreRequest $request)
    {
        $user = Auth::user();
        $study = Study::find($studyId);
        $classroom = $study->classroom()->first();
        $school = $classroom->school()->first();

        $storePath = 'tasks/'.$school->name.'/'.$classroom->name.'/'.$study->name;
        
        $filePath = $request->file->store($storePath);

        $oldFilePath = $user->studentTasks()->find($taskId)->pivot->file_path;
        Storage::delete($oldFilePath);

        $user->studentTasks()
            ->updateExistingPivot($taskId, [
                'status' => 1,
                'file_path' => $filePath,
            ]);

        return back()->with([
            'message' => 'Tugas berhasil disimpan',
        ]);
    }

    public function show($taskId, $studentId)
    {
        $user = User::find($studentId);
        $task = Task::find($taskId);
        $userTask = $user->studentTasks()
            ->wherePivot('task_id', $taskId)->first();

        $filename = 'Tugas '.$task->name.' - '.$user->name;

        return Storage::download($userTask->pivot->file_path, $filename);
    }
}
