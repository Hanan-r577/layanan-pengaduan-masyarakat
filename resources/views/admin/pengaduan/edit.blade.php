@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-title">
                <h2 class="mx-4 mt-4 fw-semibold"> Edit Pengaduan </h2>
            </div>
            <div class="card-body">
                <form action="{{ route('pengaduan.update', $pengaduan->id_pengaduan) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="user_id" class="form-label">Nama Pengadu</label>
                        <select name="user_id" id="user_id" class="form-select">
                            <option value="">-- Pilih Nama Pengadu --</option>

                            @foreach ($users as $user)
                                <option value="{{ $user->id_user }}"
                                    {{ old('user_id', $pengaduan->user_id) == $user->id_user ? 'selected' : '' }}>
                                    {{ $user->nama }}
                                </option>
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
                                <option value="{{ $item->id_kategori }}"
                                    {{ old('kategori_id', $pengaduan->kategori_id) == $item->id_kategori ? 'selected' : '' }}>
                                    {{ $item->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('kategori_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror


                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul</label>
                        <input type="text" class="form-control" id="judul" name="judul"
                            value="{{ old('judul', $pengaduan->judul) }}" required>
                    </div>
                    @error('judul')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label for="isi_laporan" class="form-label">Isi Laporan</label>
                        <textarea class="form-control" id="isi_laporan" name="isi_laporan" rows="5" required>{{ old('isi_laporan', $pengaduan->isi_laporan) }}</textarea>

                        @error('isi_laporan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat Lengkap</label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="3" required>{{ old('alamat', $pengaduan->alamat) }}</textarea>
                    </div>
                    @error('alamat')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto Bukti (Jika ada)</label>
                        <input type="file" class="form-control" id="foto" name="foto">
                    </div>
                    @error('foto')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    @if ($pengaduan->foto)
                        <div class="mb-3">
                            <label for="foto" class="form-label">Foto Saat ini:</label>
                            <img src="{{ asset('storage/' . $pengaduan->foto) }}" alt="Foto Bukti" class="img-thumbnail"
                                style="max-width: 200px;">
                        </div>
                    @else
                        <div class="mb-3">
                            <label for="foto" class="form-label">Foto Saat ini:</label>
                            <p>Tidak ada foto bukti.</p>
                        </div>
                    @endif

                    <div class="mb-3">
                        <label class="form-label">Status Pengaduan</label>
                        <select class="form-select" name="status_pengaduan_id" required>
                            <option value="">-- Pilih Status --</option>
                            @foreach ($statuses as $status)
                                <option value="{{ $status->id_status_pengaduan }}"
                                    {{ old('status_pengaduan_id', $pengaduan->status_pengaduan_id) == $status->id_status_pengaduan ? 'selected' : '' }}>
                                    {{ $status->status }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('pengaduan.index') }}" class="btn btn-dark">Kembali</a>
                </form>
            </div>
        </div>
    </div>
@endsection
