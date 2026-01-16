<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Pengaduan;

class MasyarakatController extends Controller
{
    public function index()
    {
        // default untuk guest
        $data = [
            'pengaduan' => collect(),
            'totalPengaduan' => 0,
            'pending' => 0,
            'proses' => 0,
            'selesai' => 0,
        ];

        if (Auth::check()) {
            $userId = Auth::id();

            $pengaduan = Pengaduan::with('status')
                ->where('user_id', $userId)
                ->latest()
                ->get();

            $data = [
                'pengaduan' => $pengaduan,
                'totalPengaduan' => $pengaduan->count(),
                'pending' => $pengaduan->where('status.status', 'Pending')->count(),
                'proses' => $pengaduan->where('status.status', 'Proses')->count(),
                'selesai' => $pengaduan->where('status.status', 'Selesai')->count(),
                'ditolak' => $pengaduan->where('status.status', 'Ditolak')->count(),
            ];
        }

        return view('masyarakat.index', $data);
    }
}
