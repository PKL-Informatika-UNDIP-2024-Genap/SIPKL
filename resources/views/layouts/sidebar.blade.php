<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="/dashboard" class="brand-link">
    <img src="/images/logo_if.png" alt="AdminLTE Logo" class="brand-image elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">SIPKL Informatika</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="/images/default.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        @if (auth()->user()->is_admin == 1)
          <a href="#" class="d-block">{{ auth()->user()->koordinator->nama }}</a>
        @else
          <a href="#" class="d-block">{{ auth()->user()->mahasiswa->nama }}</a>  
        @endif
      </div>
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
              with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="/dashboard" class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}">
            <i class="nav-icon fas bi bi-speedometer"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>

        <li class="nav-item {{ Request::is('dosbing*') ? 'menu-open' : '' }}">
          <a href="/" class="nav-link {{ Request::is('dosbing*') ? 'active' : '' }}">
            <i class="nav-icon fas bi bi-people-fill"></i>
            <p>
              Dosen Pembimbing
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/dosbing/kelola_dosbing" class="nav-link {{ Request::is('dosbing/kelola_dosbing') ? 'active' : '' }}">
                <i class="far nav-icon bi bi-circle"></i>
                <p>Kelola Dosbing</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/dosbing/kelola_bimbingan" class="nav-link {{ Request::is('dosbing/kelola_bimbingan') ? 'active' : '' }}">
                <i class="far nav-icon bi bi-circle"></i>
                <p>Kelola Bimbingan</p>
              </a>
            </li>
          </ul>
        </li>
        
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas bi bi-person-fill"></i>
            <p>
              Mahasiswa
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="./index.html" class="nav-link">
                <i class="far nav-icon bi bi-circle"></i>
                <p>Kelola Mahasiswa</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="./index2.html" class="nav-link">
                <i class="far nav-icon bi bi-circle"></i>
                <p>Assign Dosbing</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas bi bi-briefcase-fill"></i>
            <p>
              PKL
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="./index.html" class="nav-link">
                <i class="far nav-icon bi bi-circle"></i>
                <p>Kelola Periode</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="./index2.html" class="nav-link">
                <i class="far nav-icon bi bi-circle"></i>
                <p>Verifikasi Registrasi</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="./index2.html" class="nav-link">
                <i class="far nav-icon bi bi-circle"></i>
                <p>Assign Pembimbing</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="./index2.html" class="nav-link">
                <i class="far nav-icon bi bi-circle"></i>
                <p>Kelola Laporan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="./index2.html" class="nav-link">
                <i class="far nav-icon bi bi-circle"></i>
                <p>Kelola Nilai</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas bi bi-calendar2-week"></i>
            <p>
              Seminar
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="./index.html" class="nav-link">
                <i class="far nav-icon bi bi-circle"></i>
                <p>Seminar Tak Terjadwal</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="./index2.html" class="nav-link">
                <i class="far nav-icon bi bi-circle"></i>
                <p>Seminar Terjadwal</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item">
          <a href="pages/widgets.html" class="nav-link">
            <i class="nav-icon fas bi bi-clock-history"></i>
            <p>
              Riwayat PKL
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="pages/widgets.html" class="nav-link">
            <i class="nav-icon fas bi bi-newspaper"></i>
            <p>
              Kelola Informasi
            </p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
