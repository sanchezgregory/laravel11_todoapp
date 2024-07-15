<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $tasks = auth()->user()->sharedTasks()->orderBy('created_at', 'desc')->get();
        return view('dashboard', compact('tasks'));
    }
}
