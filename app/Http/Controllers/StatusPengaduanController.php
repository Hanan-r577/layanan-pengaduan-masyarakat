<?php

namespace App\Http\Controllers;

use App\Models\StatusPengaduan;
use Illuminate\Http\Request;

class StatusPengaduanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $statusPengaduan = StatusPengaduan::latest()->get();

        return view('admin.status.index', compact('statusPengaduan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.status.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'status' => 'required|string|max:255|unique:status_pengaduan',
        ]);

        StatusPengaduan::create([
            'status' => $request->status,
        ]);

        return redirect()->route('statusPengaduan.index')->with('success', 'Status created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(StatusPengaduan $statusPengaduan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StatusPengaduan $statusPengaduan)
    {
        return view('admin.status.edit', compact('statusPengaduan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StatusPengaduan $statusPengaduan)
    {
        $request->validate([
            'status' => 'required|string|max:255|unique:status_pengaduan,status,'
                        .$statusPengaduan->id_status_pengaduan.',id_status_pengaduan',
        ]);

        $statusPengaduan->update([
            'status' => $request->status,
        ]);

        return redirect()->route('statusPengaduan.index')->with('success', 'Status updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StatusPengaduan $statusPengaduan)
    {
        $statusPengaduan->delete();

        return redirect()->route('statusPengaduan.index')->with('success', 'Status deleted successfully.');
    }
}
