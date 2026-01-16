@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Card Data Pengaduan -->
    <div class="card">
        <div class="card-header"><h3>Detail Pengaduan</h3></div>
        <div class="card-body">
            <p><strong>Nama:</strong> {{ $pengaduan->user->nama ?? '-' }}</p>
            <p><strong>Kategori:</strong> {{ $pengaduan->kategori->nama_kategori ?? '-' }}</p>
            <p><strong>Judul:</strong> {{ $pengaduan->judul }}</p>
            <p><strong>Isi Pengaduan:</strong> {{ $pengaduan->isi_laporan }}</p>
            <p><strong>Tanggal Pengaduan:</strong> {{ $pengaduan->created_at }}</p>
            <p><strong>Status Sekarang:</strong> {{ ucfirst($pengaduan->status?->status ?? '-') }} </p>
        </div>
    </div>

    <!-- Card Form Balasan -->
    <div class="card">
        <div class="card-header"><h3>Form Tanggapan</h3></div>
        <div class="card-body">
            <form action="{{ route('pengaduan.tanggapanStore', $pengaduan->id_pengaduan) }}" method="POST">
                @csrf
                    
                <div class="mb-3">
                    <label for="tanggapan_pengaduan" class="form-label">Isi Tanggapan</label>
                    <textarea name="tanggapan_pengaduan" class="form-control" rows="4">{{ old('tanggapan_pengaduan') }}</textarea>
                    @error('tanggapan_pengaduan')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror   
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('pengaduan.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-success">Submit Tanggapan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
