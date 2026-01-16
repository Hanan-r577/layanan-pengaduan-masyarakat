<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Pengaduan;
use App\Models\StatusPengaduan;
use App\Models\Tanggapan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengaduanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Pengaduan::with(['user', 'kategori', 'status']);

        if ($request->filled('tanggal_dari') && $request->filled('tanggal_sampai')) {
            $query->whereBetween('created_at', [
                $request->tanggal_dari.' 00:00:00',
                $request->tanggal_sampai.' 23:59:59',
            ]);
        }

        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }

        $pengaduan = $query->latest()->get();
        $kategori = Kategori::all();

        return view('admin.pengaduan.index', compact('pengaduan', 'kategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::where('level', 'masyarakat')->get();
        $kategori = Kategori::all();

        return view('admin.pengaduan.create', compact('users', 'kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|string|max:255',
            'kategori_id' => 'required|string|max:255',
            'judul' => 'required|string|max:255',
            'isi_laporan' => 'required|string',
            'alamat' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // 🔹 ambil status "Pending"
        $statusPending = StatusPengaduan::where('status', 'Pending')->firstOrFail();

        Pengaduan::create([
            'user_id' => $request->user_id,
            'kategori_id' => $request->kategori_id,
            'judul' => $request->judul,
            'isi_laporan' => $request->isi_laporan,
            'alamat' => $request->alamat,
            'foto' => $request->file('foto')?->store('pengaduan_foto', 'public'),
            'status_pengaduan_id' => $statusPending->id_status_pengaduan,
        ]);

        return redirect()->route('pengaduan.index')->with('success', 'Pengaduan berhasil dikirim dan menunggu verifikasi.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pengaduan $pengaduan)
    {
        $pengaduan->load([
            'user',
            'kategori',
            'status',
            'lampiran',
            'tanggapan.petugas',
        ]);

        return view('admin.pengaduan.detail', compact('pengaduan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pengaduan $pengaduan)
    {
        $users = User::where('level', 'masyarakat')->get();
        $kategori = Kategori::all();
        $statuses = StatusPengaduan::all();

        return view('admin.pengaduan.edit', compact('pengaduan', 'users', 'kategori', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pengaduan $pengaduan)
    {
        $request->validate([
            'user_id' => 'required|string|max:255',
            'kategori_id' => 'required|string|max:255',
            'judul' => 'required|string|max:255',
            'isi_laporan' => 'required|string',
            'alamat' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status_pengaduan_id' => 'required|exists:status_pengaduan,id_status_pengaduan',
        ]);

        $pengaduan->update([
            'user_id' => $request->user_id,
            'kategori_id' => $request->kategori_id,
            'judul' => $request->judul,
            'isi_laporan' => $request->isi_laporan,
            'alamat' => $request->alamat,
            'foto' => $request->file('foto') ? $request->file('foto')->store('pengaduan_foto', 'public') : $pengaduan->foto,
            'status_pengaduan_id' => $request->status_pengaduan_id,
        ]);

        return redirect()->route('pengaduan.index')->with('success', 'Pengaduan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengaduan $pengaduan)
    {
        $pengaduan->delete();

        return redirect()->route('pengaduan.index')->with('success', 'Pengaduan berhasil dihapus.');
    }

    public function tanggapan(Pengaduan $pengaduan)
    {
        $statusProses = StatusPengaduan::where('status', 'Proses')->first();

        if ($pengaduan->status_pengaduan_id != $statusProses->id_status_pengaduan) {
            $pengaduan->update([
                'status_pengaduan_id' => $statusProses->id_status_pengaduan,
            ]);
        }

        $statuses = StatusPengaduan::all();

        return view('admin.pengaduan.tanggapan', compact('pengaduan', 'statuses'));
    }

    public function tanggapanStore(Request $request, Pengaduan $pengaduan)
    {
        $request->validate([
            'tanggapan_pengaduan' => 'required|string',
        ]);

        // Simpan tanggapan baru
        $tanggapan = new Tanggapan;
        $tanggapan->pengaduan_id = $pengaduan->id_pengaduan;
        $tanggapan->user_id = Auth::user()->id_user; // admin/petugas login
        $tanggapan->tanggapan = $request->tanggapan_pengaduan;
        $tanggapan->save();

        // Ubah status pengaduan
        if ($pengaduan->status_pengaduan_id == StatusPengaduan::where('status', 'pending')->first()->id_status_pengaduan) {
            // Jika status awal pending → ubah jadi proses
            $statusProses = StatusPengaduan::where('status', 'proses')->first();
            $pengaduan->status_pengaduan_id = $statusProses->id_status_pengaduan;
        } else {
            // Jika sudah proses → ubah jadi selesai
            $statusSelesai = StatusPengaduan::where('status', 'selesai')->first();
            $pengaduan->status_pengaduan_id = $statusSelesai->id_status_pengaduan;
        }
        $pengaduan->save();

        return redirect()
            ->route('pengaduan.index')
            ->with('success', 'Tanggapan berhasil ditambahkan dan status pengaduan diperbarui.');
    }

    public function masyarakatIndex()
    {
        $userId = Auth::user()->id_user;

        $pengaduan = Pengaduan::with('status')
            ->where('user_id', $userId)
            ->latest()
            ->get();

        return view('masyarakat.index', [
            'pengaduan' => $pengaduan,
            'totalPengaduan' => $pengaduan->count(),
            'pending' => $pengaduan->where('status.status', 'Pending')->count(),
            'proses' => $pengaduan->where('status.status', 'Proses')->count(),
            'selesai' => $pengaduan->where('status.status', 'Selesai')->count(),
            'ditolak' => $pengaduan->where('status.status', 'Ditolak')->count(),
        ]);
    }

    // =========================
    // FORM PENGADUAN MASYARAKAT
    // =========================

    public function createMasyarakat()
    {
        // optional pengaman tambahan
        if (Auth::user()->level !== 'masyarakat') {
            abort(403);
        }

        $kategori = Kategori::all();

        return view('masyarakat.pengaduan.create', compact('kategori'));
    }

    public function storeMasyarakat(Request $request)
    {
        if (Auth::user()->level !== 'masyarakat') {
            abort(403);
        }

        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori,id_kategori',
            'isi_laporan' => 'required|string',
            'alamat' => 'required|string',
            'foto' => 'nullable|image|max:2048',
        ]);

        $foto = null;
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto')->store('pengaduan', 'public');
        }

        Pengaduan::create([
            'user_id' => Auth::user()->id_user, // ✅ SESUAI DB
            'kategori_id' => $request->kategori_id,
            'judul' => $request->judul,
            'isi_laporan' => $request->isi_laporan,
            'alamat' => $request->alamat,
            'foto' => $foto,
            'status_pengaduan_id' => 1, // ✅ WAJIB ADA (misal: pending)
        ]);

        return redirect()->route('masyarakat.index')
            ->with('success', 'Pengaduan berhasil dikirim');
    }

    public function masyarakatShow(Pengaduan $pengaduan)
    {
        // keamanan: hanya boleh lihat pengaduan sendiri
        abort_if($pengaduan->user_id !== Auth::user()->id_user, 403);

        $pengaduan->load(['user', 'kategori', 'status', 'lampiran', 'tanggapan.petugas']);

        return view('masyarakat.pengaduan.show', compact('pengaduan'));
    }

    public function tolak(Request $request, $id)
    {
        $request->validate([
            'alasan_penolakan' => 'required|min:5',
        ]);

        $pengaduan = Pengaduan::findOrFail($id);

        $statusDitolak = StatusPengaduan::where('status', 'Ditolak')->firstOrFail();

        $pengaduan->update([
            'status_pengaduan_id' => $statusDitolak->id_status_pengaduan,
            'alasan_penolakan' => $request->alasan_penolakan,
        ]);

        return redirect()->back()->with('success', 'Pengaduan berhasil ditolak.');
    }
}
