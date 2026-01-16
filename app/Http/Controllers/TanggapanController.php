<?php

namespace App\Http\Controllers;

use App\Models\Tanggapan;
use App\Models\User;
use Illuminate\Http\Request;

class TanggapanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tanggapan = Tanggapan::with(['pengaduan', 'petugas'])->get();
        return view('admin.tanggapan.index', compact('tanggapan'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Tanggapan $tanggapan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tanggapan $tanggapan)
    {   
        $petugas = User::where('level', 'admin')->get();
        return view('admin.tanggapan.edit', compact('tanggapan', 'petugas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tanggapan $tanggapan)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi_laporan' => 'required|string',
            'tanggapan' => 'required|string',
            'user_id' => 'required|exists:users,id',
        ]);

        $tanggapan->update([
            'judul' => $request->judul,
            'isi_laporan' => $request->isi_laporan,
            'tanggapan' => $request->tanggapan,
            'user_id' => $request->user_id,
        ]);

        return redirect()->route('tanggapan.index')->with('success', 'Tanggapan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tanggapan $tanggapan)
    {
        $tanggapan->delete();
        return redirect()->route('tanggapan.index')->with('success', 'Tanggapan berhasil dihapus.');
    }
}
