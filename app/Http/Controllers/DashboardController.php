<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //

    public function index()
    {
        $tasks = auth()->user()->tasks()->get();
        return view('dashboard', compact('tasks'));
    }
}
