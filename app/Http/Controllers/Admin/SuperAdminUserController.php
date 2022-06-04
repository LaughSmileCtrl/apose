<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\Classroom;
use App\Models\School;
use App\Models\Study;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;

use function GuzzleHttp\Promise\all;

class SuperAdminUserController extends Controller
{

    public function index(Request $request)
    {
        $users = User::select('id', 'name', 'email', 'school_id')
            ->when($request->search, function($query, $search) {
                return $query->where('name', 'LIKE', '%'.$search.'%')
                    ->orWhere('email', 'LIKE', '%'.$search.'%')
                    ->orWhere('id', $search);
            })
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


    public function destroy(User $user)
    {
        $user->delete();

        return back()->with([
            'message' => $user->name.' berhasil dihapus',
        ]);
    }
}
