<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Layanan Pengaduan')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" sizes="32x32"
        href="{{ asset('template/src/assets/images/logos/Favicon2.png') }}" />

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .hero-section .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero-section {
            background:
                linear-gradient(rgba(60, 70, 200, 0.75), rgba(60, 70, 200, 0.75)),
                url('assets/img/gedung_pengaduan.jpg') center/cover no-repeat;
            padding: 120px 0 180px;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .info-overlay {
            margin-top: -120px;
            /* naik ke hero */
            margin-bottom: 80px;
            /* JARAK KE SECTION BERIKUTNYA */
            position: relative;
            z-index: 5;
        }

        .info-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 16px;
            transition: all 0.3s ease;
        }

        .info-card:hover {
            transform: translateY(-6px);
        }

        .statistik-section {
            padding-top: 20px;
        }

        .timeline {
            list-style: none;
            padding-left: 20px;
            position: relative;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 9px;
            top: 0;
            bottom: 0;
            width: 2px;
            background: #dee2e6;
        }

        .timeline-item {
            position: relative;
            padding-left: 30px;
            margin-bottom: 25px;
        }

        .timeline-item:last-child {
            margin-bottom: 0;
        }

        .timeline-dot {
            position: absolute;
            left: 0;
            top: 3px;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            z-index: 2;
        }

        .timeline-content {
            padding-bottom: 5px;
        }

        .timeline-item.completed .timeline-dot {
            box-shadow: 0 0 0 4px rgba(25, 135, 84, .15);
        }

        .timeline-item.rejected .timeline-dot {
            box-shadow: 0 0 0 4px rgba(220, 53, 69, .15);
        }
    </style>

</head>

<body class="bg-light">

    {{-- HEADER --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('masyarakat.index') }}">
                📝 Layanan Pengaduan
            </a>

            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav ms-auto align-items-lg-center">

                    @auth
                        <li class="nav-item text-white mx-2">
                            Selamat Datang, <strong>{{ Auth::user()->nama ?? 'User' }}</strong>
                        </li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="btn btn-outline-light btn-sm">
                                    Logout
                                </button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="btn btn-light btn-sm">
                                Login
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
    <main>
        @yield('content')
    </main>

    {{-- FOOTER --}}

    <footer id="kontak" class="bg-dark text-white mt-5">
        {{-- COPYRIGHT --}}
        <div class="bg-black text-center py-3 fixed-bottom">
            <small class="text-secondary text-white">
                © 2026 Layanan Pengaduan Masyarakat. Seluruh hak cipta dilindungi.
            </small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
