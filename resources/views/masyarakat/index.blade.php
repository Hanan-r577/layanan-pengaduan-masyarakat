@extends('layouts.masyarakat')

@section('title', 'Beranda')

@section('content')

    {{-- HERO --}}
    <section id="home" class="hero-section text-white p osition-relative">
        <div class="container text-center hero-content">
            <h1 class="fw-bold mb-3 display-5">
                Layanan Pengaduan Masyarakat
            </h1>

            <p class="mb-4 fs-6">
                Sampaikan aspirasi dan keluhan Anda untuk pembangunan daerah yang lebih baik.
                Kami siap mendengarkan dan menindaklanjuti setiap pengaduan Anda.
            </p>

            @auth
                <a href="{{ route('masyarakat.pengaduan.create') }}"
                    class="btn btn-light px-4 py-2 fw-semibold rounded-pill shadow">
                    Buat Pengaduan
                </a>
            @else
                <a href="{{ route('login') }}" class="btn btn-light px-4 py-2 fw-semibold rounded-pill shadow">
                    Login untuk Mengadu
                </a>
            @endauth
        </div>
    </section>

    <section class="info-overlay">
        <div class="container">
            <div class="row text-center g-4">

                <div class="col-md-4">
                    <div class="card info-card shadow border-0">
                        <div class="card-body">
                            <div class="fs-1 text-primary mb-2">🛡️</div>
                            <h6 class="fw-bold">Aman & Terpercaya</h6>
                            <small class="text-muted">Data Anda dijamin keamanannya</small>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card info-card shadow border-0">
                        <div class="card-body">
                            <div class="fs-1 text-primary mb-2">⏱️</div>
                            <h6 class="fw-bold">Respon Cepat</h6>
                            <small class="text-muted">Pengaduan ditangani profesional</small>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card info-card shadow border-0">
                        <div class="card-body">
                            <div class="fs-1 text-primary mb-2">💬</div>
                            <h6 class="fw-bold">Transparan</h6>
                            <small class="text-muted">Pantau status pengaduan</small>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="statistik-section">
        <div class="container">
            {{-- STATISTIK (LOGIN SAJA) --}}
            @auth
                <div class="row row-cols-2 row-cols-md-5 g-3 mb-4 text-center">

                    <div class="col">
                        <a href="{{ route('pengaduan.masyarakat.index') }}" class="text-decoration-none text-dark">
                            <div class="card shadow-sm h-100">
                                <div class="card-body">
                                    <small>Total Pengaduan</small>
                                    <h4 class="fw-bold">{{ $totalPengaduan }}</h4>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col">
                        <a href="{{ route('pengaduan.masyarakat.index') }}" class="text-decoration-none text-dark">
                            <div class="card shadow-sm h-100">
                                <div class="card-body">
                                    <small>Pending</small>
                                    <h4 class="text-secondary">{{ $pending }}</h4>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col">
                        <a href="{{ route('pengaduan.masyarakat.index') }}" class="text-decoration-none text-dark">
                            <div class="card shadow-sm h-100">
                                <div class="card-body">
                                    <small>Proses</small>
                                    <h4 class="text-warning">{{ $proses }}</h4>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col">
                        <a href="{{ route('pengaduan.masyarakat.index') }}" class="text-decoration-none text-dark">
                            <div class="card shadow-sm h-100">
                                <div class="card-body">
                                    <small>Selesai</small>
                                    <h4 class="text-success">{{ $selesai }}</h4>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col">
                        <a href="{{ route('pengaduan.masyarakat.index') }}" class="text-decoration-none text-dark">
                            <div class="card shadow-sm h-100">
                                <div class="card-body">
                                    <small>Ditolak</small>
                                    <h4 class="text-danger">{{ $ditolak }}</h4>
                                </div>
                            </div>
                        </a>
                    </div>

                </div>
            @endauth

            <div id="daftar-pengaduan" class="container my-5">
                <h4 class="mb-3">Daftar Pengaduan</h4>

                @forelse ($pengaduan as $item)
                    <a href="{{ route('pengaduan.masyarakat.show', $item->id_pengaduan) }}"
                        class="text-decoration-none text-dark">

                        <div class="card mb-3 shadow-sm">
                            <div class="card-body">
                                <h6 class="fw-bold">{{ $item->judul }}</h6>
                                <p class="mb-1 text-muted">
                                    {{ Str::limit($item->isi_laporan, 120) }}
                                </p>
                                <span class="badge bg-secondary">
                                    {{ $item->status->status }}
                                </span>
                            </div>
                        </div>

                    </a>
                @empty
                    <div class="alert alert-secondary">
                        Belum ada pengaduan.
                    </div>
                @endforelse
            </div>
        </div>
    </section>

@endsection
