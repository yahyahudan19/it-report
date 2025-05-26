<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\Report;
use App\Models\ReportHandling;
use App\Models\Room;
use App\Models\Staff;
use App\Models\WorkCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Services\WhatsappService;


class ReportController extends Controller
{
    public function index()
    {
        $report = Report::with('staff')->get();
        $reporter = Staff::all();
        $location = Room::all();
        $category = WorkCategory::all();
        return view('apps.reports.index',compact('report','reporter','location','category'));	
        
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'reporter_id' => 'required|exists:staff,id',
            'location_id' => 'required|exists:rooms,id',
            'report_date' => 'required|date',
            'priority' => 'required|string|in:critical,high,medium,low',
            'issue' => 'required|string',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf,docx',
        ]);

        // Tentukan folder penyimpanan berdasarkan model
        $folderPath = 'reports';  // Default folder untuk report
        if ($request->has('attachmentable_type') && $request->attachmentable_type == 'App\Models\ReportHandling') {
            $folderPath = 'handling';  // Jika untuk ReportHandling, gunakan folder 'handling'
        }

        $formattedDate = Carbon::createFromFormat('Y-m-d H:i', $validated['report_date'])->format('Y-m-d H:i:s');

        try {
            // Menyimpan data report
            $report = Report::create([
                'reporter_id' => $validated['reporter_id'],
                'location_id' => $validated['location_id'],
                'report_date' => $formattedDate,
                'priority' => $validated['priority'],
                'issue' => $validated['issue'],
                'is_assigned' => "0", // Status assigned default 0
                'received_by' => auth()->user()->staff->id, // ID user yang sedang login
            ]);

            // Menyimpan attachment jika ada
            if ($request->hasFile('attachment')) {
                $file = $request->file('attachment');

                // Mengubah format nama file
                $date = Carbon::now()->format('y-m-d');  // Format tanggal: 18-05-25
                $reporterId = $validated['reporter_id']; // ID reporter
                $reportUuid = $report->id; // UUID dari report

                // Format nama file: 18-05-25_report_12345_0196de10-7230-709e-80fa-2cdca4feda57
                $fileName = "{$date}_report_{$reporterId}_{$reportUuid}.{$file->getClientOriginalExtension()}";

                // Menyimpan file dengan nama yang telah disesuaikan
                $filePath = $file->storeAs($folderPath, $fileName, 'public'); // Simpan file di folder sesuai tipe

                // Menyimpan data attachment ke tabel attachments dengan polymorphic relationship
                Attachment::create([
                    'attachmentable_id' => $report->id, // Relate to report
                    'attachmentable_type' => 'App\Models\Report', // Model type (Report)
                    'file_path' => $filePath,
                    'file_type' => $file->getClientMimeType(),
                ]);
            }
            // Kirim notifikasi WhatsApp jika ada nomor yang valid
            if ($request->has('notifications') && $request->notifications === 'on') {
                try {
                    $reporter = Staff::with('user')->findOrFail($validated['reporter_id']);
                    $message = "📢 *Pemberitahuan Laporan*\n\n👤 *Yth. {$reporter->user->name}*,\n\nKami telah menerima laporan terkait:\n📝 _{$validated['issue']}_\n\n📅 Laporan tersebut telah tercatat pada sistem kami pada tanggal *" . Carbon::parse($formattedDate)->translatedFormat('d F Y H:i') . "*.\n\n✅ Terima kasih atas perhatiannya. Tim kami akan segera menindaklanjuti laporan ini sesuai dengan prosedur yang berlaku.\n\n⚠️ *Harap tidak membalas pesan ini, karena pesan ini dikirim secara otomatis.*";

                    WhatsappService::sendText([
                        'to' => $reporter->whatsapp_number,
                        'message' => $message,
                    ]);
                } catch (\Exception $ex) {
                    // Bisa di-log jika perlu, atau abaikan agar tidak ganggu alur utama
                    \Log::warning('Gagal kirim WA notifikasi: ' . $ex->getMessage());
                }
            }
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with([
                'status' => 'error',
                'message' => 'Failed to add report: ' . $e->getMessage(),
            ]);
        }

        // Redirect ke halaman reports dengan pesan sukses
        return redirect()->back()->with([
            'status' => 'success',
            'message' => 'Report has been successfully added',
        ]);
    }

    public function destroy($id)
    {
        // Cari report berdasarkan ID
        $report = Report::findOrFail($id);

        // Cari attachment yang terkait dengan report ini
        $attachments = $report->attachments;

        // Hapus file yang terkait dengan attachment (jika ada)
        foreach ($attachments as $attachment) {
            // Pastikan file ada di public storage
            if ($attachment->file_path) {
                // Hapus file dari public storage menggunakan disk 'public'
                Storage::disk('public')->delete($attachment->file_path); // Menggunakan disk public
            }

            // Hapus data attachment dari database
            $attachment->delete();
        }

        // Hapus data report
        $report->delete();

        return response()->json(['message' => 'Report and its attachments have been deleted successfully']);
    }

    public function assign(Request $request)
    {
        $validated = $request->validate([
            'assignmenStaff' => 'required|array',
            'assignmenStatus' => 'required|string|in:accept,handling,done,pending',
            'assignmenCategory' => 'required',
            'report_id' => 'required|exists:reports,id',
            'room_id' => 'required|exists:rooms,id',
            'notification_staff' => 'nullable|string|in:on,off',
            'notification_reporter' => 'nullable|string|in:on,off',
        ]);

        $reportId = $validated['report_id'];
        $status = $validated['assignmenStatus'];
        $category = $validated['assignmenCategory'];
        $roomId = $validated['room_id'];
        $responseTime = now();

        $sendToStaff = $validated['notification_staff'] === 'on';
        $sendToReporter = $validated['notification_reporter'] === 'on';

        $report = Report::with(['reporter.user', 'room'])->findOrFail($reportId);
        $existingStaff = [];
        $assignedStaffNames = [];

        foreach ($validated['assignmenStaff'] as $staffId) {
            $alreadyAssigned = ReportHandling::where('report_id', $reportId)
                ->where('staff_id', $staffId)
                ->exists();

            $staff = Staff::with('user')->find($staffId);
            if (!$staff) continue;

            if ($alreadyAssigned) {
                $existingStaff[] = $staff->user->name;
            } else {
                ReportHandling::create([
                    'report_id' => $reportId,
                    'staff_id' => $staffId,
                    'room_id' => $roomId,
                    'status' => $status,
                    'category_id' => $category,
                    'response_time' => $responseTime,
                ]);
                $assignedStaffNames[] = $staff->user->name;

                // Kirim notifikasi ke staff
                if ($sendToStaff && $staff->whatsapp_number) {
                    $message = "📢 *Penanganan Laporan!*\n\n"
                        . "👤 *Pelapor :* {$report->reporter->user->name}\n"
                        . "📍 *Lokasi :* {$report->room->name}\n"
                        . "📝 *Masalah :* {$report->issue}\n"
                        . "📊 *Status :* {$status}\n\n"
                        . "⚙️ Mohon segera ditindaklanjuti.\n\n"
                        . "⚠️ *Pesan otomatis sistem.*";
                    WhatsappService::sendText([
                        'to' => $staff->whatsapp_number,
                        'message' => $message,
                    ]);
                }
            }
        }

        // Kirim notifikasi ke reporter
        if ($sendToReporter && !empty($assignedStaffNames)) {
            $staffList = implode(", ", $assignedStaffNames);
            $reporterNumber = $report->reporter->whatsapp_number ?? null;

            if ($reporterNumber) {
                $message = "✅ *Laporan Anda Telah Ditindaklanjuti!*\n\n"
                    . "📍 *Lokasi :* {$report->room->name}\n"
                    . "📝 *Masalah :* {$report->issue}\n"
                    . "👷 *Ditangani Oleh :* {$staffList}\n"
                    . "📊 *Status Awal :* {$status}\n\n"
                    . "⚠️ *Pesan ini dikirim otomatis oleh sistem.*";

                WhatsappService::sendText([
                    'to' => $reporterNumber,
                    'message' => $message,
                ]);
            }
        }

        if (!empty($existingStaff)) {
            $existingNames = implode(', ', $existingStaff);
            return redirect()->back()->with([
                'status' => 'warning',
                'message' => "Report assigned. Tapi staff berikut sudah pernah ditugaskan: $existingNames",
            ]);
        }

        return redirect()->back()->with([
            'status' => 'success',
            'message' => 'Report has been assigned successfully!',
        ]);
    }



    public function detail($id)
    {
        $report = Report::with(['staff', 'room', 'attachments'])->findOrFail($id);
        $category = WorkCategory::all();
        // dd($report);
        // Tambahkan ukuran file ke setiap attachment
        foreach ($report->attachments as $attachment) {
            if (Storage::disk('public')->exists($attachment->file_path)) {
                $sizeBytes = Storage::disk('public')->size($attachment->file_path);
                $attachment->size_kb = number_format($sizeBytes / 1024, 2);
            } else {
                $attachment->size_kb = 0;
            }
        }

        $reporter = Staff::all();

        return view('apps.reports.detail', compact('report', 'reporter','category'));
    }

    public function update(Request $request, $id){
        // Validasi input
        $validated = $request->validate([
            'reporter_id' => 'required|exists:staff,id',
            'location_id' => 'required|exists:rooms,id',
            'report_date' => 'required|date',
            'priority' => 'required|string|in:critical,high,medium,low',
            'issue' => 'required|string',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf,docx',
        ]);

        try {
            // Cari report berdasarkan ID
            $report = Report::findOrFail($id);

            // Update data report
            $report->update([
                'reporter_id' => $validated['reporter_id'],
                'location_id' => $validated['location_id'],
                'report_date' => $validated['report_date'],
                'priority' => $validated['priority'],
                'issue' => $validated['issue'],
            ]);

            // Jika ada file attachment baru, simpan dan hapus yang lama
            if ($request->hasFile('attachment')) {
                $file = $request->file('attachment');

                // Hapus file lama jika ada
                $existingAttachment = $report->attachments()->first();
                if ($existingAttachment && Storage::disk('public')->exists($existingAttachment->file_path)) {
                    Storage::disk('public')->delete($existingAttachment->file_path);
                    $existingAttachment->delete();
                }

                // Format nama file baru
                $date = Carbon::now()->format('y-m-d');
                $reporterId = $validated['reporter_id'];
                $reportUuid = $report->id;
                $fileName = "{$date}_report_{$reporterId}_{$reportUuid}.{$file->getClientOriginalExtension()}";

                // Simpan file baru
                $filePath = $file->storeAs('reports', $fileName, 'public');

                // Simpan data attachment baru
                Attachment::create([
                    'attachmentable_id' => $report->id,
                    'attachmentable_type' => 'App\Models\Report',
                    'file_path' => $filePath,
                    'file_type' => $file->getClientMimeType(),
                ]);
            }
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with([
                'status' => 'error',
                'message' => 'Failed to update report: ' . $e->getMessage(),
            ]);
        }

        // Redirect ke halaman reports dengan pesan sukses
        return redirect()->back()->with([
            'status' => 'success',
            'message' => 'Report has been successfully updated',
        ]);
    }

    public function destroyAssignment($id)
    {
        try {
            $reportHandling = ReportHandling::findOrFail($id);
            $reportHandling->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Assignment has been deleted successfully!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete assignment: ' . $e->getMessage(),
            ], 500);
        }
    }



}
