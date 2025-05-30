<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\DailyReport;
use App\Models\Staff;
use App\Models\WorkCategory;
use App\Models\WorkTask;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    public function index()
    {
        $staff = Staff::where('user_id', auth()->user()->id)->first();
        $other_staff = Staff::where('department_id', $staff->department_id)
            ->where('id', '!=', $staff->id)
            ->get();
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
        return view('apps.tasks.index', compact('task','staff','categories','work_task','other_staff'));
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
            'otherStaff' => 'nullable|array',
            'attachment_all_staff' => 'nullable|boolean',
        ]);

        $validated['task_date_start'] = Carbon::parse($validated['task_date_start'])->format('Y-m-d H:i:s');
        $validated['task_date_end'] = Carbon::parse($validated['task_date_end'])->format('Y-m-d H:i:s');

        $attachment_all_staff = $request->boolean('attachment_all_staff', false);

        // Simpan attachment dulu jika ada (hanya sekali, akan digunakan ulang)
        $attachmentPath = null;
        $attachmentMimeType = null;

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $date = Carbon::now()->format('Ymd');
            $staffId = $validated['staff_id'];
            $originalName = preg_replace('/\s+/', '-', $file->getClientOriginalName());
            $filename = "{$date}_{$staffId}_{$originalName}";
            $attachmentPath = $file->storeAs('daily_reports', $filename, 'public');
            $attachmentMimeType = $file->getClientMimeType();
        }

        // Simpan DailyReport utama
        $dailyReportMain = DailyReport::create([
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

        // Simpan attachment untuk staff utama jika ada
        if ($attachmentPath) {
            Attachment::create([
                'attachmentable_id' => $dailyReportMain->id,
                'attachmentable_type' => DailyReport::class,
                'file_path' => $attachmentPath,
                'file_type' => $attachmentMimeType,
            ]);
        }

        // Jika ada otherStaff
        if (!empty($validated['otherStaff']) && is_array($validated['otherStaff'])) {
            foreach ($validated['otherStaff'] as $otherStaffId) {
                $taskId = $attachment_all_staff ? $validated['task_id'] : null; // Kosongkan jika attachment unik tiap staff

                // Simpan DailyReport untuk otherStaff
                $dailyReportOther = DailyReport::create([
                    'staff_id' => $otherStaffId,
                    'start_time' => $validated['task_date_start'],
                    'end_time' => $validated['task_date_end'],
                    'status' => $validated['taskStatus'],
                    'category_id' => $validated['category_id'],
                    'quantity' => $validated['quantity'],
                    'task_description' => $validated['desc'],
                    'issues' => $validated['issue'],
                ]);

                // Jika attachment_all_staff = true, salin attachment yang sama untuk otherStaff
                if ($attachment_all_staff && $attachmentPath) {
                    Attachment::create([
                        'attachmentable_id' => $dailyReportOther->id,
                        'attachmentable_type' => DailyReport::class,
                        'file_path' => $attachmentPath,
                        'file_type' => $attachmentMimeType,
                    ]);
                }
            }
        }

        return redirect()->back()->with([
            'status' => 'success',
            'message' => 'Daily report(s) has been successfully added.',
        ]);
    }


    public function getTasksByStaff($staffId)
    {
        $categories = WorkTask::where('staff_id', $staffId)
            ->get()
            ->values();

        return response()->json($categories);
    }

    public function destroy($id)
    {
        // Cari data DailyReport berdasarkan id
        $dailyReport = DailyReport::with('attachments')->findOrFail($id);

        // Dapatkan semua attachment yang terkait
        $attachments = $dailyReport->attachments;

        foreach ($attachments as $attachment) {
            $filePath = $attachment->file_path;

            // Hitung berapa banyak attachment lain yang memakai file yang sama (kecuali current)
            $duplicateCount = Attachment::where('file_path', $filePath)
                ->where('id', '!=', $attachment->id)
                ->count();

            // Jika tidak ada duplikat (dipakai hanya oleh 1 report ini), maka hapus file fisik
            if ($duplicateCount === 0 && $filePath) {
                Storage::disk('public')->delete($filePath);
            }

            // Hapus data attachment dari database
            $attachment->delete();
        }

        // Hapus data DailyReport
        $dailyReport->delete();

        return response()->json(['message' => 'Report and its attachments have been deleted successfully']);
    }

}
