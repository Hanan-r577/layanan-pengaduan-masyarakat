@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-title">
                <h2 class="mx-4 mb-3 mt-3 fw-semibold"> Edit Status </h2>
            </div>
            <div class="card-body">

                <form action="{{ route('statusPengaduan.update', $statusPengaduan) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="status" class="form-label">Nama Status</label>
                        <input type="text" class="form-control" id="status" name="status"
                            value="{{ old('status', $statusPengaduan->status) }}" required>
                    </div>
                    @error('status')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('statusPengaduan.index') }}" class="btn btn-dark">Kembali</a>
                </form>

            </div>
        </div>
    </div>
@endsection
