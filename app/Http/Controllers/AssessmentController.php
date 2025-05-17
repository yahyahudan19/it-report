<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\WorkCategory;
use App\Models\WorkTask;
use Illuminate\Http\Request;

class AssessmentController extends Controller
{
    public function index()
    {
        // This method will handle the logic for displaying the assessment page
        $staff = Staff::where('user_id', auth()->id())->first();
        $work_task = $staff ? WorkTask::where('staff_id', $staff->id)->get() : collect();
        $categories = WorkCategory::get()->all();
        return view('apps.assessment.index',compact('work_task', 'categories'));	
    }

    public function show()
    {
        // This method will handle the logic for displaying the assessment page
        $staff = Staff::where('user_id', auth()->id())->first();

        $work_task = collect();
        $department_staff = collect();
        if ($staff) {
            // Ambil seluruh staff di department yang sama
            $department_staff = Staff::where('department_id', $staff->department_id)->get();

            // Ambil work_task untuk seluruh staff di department yang sama
            $work_task = WorkTask::whereHas('staff', function ($query) use ($staff) {
            $query->where('department_id', $staff->department_id);
            })->get();
        }
        $categories = WorkCategory::get()->all();
        return view('apps.assessment.hou', compact('work_task', 'categories', 'department_staff'));
    }

    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'target_quantity' => 'required|integer',
            'unit' => 'required|string|max:50',
        ]);

        // Pastikan user ditemukan di tabel staff
        $staff = Staff::where('user_id', auth()->id())->first();
        if (!$staff) {
            return response()->json(['message' => 'Staff not found for this user.'], 404);
        }

        $exists = WorkTask::where('staff_id', $staff->id)
            ->where('title', $validated['title'])
            ->exists();

        if ($exists) {
            return redirect()->back()->withErrors(['title' => 'Work task with this title already exists for this staff.'])->withInput();
        }

        // Buat WorkTask baru
        $workTask = WorkTask::create([
            'staff_id' => $staff->id,
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'target_quantity' => $validated['target_quantity'],
            'unit' => $validated['unit'],
        ]);

        return redirect()->back()->with([
            'status' => 'success',
            'message' => 'Work task created successfully',
        ]);
    }

    public function edit($id)
    {
        $assessment = WorkTask::findOrFail($id);
        return response()->json($assessment);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'unit' => 'required|string|max:50',
            'target_quantity' => 'required|integer|min:1',
            'category_id' => 'nullable|uuid|exists:work_categories,id',
            'description' => 'nullable|string',
            'staff_id' => 'required|uuid|exists:staff,id',
        ]);

        $assessment = WorkTask::findOrFail($id);
        $assessment->update($validated);

        return response()->json($assessment);
    }

    public function destroy($id)
    {
        $assessment = WorkTask::findOrFail($id);
        $assessment->delete();

        return response()->json(['message' => 'Task deleted successfully']);
    }

}
