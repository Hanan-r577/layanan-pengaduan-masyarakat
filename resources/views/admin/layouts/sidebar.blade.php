<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="{{ asset('template/src/html/index.html') }}" class="text-nowrap logo-img">
                <img src="{{ asset('template/src/assets/images/logos/LPM2.jpeg') }}" width="180" alt="" />
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Home</span>
                </li>
                <li class="sidebar-item {{ Request::is('dashboard') ? 'selected' : '' }}">
                    <a class="sidebar-link {{ Request::is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Datamaster</span>
                </li>
                <li class="sidebar-item {{ Request::is('users*') ? 'selected' : '' }}">
                    <a class="sidebar-link {{ Request::is('users*') ? 'active' : '' }}" href="{{ route('user.index') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-users"></i>
                        </span>
                        <span class="hide-menu">Users</span>
                    </a>
                </li>
                <li class="sidebar-item {{ Request::is('kategori*') ? 'selected' : '' }}">
                    <a class="sidebar-link {{ Request::is('kategori*') ? 'active' : '' }}" href="{{ route('kategori.index') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-category"></i>
                        </span>
                        <span class="hide-menu">Kategori</span>
                    </a>
                </li>
                <li class="sidebar-item {{ Request::is('status*') ? 'selected' : '' }}">
                    <a class="sidebar-link {{ Request::is('status*') ? 'active' : '' }}" href="{{ route('statusPengaduan.index') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-circle"></i>
                        </span>
                        <span class="hide-menu">Status</span>
                    </a>
                </li>
                <li class="sidebar-item {{ Request::is('pengaduan*') ? 'selected' : '' }}">
                    <a class="sidebar-link {{ Request::is('pengaduan*') ? 'active' : '' }}" href="{{ route('pengaduan.index') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-message-report"></i>
                        </span>
                        <span class="hide-menu">Pengaduan</span>
                    </a>
                </li>
                <li class="sidebar-item {{ Request::is('tanggapan*') ? 'selected' : '' }}">
                    <a class="sidebar-link {{ Request::is('tanggapan*') ? 'active' : '' }}" href="{{ route('tanggapan.index') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-message-circle"></i>
                        </span>
                        <span class="hide-menu">Data Tanggapan</span>
                    </a>
                </li>
            </ul>

        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
