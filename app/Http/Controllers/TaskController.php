<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\DailyReport;
use App\Models\Staff;
use App\Models\WorkCategory;
use App\Models\WorkTask;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $staff = Staff::where('user_id', auth()->user()->id)->first();
        $task = DailyReport::where('staff_id',$staff->id)->get();
        $work_task = WorkTask::where('staff_id', $staff->id)->get();
        $categories = WorkCategory::get();

        if (!$staff) {
            return redirect()->back()->with([
                'status' => 'error',
                'message' => 'Sorry, you are not a staff member',
            ]);
        }
        // Logic to display a list of tasks
        return view('apps.tasks.index', compact('task','staff','categories','work_task'));
    }
    public function index_hou()
    {
        $task = DailyReport::with('category')->get();
        $staff = Staff::where('department_id', auth()->user()->staff->department_id)->get();
        $categories = WorkCategory::get();

        if (!$staff) {
            return redirect()->back()->with([
                'status' => 'error',
                'message' => 'Sorry, you are not a staff member',
            ]);
        }
        // Logic to display a list of tasks
        return view('apps.tasks.hou', compact('task','staff','categories'));
    }

    public function store(Request $request)
    {
        dd($request->all());
        // Validasi input
        $validated = $request->validate([
            'staff_id' => 'required|exists:staff,id',
            'task_id' => 'required',
            'task_date_start' => 'required|date',
            'task_date_end' => 'required|date|after_or_equal:task_date_start',
            'taskStatus' => 'required|string|in:done,progress,pending',
            'category_id' => 'required',
            'quantity' => 'required|integer|min:1',
            'desc' => 'required|string',
            'issue' => 'required|string',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
        ]);

        // Format task_date_start dan task_date_end ke format MySQL (Y-m-d H:i:s)
        $validated['task_date_start'] = Carbon::parse($validated['task_date_start'])->format('Y-m-d H:i:s');
        $validated['task_date_end'] = Carbon::parse($validated['task_date_end'])->format('Y-m-d H:i:s');

        // Simpan data DailyReport
        $dailyReport = DailyReport::create([
            'staff_id' => $validated['staff_id'],
            'task_id' => $validated['task_id'],
            'start_time' => $validated['task_date_start'],
            'end_time' => $validated['task_date_end'],
            'status' => $validated['taskStatus'],
            'category_id' => $validated['category_id'],
            'quantity' => $validated['quantity'],
            'task_description' => $validated['desc'],
            'issues' => $validated['issue'],
        ]);


        // Proses attachment jika ada
        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');

            // Format nama file: tanggal sekarang + staff_id + original name (spasi jadi strip)
            $date = Carbon::now()->format('Ymd');
            $staffId = $validated['staff_id'];
            $originalName = preg_replace('/\s+/', '-', $file->getClientOriginalName());
            $filename = "{$date}_{$staffId}_{$originalName}";

            // Simpan file di folder daily_reports
            $filePath = $file->storeAs('daily_reports', $filename, 'public');

            // Simpan data attachment polymorphic
            Attachment::create([
                'attachmentable_id' => $dailyReport->id,
                'attachmentable_type' => DailyReport::class,
                'file_path' => $filePath,
                'file_type' => $file->getClientMimeType(),
            ]);
        }

        return redirect()->back()->with([
            'status' => 'success',
            'message' => 'Daily report has been successfully added.',
        ]);
    }

    public function getTasksByStaff($staffId)
    {
        $categories = WorkTask::where('staff_id', $staffId)
            ->get()
            ->values();

        return response()->json($categories);
    }
}
