@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-title">
                <h2 class="mx-4 mb-3 mt-3 fw-semibold"> Edit User </h2>
            </div>
            <div class="card-body">

                <form action="{{ route('user.update', $user->id_user) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Nama --}}
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                            name="nama" value="{{ old('nama', $user->nama) }}" required>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                            name="email" value="{{ old('email', $user->email) }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Telepon --}}
                    <div class="mb-3">
                        <label for="telp" class="form-label">Telefon</label>
                        <input type="text" class="form-control @error('telp') is-invalid @enderror" id="telp"
                            name="telp" value="{{ old('telp', $user->telp) }}" required>
                        @error('telp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Password (opsional) --}}
                    <div class="mb-3">
                        <label for="password" class="form-label">Password (isi jika ingin update)</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                            name="password" placeholder="Biarkan kosong jika tidak ingin mengubah">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Level --}}
                    <div class="mb-3">
                        <label for="level" class="form-label">Level</label>
                        <select class="form-select @error('level') is-invalid @enderror" id="level" name="level"
                            required>
                            <option value="">-- Pilih Level --</option>
                            <option value="admin" {{ old('level', $user->level) == 'admin' ? 'selected' : '' }}>Admin
                            </option>
                            <option value="masyarakat" {{ old('level', $user->level) == 'masyarakat' ? 'selected' : '' }}>
                                Masyarakat</option>
                        </select>
                        @error('level')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('user.index') }}" class="btn btn-dark">Kembali</a>
                </form>

            </div>
        </div>
    </div>
@endsection
