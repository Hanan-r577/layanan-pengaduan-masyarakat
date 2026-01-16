<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LPM</title>
    <link rel="icon" type="image/png" sizes="32x32"
        href="{{ asset('template/src/assets/images/logos/Favicon2.png') }}" />
    <link rel="stylesheet" href="{{ asset('template/src/assets/css/styles.min.css') }}" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.5/css/dataTables.dataTables.css" />
    <style>
        .left-sidebar {
            background: #0d47a1;
            /* biru gelap */
        }

        /* Logo area */
        .brand-logo {
            background: #0b3c8a;
        }

        /* Judul section */
        .nav-small-cap span,
        .nav-small-cap-icon {
            color: #ffeb3b;
            /* kuning */
            font-weight: 600;
        }

        /* Link default */
        .sidebar-link {
            color: #e3f2fd !important;
            border-radius: 8px;
            margin: 4px 10px;
            transition: all 0.3s ease;
        }

        /* Icon */
        .sidebar-link i {
            color: #bbdefb;
        }

        /* Hover */
        .sidebar-link:hover {
            background: #1565c0;
            color: #ffffff !important;
        }

        /* Active */
        .sidebar-item.selected>.sidebar-link,
        .sidebar-link.active {
            background: #1976d2;
            color: #ffffff !important;
        }

        /* Active icon */
        .sidebar-link.active i {
            color: #ffeb3b;
        }

        /* Hide menu text (mobile fix) */
        .hide-menu {
            font-weight: 500;
        }

        .brand-logo {
            background-color: #0b3c8a;
            /* biru lebih gelap */
        }

        .app-header {
            background-color: #0b3c8a;
            /* biru lebih gelap */
        }

        body {
            background-color: #0d47a1;
            /* abu-abu terang */
        }
    </style>
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        @include('admin.layouts.sidebar')
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            @include('admin.layouts.header')
            <!--  Header End -->
            @yield('content')
        </div>
    </div>
    <script src="{{ asset('template/src/assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('template/src/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('template/src/assets/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('template/src/assets/js/app.min.js') }}"></script>
    <script src="{{ asset('template/src/assets/libs/simplebar/dist/simplebar.js') }}"></script>
    <script src="https://cdn.datatables.net/2.3.5/js/dataTables.js"></script>
    @yield('js')
</body>

</html>
