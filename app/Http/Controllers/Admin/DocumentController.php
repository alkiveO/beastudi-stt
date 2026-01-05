<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Documents;
use File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
class DocumentController extends Controller
{
    //
    public function index()
    {
        $documents = Documents::latest()->get();
        return view('admin.documents.index', compact('documents'));
    }

    public function create()
    {
        return view('admin.documents.create');
    }

  public function store(Request $request)
{
    Log::info('[Document] Proses upload dimulai', [
        'judul' => $request->judul,
        'ip'    => $request->ip(),
    ]);

    try {
        /**
         * STEP 1: VALIDASI
         */
        $request->validate([
            'judul' => 'required|string|max:255',
            'file'  => 'required|file|mimes:pdf,doc,docx|max:5120',
        ]);

        if (!$request->hasFile('file')) {
            Log::error('[Document] File tidak ditemukan di request');
            return back()->withErrors(['file' => 'File tidak ditemukan']);
        }

        $file = $request->file('file');

        Log::info('[Document] File diterima', [
            'original_name' => $file->getClientOriginalName(),
            'size'          => $file->getSize(),
            'mime'          => $file->getMimeType(),
        ]);

        /**
         * STEP 2: SIMPAN FILE DENGAN STORAGE
         */
        $filename = time() . '_' .
            preg_replace('/[^A-Za-z0-9\.\-_]/', '_', $file->getClientOriginalName());

        // simpan ke storage/app/public/documents
        $path = $file->storeAs('documents', $filename, 'public');

        Log::info('[Document] File berhasil disimpan ke storage', [
            'path' => $path
        ]);

        /**
         * STEP 3: SIMPAN DATABASE
         */
        Documents::create([
            'judul'      => $request->judul,
            'file'       => $path, // contoh: documents/namafile.pdf
            'tipe'       => $file->extension(),
            'is_publish' => $request->is_publish ?? 1,
            'keterangan' => $request->keterangan,
        ]);

        Log::info('[Document] Data berhasil disimpan ke database', [
            'judul' => $request->judul,
        ]);

        return redirect()
            ->route('admin.documents.index')
            ->with('success', 'Dokumen berhasil diupload');

    } catch (\Throwable $e) {

        Log::error('[Document] Upload GAGAL', [
            'message' => $e->getMessage(),
            'file'    => $e->getFile(),
            'line'    => $e->getLine(),
        ]);

        return back()->withErrors([
            'file' => 'Upload gagal, cek log sistem'
        ]);
    }
}

    public function destroy(Document $document)
    {
        $filePath = public_path($document->file);

        if (File::exists($filePath)) {
            File::delete($filePath);
        }

        $document->delete();

        return back()->with('success', 'Dokumen berhasil dihapus');
    }
}
