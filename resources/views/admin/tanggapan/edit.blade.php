@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-title">
                <h2 class="mx-4 mt-4 fw-semibold"> Edit Tanggapan </h2>
            </div>
            <div class="card-body">
                <form action="{{ route('tanggapan.update', $tanggapan->id_tanggapan) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul Pengaduan</label>
                        <input type="text" class="form-control" id="judul" name="judul"
                            value="{{ old('judul', $tanggapan->pengaduan->judul) }}" required>
                    </div>
                    @error('judul')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label for="isi_laporan" class="form-label">Isi Pengaduan</label>
                        <textarea class="form-control" id="isi_laporan" name="isi_laporan" rows="5" required>{{ old('isi_laporan', $tanggapan->pengaduan->isi_laporan) }}</textarea>

                        @error('isi_laporan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="user_id" class="form-label">Nama Petugas Tanggapan</label>
                        <select class="form-control" id="user_id" name="user_id" required>
                            <option value="">-- Pilih Petugas --</option>
                            @foreach($petugas as $p)
                                <option value="{{ $p->id }}" {{ old('user_id', $tanggapan->user_id) == $p->id_user ? 'selected' : '' }}>
                                    {{ $p->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="tanggapan" class="form-label">Tanggapan</label>
                        <textarea class="form-control" id="tanggapan" name="tanggapan" rows="5" required>{{ old('tanggapan', $tanggapan->tanggapan) }}</textarea>
                        @error('tanggapan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('tanggapan.index') }}" class="btn btn-dark">Kembali</a>
                </form>
            </div>
        </div>
    </div>
@endsection
