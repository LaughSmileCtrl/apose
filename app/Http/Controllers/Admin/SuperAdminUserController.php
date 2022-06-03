<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\Classroom;
use App\Models\School;
use App\Models\Study;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;

use function GuzzleHttp\Promise\all;

class SuperAdminUserController extends Controller
{

    public function index()
    {
        $users = User::select('id', 'name', 'email', 'school_id')
            ->with('roles')
            ->paginate(50);
    
        $schools = School::select('id', 'name')
            ->pluck('name', 'id');

        $roles = Role::select('id', 'name')->pluck('name', 'id');

        return Inertia::render('Admin/User/User', [
            'roles' => $roles,
            'users' => $users,
            'schools' => $schools,
        ]);
    }

    public function store(StoreUserRequest $request)
    {
        $user = User::create([
            'name' => $request->user_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'school_id' => $request->school_id,
        ])->assignRole($request->role);


        return back()->with([
            'message' => $user->name.' berhasil ditambah',
        ]);
    }


    public function indexOld()
    {
        $users = User::select('id', 'name', 'email', 'school_id')
            ->with([
                'teachs.classroom',
                'classroom:name',
                'roles:name'
            ])
            ->paginate(50);

        $classroomsBySchool = Classroom::select('id', 'name', 'school_id')
            ->get()->groupBy('school_id');
    
        $schools = School::select('id', 'name')
            ->pluck('name', 'id');
        
        $studiesBySchool = School::select('id')
            ->with(['classrooms:id,name,school_id',
                    'classrooms.studies:id,name,classroom_id'
            ])
            ->get()
            ->pluck('classrooms', 'id')
            ->toArray();

        $roles = Role::select('id', 'name')->pluck('name', 'id');

        return Inertia::render('Admin/User/User', [
            'roles' => $roles,
            'users' => $users,
            'schools' => $schools,
            'classroomsBySchool' => $classroomsBySchool,
            'studiesBySchool' => $studiesBySchool,
        ]);
    }

    public function storeOld(StoreUserRequest $request)
    {
        $user = User::create([
            'name' => $request->user_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'school_id' => $request->school_id,
        ]);

        $user->assignRole($request->role);
        
        if ($user->hasRole('student')) {
            $studiesId = $user->classroom()
                ->save(Classroom::find($request->classroom_id))
                ->studies()->select('id')->get()
                ->pluck('id');

            $tasksId = Task::select('id')->whereIn('study_id', $studiesId)->pluck('id');
            $user->studentTasks()->attach($tasksId);
        } else if ($user->hasRole('teacher')) {
            $studies = Study::whereIn('id', $request->studies_id)->get();

            $user->teachs()
                ->saveMany($studies);
        }

        return back()->with([
            'message' => $user->name.' berhasil ditambah',
        ]);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return back()->with([
            'message' => $user->name.' berhasil dihapus',
        ]);
    }
}
