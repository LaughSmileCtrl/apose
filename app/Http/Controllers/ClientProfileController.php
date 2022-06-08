<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ClientProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->avatar_path != null) {
            $user->avatar_path = Storage::url($user->avatar_path);
        }
        
        return Inertia::render('Profile', [
            'user' => $user,
        ]);
    }

    public function update(UpdateProfileRequest $request)
    {
        $user = $request->user();

        $user->update($request->only(['name', 'email']));

        if ($request->password != null) {
            $user->update([
                'password' => Hash::make($request->password)
            ]);
        }

        if ($request->avatar != null) {
            $oldAvatarPath = $user->avatar_path;
            $avatarPath = $request->avatar->store('public/avatars');
            $user->update([
                'avatar_path' => $avatarPath,
            ]);

            if ($oldAvatarPath != null) {
                Storage::delete($oldAvatarPath);
            }
        }

        return back()->with([
            'message' => 'Profile Berhasil diubah',
        ]);
    }
}
