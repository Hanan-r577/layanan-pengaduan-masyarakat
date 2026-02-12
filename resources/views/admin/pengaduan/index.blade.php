@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-tite mx-4 ">
                <h2 class="mb-0 mt-4 fw-semibold"> Data Pengaduan </h2>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <a href="{{ route('pengaduan.create') }}" class="btn btn-primary mb-3"> Tambah Pengaduan </a>
                <form method="GET" action="{{ route('pengaduan.index') }}" class="row g-2 mb-3">
                    <div class="col-md-3">
                        <label class="form-label">Dari Tanggal</label>
                        <input type="date" name="tanggal_dari" class="form-control"
                            value="{{ request('tanggal_dari') }}">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Sampai Tanggal</label>
                        <input type="date" name="tanggal_sampai" class="form-control"
                            value="{{ request('tanggal_sampai') }}">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Kategori</label>
                        <select name="kategori_id" class="form-select">
                            <option value="">-- Semua Kategori --</option>
                            @foreach ($kategori as $kat)
                                <option value="{{ $kat->id_kategori }}"
                                    {{ request('kategori_id') == $kat->id_kategori ? 'selected' : '' }}>
                                    {{ $kat->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>


                    <div class="col-md-3 d-flex align-items-end gap-2">
                        <button type="submit" class="btn btn-primary">Filter</button>
                        <a href="{{ route('pengaduan.index') }}" class="btn btn-secondary">Reset</a>
                    </div>
                </form>

                <div class="table-responsive">
                    <table id="datatable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pengadu</th>
                                <th>Kategori</th>
                                <th>Isi Laporan</th>
                                <th>Alamat</th>
                                <th>Alasan Penolakan</th>
                                <th>Foto Bukti</th>
                                <th>Tanggal dibuat</th>
                                <th>Status</th>
                                <th>Tanggal Komplain</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengaduan as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->user->nama }}</td>
                                    <td>{{ $item->kategori->nama_kategori }}</td>
                                    <td>{{ $item->isi_laporan }}</td>
                                    <td>
                                        {{ $item->alamat }}<br>
                                    </td>
                                    <td>{{ $item->alasan_penolakan ?? '-' }}</td>
                                    <td>
                                        @if ($item->foto)
                                            <a href="{{ asset('storage/' . $item->foto) }}" target="_blank">
                                                <img src="{{ asset('storage/' . $item->foto) }}" alt="Foto"
                                                    style="width: 100px; height: auto;">
                                            </a>
                                        @else
                                            Tidak ada foto
                                        @endif
                                    </td>
                                    <td>{{ $item->created_at->format('d M Y H:i') }}</td>
                                    <td>
                                        {{ $item->status->status }}

                                        @if ($item->is_complain && $item->status->status != 'Selesai')
                                            <button class="btn btn-sm btn-outline-danger mt-1" data-bs-toggle="modal"
                                                data-bs-target="#komplainProsesModal{{ $item->id_pengaduan }}">
                                                ⚠ Komplain
                                            </button>
                                        @elseif ($item->is_complain && $item->status->status == 'Selesai')
                                            <button class="btn btn-sm btn-outline-success mt-1" data-bs-toggle="modal"
                                                data-bs-target="#komplainSelesaiModal{{ $item->id_pengaduan }}">
                                                Komplain Selesai
                                            </button>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->is_complain && $item->tanggal_komplain)
                                            @if ($item->status->status == 'Selesai')
                                                <span class="text-success fw-semibold">
                                                    {{ \Carbon\Carbon::parse($item->tanggal_komplain)->format('d M Y') }}
                                                </span>
                                            @else
                                                <span class="text-danger fw-semibold">
                                                    {{ \Carbon\Carbon::parse($item->tanggal_komplain)->format('d M Y') }}
                                                </span>
                                            @endif
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td class="align-middle text-center">
                                        <div class="d-grid gap-1">

                                            <a href="{{ route('pengaduan.show', $item->id_pengaduan) }}"
                                                class="btn btn-sm btn-info">
                                                Detail
                                            </a>

                                            @if ($item->status && $item->status->status != 'Selesai' && $item->status->status != 'Ditolak')
                                                <a href="{{ route('pengaduan.tanggapan', $item->id_pengaduan) }}"
                                                    class="btn btn-sm btn-primary">
                                                    Tanggapi
                                                </a>
                                            @else
                                                <button type="button" class="btn btn-sm btn-secondary" disabled>
                                                    Ditanggapi
                                                </button>
                                            @endif

                                            @if ($item->status && !in_array($item->status->status, ['Selesai', 'Ditolak']))
                                                <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#tolakModal{{ $item->id_pengaduan }}">
                                                    Tolak
                                                </button>
                                            @elseif ($item->status && $item->status->status == 'Ditolak')
                                                <button type="button" class="btn btn-sm btn-secondary" disabled>
                                                    Ditolak
                                                </button>
                                            @endif

                                            <a href="{{ route('pengaduan.edit', $item->id_pengaduan) }}"
                                                class="btn btn-sm btn-warning">
                                                Edit
                                            </a>

                                            <form action="{{ route('pengaduan.destroy', $item->id_pengaduan) }}"
                                                method="post" class="m-0">
                                                @csrf
                                                @method('DELETE')
                                                <div class="d-grid gap-1">
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Yakin ingin menghapus data pengaduannya?')">
                                                        Hapus
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                <div class="modal fade" id="tolakModal{{ $item->id_pengaduan }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <form action="{{ route('pengaduan.tolak', $item->id_pengaduan) }}" method="POST">
                                            @csrf
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Tolak Pengaduan</h5>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label">Alasan Penolakan</label>
                                                        <textarea name="alasan_penolakan" class="form-control" rows="4" required
                                                            placeholder="Masukkan alasan penolakan pengaduan..."></textarea>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">
                                                        Batal
                                                    </button>
                                                    <button type="submit" class="btn btn-danger">
                                                        Tolak Pengaduan
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                @if ($item->is_complain && $item->status->status != 'Selesai')
                                    <div class="modal fade" id="komplainProsesModal{{ $item->id_pengaduan }}"
                                        tabindex="-1">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">

                                                <div class="modal-header bg-warning">
                                                    <h5 class="modal-title">
                                                        Komplain Pengaduan (Belum Selesai)
                                                    </h5>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>

                                                <div class="modal-body">
                                                    <p><strong>Dari Pengadu:</strong></p>
                                                    <p>{{ $item->user->nama }}</p>
                                                    <p><strong>Isi Komplain:</strong></p>
                                                    <div class="border rounded p-3 bg-light mb-3">
                                                        {{ $item->isi_komplain }}
                                                    </div>

                                                    <p class="text-muted mb-0">
                                                        Tanggal Komplain:
                                                        {{ \Carbon\Carbon::parse($item->tanggal_komplain)->format('d M Y') }}
                                                    </p>
                                                </div>

                                                <div class="modal-footer">
                                                    <a href="{{ route('pengaduan.tanggapan', $item->id_pengaduan) }}"
                                                        class="btn btn-primary">
                                                        Tanggapi Pengaduan
                                                    </a>

                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">
                                                        Tutup
                                                    </button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if ($item->is_complain && $item->status->status == 'Selesai')
                                    <div class="modal fade" id="komplainSelesaiModal{{ $item->id_pengaduan }}"
                                        tabindex="-1">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header bg-success text-white">
                                                    <h5 class="modal-title">
                                                        Komplain Telah Diselesaikan
                                                    </h5>
                                                    <button type="button" class="btn-close btn-close-white"
                                                        data-bs-dismiss="modal"></button>
                                                </div>

                                                <div class="modal-body">
                                                    <p><strong>Dari Pengadu:</strong></p>
                                                    <p>{{ $item->user->nama }}</p>
                                                    <p><strong>Isi Komplain:</strong></p>
                                                    <div class="border rounded p-3 bg-light mb-3">
                                                        {{ $item->isi_komplain }}
                                                    </div>

                                                    <p class="text-muted">
                                                        Tanggal Komplain:
                                                        {{ \Carbon\Carbon::parse($item->tanggal_komplain)->format('d M Y') }}
                                                    </p>

                                                    <hr>

                                                    <p><strong>Tanggapan Admin:</strong></p>
                                                    <div class="border rounded p-3 bg-success-subtle">
                                                        {{ $item->tanggapan->first()->tanggapan ?? '-' }}
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">
                                                        Tutup
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable({
                searching: false,
                paging: true,
                info: true,
                order: []
            });
        });
    </script>
@endsection
