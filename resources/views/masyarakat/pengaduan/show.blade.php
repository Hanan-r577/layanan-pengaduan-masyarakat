@extends('layouts.masyarakat')

@section('title', 'Detail Pengaduan')

@section('content')
    <div class="container-fluid py-4">
        <div class="card shadow-sm">
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

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
                    <img src="{{ asset('storage/' . $pengaduan->foto) }}" class="img-fluid rounded" style="max-width: 300px">
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

                @php
                    $lamaHari = $pengaduan->created_at->diffInDays(now());
                @endphp

                @if (in_array($pengaduan->status->status, ['Pending', 'Proses']) && $lamaHari >= 3 && !$pengaduan->is_complain)
                    <div class="alert alert-warning mt-3 no-print">
                        <strong>Ajukan Komplain</strong>
                        <p class="mb-2">
                            Pengaduan ini belum ditanggapi dalam waktu lama.
                            Silakan jelaskan keluhan Anda.
                        </p>

                        <form action="{{ route('pengaduan.komplain', $pengaduan->id_pengaduan) }}" method="POST">
                            @csrf

                            <div class="mb-2">
                                <textarea name="isi_komplain" class="form-control @error('isi_komplain') is-invalid @enderror" rows="3"
                                    placeholder="Tuliskan alasan komplain Anda..." required></textarea>

                                @error('isi_komplain')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-warning btn-sm"
                                onclick="return confirm('Ajukan komplain atas pengaduan ini?')">
                                Kirim Komplain
                            </button>
                        </form>
                    </div>
                @endif

                @if ($pengaduan->is_complain && $pengaduan->status->status === 'Selesai' && $pengaduan->tanggapan->count() > 0)
                    {{-- KOMPLAIN SUDAH DITANGGAPI --}}
                    <div class="alert alert-success mt-3 no-print">
                        <strong>Komplain Telah Ditanggapi</strong><br>
                        <p class="mb-1">
                            Komplain pengaduan Anda telah ditindaklanjuti dan diselesaikan oleh admin.
                        </p>

                        @if ($pengaduan->isi_komplain)
                            <div class="mt-2">
                                <strong>Isi Komplain Anda:</strong>
                                <p class="mb-0 fst-italic">
                                    "{{ $pengaduan->isi_komplain }}"
                                </p>
                            </div>
                        @endif
                    </div>
                @elseif ($pengaduan->is_complain)
                    {{-- KOMPLAIN MASIH MENUNGGU --}}
                    <div class="alert alert-danger mt-3 no-print">
                        <strong>Pengaduan Dikomplain</strong><br>
                        <p class="mb-1">
                            Pengaduan ini telah dikomplain dan sedang menunggu perhatian admin.
                        </p>

                        @if ($pengaduan->isi_komplain)
                            <div class="mt-2">
                                <strong>Isi Komplain:</strong>
                                <p class="mb-0 fst-italic">
                                    "{{ $pengaduan->isi_komplain }}"
                                </p>
                            </div>
                        @endif
                    </div>
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
                            <strong>Menunggu Tanggapan</strong>
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
                <div class="no-print mt-3">
                    <a href="{{ route('pengaduan.masyarakat.index') }}" class="btn btn-secondary btn-sm">
                        Kembali
                    </a>

                    <button onclick="window.print()" class="btn btn-primary btn-sm">
                        Cetak
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
