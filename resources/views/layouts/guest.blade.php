<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>LPM</title>
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('template/src/assets/images/logos/Favicon2.png') }}" />

    <!-- Bootstrap OFFLINE -->
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
</head>

<body class="bg-primary bg-opacity-10">

    <div class="container min-vh-100 d-flex justify-content-center align-items-center">
        <div class="card shadow-lg border-0" style="width: 100%; max-width: 420px;">
            <div class="card-body p-4">

                <!-- LOGO -->
                <div class="text-center mb-4">
                    <img src="{{ asset('assets/img/user-icon.jpg') }}"
                         alt="Logo"
                         style="width:80px;">
                </div>

                {{ $slot }}

            </div>
        </div>
    </div>

    <script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
