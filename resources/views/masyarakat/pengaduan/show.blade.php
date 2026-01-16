@extends('layouts.masyarakat')

@section('title', 'Detail Pengaduan')

@section('content')
    <div class="container-fluid py-4">
        <div class="card shadow-sm">
            <div class="card-body">

                <h4 class="fw-bold mb-3">{{ $pengaduan->judul }}</h4>

                <p><strong>Kategori:</strong> {{ $pengaduan->kategori->nama_kategori }}</p>
                <p><strong>Status:</strong>
                    <span class="badge bg-secondary">
                        {{ $pengaduan->status->status }}
                    </span>
                </p>

                <hr>

                <p><strong>Atas Nama:</strong> {{ $pengaduan->user->nama }}</p>
                <p><strong>Isi Laporan:</strong></p>
                <p>{{ $pengaduan->isi_laporan }}</p>

                <p><strong>Alamat:</strong> {{ $pengaduan->alamat }}</p>
                <p><strong>No. Telepon:</strong> {{ $pengaduan->user->telp }}</p>

                @if ($pengaduan->foto)
                    <hr>
                    <p><strong>Foto:</strong></p>
                    <img src="{{ asset('storage/' . $pengaduan->foto) }}" class="img-fluid rounded" style="max-width: 400px">
                @endif
                <hr>

                <p><strong>Tanggapan:</strong></p>
                @if ($pengaduan->tanggapan)
                    <ul>
                        @foreach ($pengaduan->tanggapan as $tanggapan)
                            <li>
                                <p>{{ $tanggapan->tanggapan }}</p>
                                <small class="text-muted">— Ditanggapi oleh {{ $tanggapan->petugas->nama }} pada
                                    {{ $tanggapan->created_at->format('d M Y H:i') }}</small>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p>Belum ada tanggapan.</p>
                @endif

                <hr>
                <h5 class="fw-bold mb-4">Riwayat Status Pengaduan</h5>

                <ul class="timeline">

                    {{-- STEP 1 --}}
                    <li class="timeline-item completed">
                        <span class="timeline-dot bg-success"></span>
                        <div class="timeline-content">
                            <strong>Pengaduan dibuat</strong>
                        </div>
                    </li>

                    {{-- STEP 2 --}}
                    <li
                        class="timeline-item {{ in_array($pengaduan->status->status, ['Pending', 'Proses', 'Selesai', 'Ditolak']) ? 'completed' : '' }}">
                        <span
                            class="timeline-dot {{ in_array($pengaduan->status->status, ['Pending', 'Proses', 'Selesai', 'Ditolak']) ? 'bg-success' : 'bg-secondary' }}"></span>
                        <div class="timeline-content">
                            <strong>Menunggu verifikasi</strong>
                        </div>
                    </li>

                    {{-- JIKA DITOLAK --}}
                    @if ($pengaduan->status->status === 'Ditolak')
                        <li class="timeline-item rejected">
                            <span class="timeline-dot bg-danger"></span>
                            <div class="timeline-content text-danger">
                                <strong>Pengaduan ditolak</strong>
                                <div class="small text-muted mt-1">
                                    {{ $pengaduan->alasan_penolakan ?? 'Tidak memenuhi ketentuan.' }}
                                </div>
                            </div>
                        </li>
                    @else
                        {{-- STEP 3 --}}
                        <li
                            class="timeline-item {{ in_array($pengaduan->status->status, ['Proses', 'Selesai']) ? 'completed' : '' }}">
                            <span
                                class="timeline-dot {{ in_array($pengaduan->status->status, ['Proses', 'Selesai']) ? 'bg-success' : 'bg-secondary' }}"></span>
                            <div class="timeline-content">
                                <strong>Sedang diproses</strong>
                            </div>
                        </li>

                        {{-- STEP 4 --}}
                        <li class="timeline-item {{ $pengaduan->status->status === 'Selesai' ? 'completed' : '' }}">
                            <span
                                class="timeline-dot {{ $pengaduan->status->status === 'Selesai' ? 'bg-success' : 'bg-secondary' }}"></span>
                            <div class="timeline-content">
                                <strong>Pengaduan selesai</strong>
                            </div>
                        </li>
                    @endif

                </ul>
                <hr>

                <p><strong>Lampiran:</strong></p>
                @if ($pengaduan->lampiran)
                    <ul>
                        @foreach ($pengaduan->lampiran as $lampiran)
                            <li>
                                <a href="{{ asset('storage/' . $lampiran->path_file) }}" target="_blank">
                                    {{ $lampiran->nama_file }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p>Tidak ada lampiran.</p>
                @endif

                <hr>
                <a href="{{ route('pengaduan.masyarakat.index') }}" class="btn btn-secondary btn-sm">
                    Kembali
                </a>

            </div>
        </div>
    </div>
@endsection
