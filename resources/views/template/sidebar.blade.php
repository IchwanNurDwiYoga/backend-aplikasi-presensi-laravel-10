<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('AdminLTE/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="/home" class="nav-link {{ request()->is('home') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('admin/*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('admin/*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-database"></i>
                        <p>
                            Data Master
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/pegawai"
                                class="nav-link {{ request()->is('admin/pegawai') || request()->is('admin/pegawai/*') ? 'active' : '' }}">
                                <i class="fas fa-users nav-icon"></i>
                                <p>Pegawai</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/jabatan"
                                class="nav-link {{ request()->is('admin/jabatan') ? 'active' : '' }}">
                                <i class="fas fa-briefcase nav-icon"></i>
                                <p>Jabatan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/presensi"
                                class="nav-link {{ request()->is('admin/presensi') ? 'active' : '' }}">
                                <i class="fas fa-calendar-day nav-icon"></i>
                                <p>Data Presensi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/settings"
                                class="nav-link {{ request()->is('admin/settings') ? 'active' : '' }}">
                                <i class="fas fa-cogs nav-icon"></i>
                                <p>Pengaturan Presensi</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="/logout" class="nav-link">
                        <i class="nav-icon fas fa-power-off"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
