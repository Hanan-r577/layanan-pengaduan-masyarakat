<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Pengaduan Masyarakat')</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Icon --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light">

    {{-- HEADER / NAVBAR --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ url('/') }}">
                <i class="bi bi-megaphone-fill me-1"></i>
                Pengaduan Masyarakat
            </a>

            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#nav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="nav">
                <ul class="navbar-nav ms-auto">

                    @auth
                        @if (auth()->user()->level === 'masyarakat')
                            <li class="nav-item">
                                <a href="{{ route('masyarakat.pengaduan.create') }}" class="btn btn-outline-warning ms-2">
                                    <i class="bi bi-plus-circle"></i> Buat Pengaduan
                                </a>
                            </li>
                        @endif

                        <li class="nav-item ms-2">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="btn btn-light btn-sm">
                                    <i class="bi bi-box-arrow-right"></i> Logout
                                </button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="bi bi-box-arrow-in-right"></i> Login
                            </a>
                        </li>

                        <li class="nav-item ms-2">
                            <a href="{{ route('register') }}" class="btn btn-light btn-sm">
                                <i class="bi bi-person-plus"></i> Register
                            </a>
                        </li>
                    @endauth

                </ul>

            </div>
        </div>
    </nav>

    {{-- CONTENT --}}
    <main class="py-4">
        <div class="container">
            @yield('content')
        </div>
    </main>

    {{-- FOOTER --}}
    <footer id="kontak" class="bg-dark text-white mt-5">
        <div class="container py-5">
            <div class="row">

                {{-- KIRI --}}
                <div class="col-md-6 mb-4 mb-md-0">
                    <h6 class="fw-bold text-white">Layanan Pengaduan Masyarakat</h6>
                    <p class="text-secondary text-white small mb-0">
                        Platform resmi untuk menyampaikan aspirasi dan keluhan masyarakat.
                        Kami berkomitmen untuk memberikan pelayanan terbaik bagi warga.
                    </p>
                </div>

                {{-- KANAN --}}
                <div class="col-md-6">
                    <h6 class="fw-bold text-white">Hubungi Kami</h6>
                    <p class="text-secondary text-white small mb-1">
                        Jl. Merdeka No. 123<br>
                        Jakarta Pusat, DKI Jakarta 10110
                    </p>
                    <p class="text-secondary text-white small mb-1">
                        (021) 1234-5678
                    </p>
                    <p class="text-secondary text-white small mb-0">
                        pengaduan@pemerintah.go.id
                    </p>
                </div>

            </div>
        </div>

        {{-- COPYRIGHT --}}
        <div class="bg-black text-center py-3">
            <small class="text-secondary text-white">
                © 2026 Layanan Pengaduan Masyarakat. Seluruh hak cipta dilindungi.
            </small>
        </div>
    </footer>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
