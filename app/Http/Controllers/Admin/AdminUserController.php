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


class AdminUserController extends Controller
{

    public function index(Request $request)
    {
        $users = User::select('id', 'name', 'email', 'school_id')
            ->whereNot(function ($query) {
                return $query->where('id', Auth::id());
            })
            ->when($request->search, function ($query, $search) {
                return $query->where('email', 'LIKE', '%' . $search . '%');
            })
            ->when(Auth::user()->school_id, function ($query, $schoolId) {
                return $query->where('school_id', $schoolId);
            })
            ->with('roles')
            ->paginate(50);

        $schools = School::select('id', 'name')
            ->when(
                Auth::user()->school_id,
                function ($query, $schoolId) {
                    return $query->where('id', $schoolId);
                }
            )
            ->pluck('name', 'id');

        $roles = Role::select('id', 'name')
            ->when(
                Auth::user()->school_id,
                function ($query, $schoolId) {
                    return $query->whereNotIn('name', ['super-admin']);
                }
            )
            ->pluck('name', 'id');

        return Inertia::render('Admin/User/User', [
            'roles' => $roles,
            'users' => $users,
            'schools' => $schools,
        ]);
    }

    public function store(StoreUserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'school_id' => $request->school_id,
        ])->assignRole($request->role);


        return back()->with([
            'message' => $user->name . ' berhasil ditambah',
        ]);
    }

    public function update(User $user, Request $request)
    {
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        if ($request->password != null) {
            $user->update([
                'password' => Hash::make($request->password)
            ]);
        }

        return back()->with([
            'message' => $user->name . ' berhasil diubah',
        ]);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return back()->with([
            'message' => $user->name . ' berhasil dihapus',
        ]);
    }
}
