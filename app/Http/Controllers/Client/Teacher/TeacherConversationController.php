<?php

namespace App\Http\Controllers\Client\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Study;
use Illuminate\Http\Request;

class TeacherConversationController extends Controller
{
    public function store($studyId, Request $request)
    {
        Study::find($studyId)->update([
            'conversation_url' => $request->url,
        ]);

        return back()->with([
            'message' => 'url pertemuan telah diatur',
        ]);
    }
}
