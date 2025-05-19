<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\Report;
use App\Models\ReportHandling;
use App\Models\Room;
use App\Models\Staff;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    public function index()
    {
        $report = Report::with('staff')->get();
        $reporter = Staff::all();
        $location = Room::all();
        return view('apps.reports.index',compact('report','reporter','location'));
        
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

        $formattedDate = Carbon::createFromFormat('d-m-Y H:i', $validated['report_date'])->format('Y-m-d H:i:s');

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
        // Validasi input dari form
        $validated = $request->validate([
            'assignmenStaff' => 'required|array',  // Pastikan ada staff yang dipilih
            'assignmenStatus' => 'required|string|in:accept,handling,done,pending',  // Status yang valid
            'report_id' => 'required|exists:reports,id',  // Validasi report_id yang valid
            'room_id' => 'required|exists:rooms,id',  // Validasi room_id yang valid
        ]);

        // Ambil report_id dan room_id dari input
        $reportId = $validated['report_id'];
        $roomId = $validated['room_id'];
        $status = $validated['assignmenStatus'];

        // Looping untuk setiap staff yang dipilih dan assign mereka ke report
        foreach ($validated['assignmenStaff'] as $staffId) {
            // Buat ReportHandling untuk setiap staff yang dipilih
            ReportHandling::create([
                'report_id' => $reportId,  // Menghubungkan ke report yang dipilih
                'staff_id' => $staffId,    // Menghubungkan ke staff yang dipilih
                'room_id' => $roomId,      // Menghubungkan ke room yang dipilih
                'status' => $status,       // Status yang dipilih (accept, handling, etc.)
            ]);
        }

        // Redirect kembali ke halaman laporan dengan pesan sukses
        return redirect()->back()->with([
            'status' => 'success',
            'message' => 'Report has been assigned successfully!',
        ]);
    }



}
