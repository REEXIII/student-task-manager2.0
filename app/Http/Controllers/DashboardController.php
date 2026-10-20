<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $tasks = [
            'total' => $user->tasks()->count(),
            'pending' => $user->tasks()
                ->where('status', 'Pending')
                ->count(),
            'completed' => $user->tasks()
                ->where('status', 'Completed')
                ->count(),
        ];

        return view('dashboard', compact('user', 'tasks'));
    }
}
