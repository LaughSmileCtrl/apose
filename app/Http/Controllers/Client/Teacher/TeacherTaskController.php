<?php

namespace App\Http\Controllers\Client\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\TeacherCreateTaskRequest;
use App\Models\Study;
use App\Models\Task;
use App\Models\User;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class TeacherTaskController extends Controller
{
    public function index($studyId)
    {
        $tasks = Auth::user()->tasksCreated()
            ->select('id', 'name', 'description', 'deadline')
            ->whereRelation('study', 'id', $studyId)
            ->get();

        $study = Study::find($studyId)->name;

        return Inertia::render('Teacher/ListTask', [
            'tasks' => $tasks,
            'study' => $study,
        ]);
    }

    public function store($studyId, TeacherCreateTaskRequest $request) 
    {
        $task = Auth::user()->tasksCreated()
            ->create($request->validated());

        $students = $task->study()->find($studyId)
            ->classroom()->first()
            ->students()->with('roles')->get()
            ->filter(function($user, $key) {
                return $user->hasRole('student');
            });

        foreach ($students as $student) {
            $student->studentTasks()->attach($task->id);
        }

        return back()->with([
            'message' => 'tugas '.$request->name.' berhasil dibuat',
        ]);
    }

    public function show($studyId, $taskId)
    {
        $numberStudent = Study::findOrfail($studyId)
            ->classroom->students->count();
        $task = Task::find($taskId);

        $students = $task->submitedStudents()
            ->select('id', 'name')
            ->get();

        return Inertia::render('Teacher/ListSubmittedStudent', [
            'task' => $task,
            'students' => $students,
            'numberStudent' => $numberStudent,
        ]);
    }

    public function showStudentTask($taskId, $studentId)
    {
        $user = User::findOrFail($studentId);
        $task = Task::findOrFail($taskId);
        $userTask = $user->studentTasks()
            ->wherePivot('task_id', $taskId)->first();

        $filename = 'Tugas '.$task->name.' - '.$user->name.'.'.$userTask->pivot->file_type;

        return Storage::download($userTask->pivot->file_path, $filename);
    }

    public function destroy($studyId, $taskId)
    {
        $task = Study::find($studyId)
            ->tasks()
            ->find($taskId);
        
        $students = $task->study()->find($studyId)
            ->classroom()->first()
            ->students()->with('roles')->get()
            ->filter(function($user, $key) {
                return $user->hasRole('student');
            });


        foreach ($students as $student) {
            $filePath = $student->studentTasks()
                ->first()->pivot->file_path;

            Storage::delete($filePath);
        }

        $task->delete();
        
        return back()->with([
            'message' => 'tugas '.$task->name.' berhasil dihapus',
        ]);
    }
}
