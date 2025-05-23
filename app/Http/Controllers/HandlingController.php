<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\ReportHandling;
use App\Models\WorkTask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class HandlingController extends Controller
{
    public function index(){

        $handling = ReportHandling::whereHas('report', function ($query) {
            $query->where('staff_id', auth()->user()->staff->id);
        })->get();
        // dd($handling); // Uncomment for debugging if needed  
        return view('apps.handling.index', compact('handling'));
    }
    public function detail($id){
        $handling = ReportHandling::with('report')->findOrFail($id);
        $task = WorkTask::where('staff_id', auth()->user()->staff->id)->get();
        // dd($task); // Uncomment for debugging if needed
        // dd($handling->report); // Uncomment for debugging if needed
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
        // dd($request->all());
        // Validasi input
        $validatedData = $request->validate([
            'status' => 'required|string',
            'handling_time' => 'required|date',
            'action_taken' => 'required|string',
            'task_id' => 'required|string',
            'quantity' => 'required|string',
            'attachments' => 'nullable|array',
            'attachments.*' => 'file|mimes:jpg,jpeg,png,pdf|max:10240',
        ]);

        if ($validatedData === false) {
            return redirect()->route('handling.index')->with([
                'status' => 'error',
                'message' => 'Validation failed.',
            ]);
        }

        $handling = ReportHandling::findOrFail($id);


        // Update data ReportHandling
        $handling->status = $validatedData['status'];
        $handling->task_id = $validatedData['task_id'];
        $handling->handling_time = $validatedData['handling_time'];
        $handling->quantity = $validatedData['quantity'];
        $handling->action_taken = $validatedData['action_taken'];

        // Simpan perubahan
        $handling->save();


        // Proses file attachment jika ada
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
            // Ambil tanggal dari handling_time (format: Ymd)
            $date = \Carbon\Carbon::parse($handling->handling_time)->format('Ymd');
            $staffId = auth()->user()->staff->id;
            $originalName = preg_replace('/\s+/', '-', $file->getClientOriginalName()); // Ganti spasi dengan strip
            $filename = "{$date}_{$staffId}_{$originalName}";

            // Simpan file di folder attachments dengan nama baru
            $filePath = $file->storeAs('handling', $filename, 'public');

            // Simpan attachment ke dalam tabel attachment
            $attachment = new Attachment();
            $attachment->attachmentable_id = $handling->id; // Relasi polymorphic
            $attachment->attachmentable_type = 'App\Models\ReportHandling'; // Jenis relasi (Model)
            $attachment->file_path = $filePath;
            $attachment->file_type = $file->getClientMimeType();
            $attachment->save();
            }
        }

        // Redirect kembali dengan pesan sukses
        return back()->with([
            'status' => 'success',
            'message' => 'Handling updated successfully along with attachments.',
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
