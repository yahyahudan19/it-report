<?php

namespace App\Http\Controllers;

use App\Models\WorkTask;
use Illuminate\Http\Request;

class AssessmentController extends Controller
{
    public function index()
    {
        // This method will handle the logic for displaying the assessment page
        $work_task = WorkTask::get()->all();
        return view('apps.assessment.index',compact('work_task'));
    }
}
