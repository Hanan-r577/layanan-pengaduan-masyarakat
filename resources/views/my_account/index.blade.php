@extends('layouts.masyarakat')

@section('title', 'My Account')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="card shadow-sm">
                    <div class="card-header">
                        <h5 class="mb-0">Informasi Akun</h5>
                    </div>

                    <div class="card-body">

                        <div class="mb-3">
                            <small class="text-muted">Nama</small>
                            <div class="fw-semibold">{{ $user->nama }}</div>
                        </div>

                        <div class="mb-3">
                            <small class="text-muted">Email</small>
                            <div class="fw-semibold">{{ $user->email }}</div>
                        </div>

                        <div class="mb-3">
                            <small class="text-muted">No. Telepon</small>
                            <div class="fw-semibold">{{ $user->telp }}</div>
                        </div>

                        <div class="mb-3">
                            <small class="text-muted">Level Akun</small>
                            <span class="badge bg-primary text-capitalize">
                                {{ $user->level }}
                            </span>
                        </div>

                        <hr>

                        <div class="text-muted small">
                            Demi keamanan, password tidak ditampilkan.
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
