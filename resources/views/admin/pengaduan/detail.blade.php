@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">

        {{-- INFORMASI PENGADUAN --}}
        <div class="card mb-3">
            <div class="card-header fw-semibold">Detail Pengaduan</div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th width="25%">Nama Pengadu</th>
                        <td>{{ $pengaduan->user->nama }}</td>
                    </tr>
                    <tr>
                        <th>Kategori</th>
                        <td>{{ $pengaduan->kategori->nama_kategori }}</td>
                    </tr>
                    <tr>
                        <th>Judul</th>
                        <td>{{ $pengaduan->judul }}</td>
                    </tr>
                    <tr>
                        <th>Isi Laporan</th>
                        <td>{{ $pengaduan->isi_laporan }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            <span
                                class="badge 
                            @if ($pengaduan->status->status == 'Pending') bg-secondary
                            @elseif($pengaduan->status->status == 'Proses') bg-warning
                            @else bg-success @endif">
                                {{ $pengaduan->status->status }}
                            </span>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        {{-- LAMPIRAN --}}
        <div class="card mb-3 p-2 d-flex flex-column gap-2">
            <div class="card-header fw-semibold d-flex justify-content-between align-items-center">
                <span>Lampiran (opsional)</span>

                <form action="{{ route('lampiran.store', $pengaduan->id_pengaduan) }}" method="POST"
                    enctype="multipart/form-data" class="d-flex align-items-center gap-2">

                    @csrf

                    <div class="input-group input-group-sm">
                        <input type="file" name="file" class="form-control" required>
                        <button class="btn btn-primary" type="submit">
                            <i class="bi bi-plus"></i> Tambah
                        </button>
                    </div>

                </form>

            </div>
            <div class="card-body">
                @if ($pengaduan->lampiran->count())
                    <div class="row">
                        @foreach ($pengaduan->lampiran as $lampiran)
                            <div class="col-md-3 mb-3">
                                <div class="card shadow-sm">

                                    @php
                                        $ext = strtolower($lampiran->tipe_file);
                                    @endphp

                                    @if (in_array($ext, ['jpg', 'jpeg', 'png']))
                                        <img src="{{ asset('storage/' . $lampiran->path_file) }}" class="card-img-top"
                                            style="height:160px;object-fit:cover;">
                                    @elseif ($ext === 'pdf')
                                        <div class="text-center py-4">
                                            <i class="bi bi-file-earmark-pdf fs-1 text-danger"></i>
                                            <div class="small">PDF File</div>
                                        </div>
                                    @else
                                        <div class="text-center py-4">
                                            <i class="bi bi-file-earmark-word fs-1 text-primary"></i>
                                            <div class="small">Word File</div>
                                        </div>
                                    @endif

                                    <div class="card-body p-2 text-center d-flex flex-column gap-1">

                                        <a href="{{ asset('storage/' . $lampiran->path_file) }}" target="_blank"
                                            class="btn btn-sm btn-outline-primary">
                                            Lihat
                                        </a>

                                        {{-- Edit --}}
                                        <form action="{{ route('lampiran.update', $lampiran->id_lampiran) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <input type="file" name="file" class="form-control form-control-sm mb-1"
                                                required>
                                            <button class="btn btn-sm btn-warning w-100">
                                                Edit
                                            </button>
                                        </form>

                                        {{-- Hapus --}}
                                        <form action="{{ route('lampiran.destroy', $lampiran->id_lampiran) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger w-100"
                                                onclick="return confirm('Hapus lampiran ini?')">
                                                Hapus
                                            </button>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted">Tidak ada lampiran</p>
                @endif
            </div>
        </div>

        {{-- TANGGAPAN --}}
        <div class="card mb-3">
            <div class="card-header fw-semibold">
                <i class="bi bi-chat-left-text"></i> Tanggapan
            </div>

            <div class="card-body">
                @forelse ($pengaduan->tanggapan as $tanggapan)
                    <div class="border rounded p-3 mb-3 bg-light">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <div>
                                <strong class="text-primary">
                                    {{ $tanggapan->petugas->nama ?? 'Petugas' }}
                                </strong>
                            </div>
                            <small class="text-muted">
                                {{ $tanggapan->created_at->format('d M Y, H:i') }}
                            </small>
                        </div>

                        <div class="mt-2">
                            <p class="mb-0">
                                {{ $tanggapan->tanggapan }}
                            </p>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-secondary mb-0">
                        <i class="bi bi-info-circle"></i>
                        Belum ada tanggapan
                    </div>
                @endforelse
            </div>
        </div>

        <a href="{{ route('pengaduan.index') }}" class="btn btn-dark">
            Kembali
        </a>

    </div>
@endsection
