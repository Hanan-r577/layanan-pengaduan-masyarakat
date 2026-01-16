@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-tite mx-4">
                <h2 class="mb-0 mt-4 fw-semibold"> Data Yang Telah Ditanggapi </h2>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="table-responsive">
                    <table id="datatable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul Pengaduan</th>
                                <th>Isi Pengaduan</th>
                                <th>Nama Petugas Tanggapan</th>
                                <th>Tanggapan</th>
                                <th>Waktu ditanggapi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tanggapan as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->pengaduan->judul }}</td>
                                    <td>{{ $item->pengaduan->isi_laporan }}</td>
                                    <td>{{ $item->petugas->nama ?? '-' }}</td>
                                    <td>{{ $item->tanggapan }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td class="align-middle text-center">
                                        <div class="d-inline-flex gap-2">
                                            <a href="{{ route('tanggapan.edit', $item->id_tanggapan) }}"
                                                class="btn btn-sm btn-warning">
                                                Edit
                                            </a>
                                            <form action="{{ route('tanggapan.destroy', $item->id_tanggapan) }}"
                                                method="post" class="m-0">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Yakin ingin menghapus data pengaduannya?')">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
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
            $('#datatable').DataTable();
        });
    </script>
@endsection
