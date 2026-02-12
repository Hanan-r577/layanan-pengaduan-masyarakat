@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-title">
                <h2 class="mx-4 mt-4 fw-semibold"> Tambah Pengaduan </h2>
            </div>
            <div class="card-body">
                <form action="{{ route('pengaduan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="user_id" class="form-label">Nama pengadu</label>
                        <select name="user_id" id="user_id" class="form-select">
                            <option value="">-- Pilih Nama Pengadu --</option>
                            @foreach ($users as $user)
                                <option value="{{ old('user_id', $user->id_user) }}">{{ $user->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('user_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label for="kategori_id" class="form-label">Kategori</label>
                        <select name="kategori_id" id="kategori_id" class="form-select">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($kategori as $item)
                                <option value="{{ old('kategori_id', $item->id_kategori) }}">{{ $item->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('kategori_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul</label>
                        <input type="text" class="form-control" id="judul" name="judul" value="{{ old('judul') }}" required>
                    </div>
                    @error('judul')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label for="isi_laporan" class="form-label">Isi Laporan</label>
                        <textarea class="form-control" id="isi_laporan" name="isi_laporan" rows="5" required>{{ old('isi_laporan') }}</textarea>

                        @error('isi_laporan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat Lengkap</label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="3" required>{{ old('alamat') }}</textarea>
                    </div>
                    @error('alamat')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto Bukti</label>
                        <input type="file" class="form-control" id="foto" name="foto" required>
                    </div>
                    @error('foto')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label class="form-label">Status Pengaduan</label>
                        <select class="form-select" disabled>
                            <option selected>Pending</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('pengaduan.index') }}" class="btn btn-dark">Kembali</a>
                </form>
            </div>
        </div>
    </div>
@endsection
