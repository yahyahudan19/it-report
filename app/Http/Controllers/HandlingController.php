<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\ReportHandling;
use App\Models\WorkTask;
use App\Services\WhatsappService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class HandlingController extends Controller
{
    public function index(){

        if (!auth()->user()->staff) {
            return back()->with([
            'status' => 'error',
            'message' => 'You are not a staff member and cannot access this feature.',
            ]);
        }

        $handling = ReportHandling::whereHas('report', function ($query) {
            $query->where('staff_id', auth()->user()->staff->id);
        })->get();
        // dd($handling); // Uncomment for debugging if needed  
        return view('apps.handling.index', compact('handling'));
    }
    public function detail($id){
        $handling = ReportHandling::with('report')->findOrFail($id);
        $task = WorkTask::where('staff_id', auth()->user()->staff->id)->get();
        // Tambahkan ukuran file ke setiap attachment
        foreach ($handling->attachments as $attachment) {
            if (Storage::disk('public')->exists($attachment->file_path)) {
                $sizeBytes = Storage::disk('public')->size($attachment->file_path);
                $attachment->size_kb = number_format($sizeBytes / 1024, 2);
            } else {
                $attachment->size_kb = 0;
            }
        }

        return view('apps.handling.detail', compact('handling', 'task'));	
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $validatedData = $request->validate([
            'status' => 'required|string|in:accept,handling,done,pending',
            'handling_time' => 'required|date',
            'action_taken' => 'required|string',
            'task_id' => 'required|string',
            'quantity' => 'required|string',
            'attachments' => 'nullable|array',
            'attachments.*' => 'file|mimes:jpg,jpeg,png,pdf|max:10240',
            'notification_reporter' => 'nullable|string|in:on,off',
        ]);

        $handling = ReportHandling::with('report.reporter.user', 'report.room')->findOrFail($id);

        // Update data
        $handling->status = $validatedData['status'];
        $handling->task_id = $validatedData['task_id'];
        $handling->handling_time = $validatedData['handling_time'];
        $handling->quantity = $validatedData['quantity'];
        $handling->action_taken = $validatedData['action_taken'];
        $handling->save();

        // Proses attachment
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $date = \Carbon\Carbon::parse($handling->handling_time)->format('Ymd');
                $staffId = auth()->user()->staff->id;
                $originalName = preg_replace('/\s+/', '-', $file->getClientOriginalName());
                $filename = "{$date}_{$staffId}_{$originalName}";
                $filePath = $file->storeAs('handling', $filename, 'public');

                Attachment::create([
                    'attachmentable_id' => $handling->id,
                    'attachmentable_type' => 'App\Models\ReportHandling',
                    'file_path' => $filePath,
                    'file_type' => $file->getClientMimeType(),
                ]);
            }
        }

        // Kirim notifikasi jika status done dan notifikasi reporter aktif
        if (
            $validatedData['status'] === 'done' &&
            $request->notification_reporter === 'on'
        ) {
            $reporter = $handling->report->reporter;
            $report = $handling->report;
            $reporterNumber = $reporter->whatsapp_number;

            if ($reporterNumber) {
                $tanggalSelesai = \Carbon\Carbon::parse($validatedData['handling_time'])
                    ->translatedFormat('d F Y H:i');

                $message = "✅ *Laporan Anda Telah Diselesaikan!*\n\n"
                    . "📝 *Issue :* {$report->issue}\n"
                    . "📅 *Waktu Selesai :* {$tanggalSelesai}\n"
                    . "📊 *Status Akhir :* Done\n\n"
                    . "🛠️ *Tindakan :* {$validatedData['action_taken']}\n\n"
                    . "Terima kasih telah melaporkan. 🙏\n"
                    . "*⚠️Pesan ini dikirim otomatis oleh sistem, Mohon tidak membalas !.*";

                WhatsappService::sendText([
                    'to' => $reporterNumber,
                    'message' => $message,
                ]);

                // Dispatch Job ke queue
                // SendWhatsappNotification::dispatch($reporterNumber, $message);
            }
        }

        return back()->with([
            'status' => 'success',
            'message' => 'Handling updated successfully.',
        ]);
    }


    public function destroy($id)
    {
        $handling = ReportHandling::findOrFail($id);
        // Hapus semua attachment terkait
        foreach ($handling->attachments as $attachment) {
            if (Storage::disk('public')->exists($attachment->file_path)) {
                Storage::disk('public')->delete($attachment->file_path);
            }
            $attachment->delete();
        }

        // Hapus handling
        $handling->delete();

        return back()->with([
            'status' => 'success',
            'message' => 'Handling and its attachments deleted successfully.',
        ]);
    }



}
