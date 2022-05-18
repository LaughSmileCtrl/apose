<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\School;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SuperAdminSchoolController extends Controller
{
    public function index(Request $request)
    {
        $schools = School::select('id', 'name', 'created_at')
            ->when($request->search, function($query, $search) {
                return $query->where('name', 'LIKE', '%'.$search.'%')
                    ->orWhere('id', $search);
            })
            ->paginate(30);

        return Inertia::render('Admin/School/School', [
            'schools' => $schools,
        ]);
    }

    public function store(Request $request)
    {
        School::create([
            'name' => $request->name,
        ]);

        return back()->with([
            'message' => $request->name.' berhasil disimpan',
        ]);
    }

    public function update(School $school, Request $request)
    {
        $school->update([
            'name' => $request->name,
        ]);

        return back()->with([
            'message' => $request->name.' berhasil diubah',
        ]);
    }

    public function destroy(School $school) 
    {
        $school->delete();
        
        return back()->with([
            'message' => $school->name.' berhasil dihapus',
        ]);
    }
}
