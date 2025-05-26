<?php

namespace App\Http\Controllers;

use App\Models\DailyReport;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $task = DailyReport::with('category')->get();
        // Logic to display a list of tasks
        return view('apps.tasks.index', compact('task'));
    }
}
