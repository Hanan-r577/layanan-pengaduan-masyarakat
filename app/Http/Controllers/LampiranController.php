<?php

namespace App\Http\Controllers;

use App\Models\Lampiran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LampiranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $pengaduan_id)
    {
        $request->validate([
            'file' => 'required|mimes:jpg,jpeg,png,pdf,doc,docx|max:5120',
        ]);

        $file = $request->file('file');
        $ext = strtolower($file->getClientOriginalExtension());

        // tentukan folder
        $folder = in_array($ext, ['jpg', 'jpeg', 'png'])
            ? 'lampiran/images'
            : 'lampiran/docs';

        $path = $file->store($folder, 'public');

        Lampiran::create([
            'pengaduan_id' => $pengaduan_id,
            'nama_file' => $file->getClientOriginalName(),
            'tipe_file' => $ext,
            'path_file' => $path,
        ]);

        return back()->with('success', 'Lampiran berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Lampiran $lampiran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lampiran $lampiran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lampiran $lampiran)
    {
        $request->validate([
            'file' => 'required|mimes:jpg,jpeg,png,pdf,doc,docx|max:5120',
        ]);

        $file = $request->file('file');

        $ext = strtolower($file->getClientOriginalExtension());
        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

        // bersihkan nama file
        $safeName = Str::slug($originalName);
        $filename = $safeName.'-'.time().'.'.$ext;

        // tentukan folder
        if (in_array($ext, ['jpg', 'jpeg', 'png'])) {
            $path = $file->storeAs('lampiran/images', $filename, 'public');
        } else {
            $path = $file->storeAs('lampiran/docs', $filename, 'public');
        }

        // hapus file lama
        if ($lampiran->path_file && Storage::disk('public')->exists($lampiran->path_file)) {
            Storage::disk('public')->delete($lampiran->path_file);
        }

        // update DB
        $lampiran->update([
            'nama_file' => $filename,
            'tipe_file' => $ext,
            'path_file' => $path,
        ]);

        // ⬅️ INI YANG WAJIB
        return back()->with('success', 'Lampiran berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lampiran $lampiran)
    {
        Storage::disk('public')->delete($lampiran->path_file);
        $lampiran->delete();

        return back()->with('success', 'Lampiran berhasil dihapus');
    }
}
