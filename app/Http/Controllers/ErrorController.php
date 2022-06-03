<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class ErrorController extends Controller
{
    public function index($message)
    {
        return Inertia::render('ErrorPage', [
            'message' => $message
        ]);
    }
}
