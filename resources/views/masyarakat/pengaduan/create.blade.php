@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card shadow-sm">
                    <div class="card-header bg-warning text-dark fw-bold">
                        Buat Pengaduan
                    </div>

                    <div class="card-body">
                        <form action="{{ route('masyarakat.pengaduan.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Judul</label>
                                <input type="text" name="judul" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Kategori</label>
                                <select name="kategori_id" class="form-control" required>
                                    <option value="">-- Pilih Kategori --</option>
                                    @foreach ($kategori as $item)
                                        <option value="{{ $item->id_kategori }}">
                                            {{ $item->nama_kategori }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Isi Pengaduan</label>
                                <textarea name="isi_laporan" class="form-control" rows="4" required></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Alamat Lengkap</label>
                                <textarea name="alamat" class="form-control" rows="3" required></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Foto (Opsional)</label>
                                <input type="file" name="foto" class="form-control">
                            </div>

                            <button class="btn btn-warning">Kirim Pengaduan</button>
                            <a href="{{ route('masyarakat.index') }}" class="btn btn-secondary">Batal</a>
                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
