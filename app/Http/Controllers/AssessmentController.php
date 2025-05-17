<?php

namespace App\Http\Controllers;

use App\Models\WorkCategory;
use App\Models\WorkTask;
use Illuminate\Http\Request;

class AssessmentController extends Controller
{
    public function index()
    {
        // This method will handle the logic for displaying the assessment page
        $work_task = WorkTask::get()->all();
        $categories = WorkCategory::get()->all();
        return view('apps.assessment.index',compact('work_task', 'categories'));	
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'target_quantity' => 'required|integer',
            'unit' => 'required|string|max:50',
        ]);

        $exists = WorkTask::where('staff_id', auth()->id())
            ->where('title', $validated['title'])
            ->exists();

        if ($exists) {
            return redirect()->back()->withErrors(['title' => 'Work task with this title already exists for this staff.'])->withInput();
        }

        // Buat WorkTask baru
        $workTask = WorkTask::create([
            'staff_id' => auth()->id(),
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'target_quantity' => $validated['target_quantity'],
            'unit' => $validated['unit'],
        ]);

        // Jika ada kategori, sync relasi many-to-many
        if (!empty($validated['category_ids'])) {
            $workTask->categories()->sync($validated['category_ids']);
        }

        return response()->json([
            'message' => 'Work task created successfully',
            'data' => $workTask->load('categories'),
        ], 201);
    }
}
