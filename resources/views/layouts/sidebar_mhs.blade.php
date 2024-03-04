<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="/dashboard" class="brand-link">
    <img src="/images/logo_if.png" alt="Logo IF" class="brand-image elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">SIPKL Informatika</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img id="sidebar_fp" src="{{ ($user->foto_profil == null)?'/images/profile_default.svg':'/preview/'.$user->foto_profil }}" class="img-circle elevation-2 bg-white" alt="User Image">
      </div>
      <div class="info">
        <a href="/profile" class="d-block">{{ $mahasiswa->nama }}</a>
      </div>
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="bi bi-search"></i>
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
          <a href="/dashboard" class="nav-link {{ Request::is('dashboard')?'active':'' }}">
            <i class="nav-icon bi bi-speedometer"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>

        @if ($mahasiswa->status == "Nonaktif" && $pkl->status == "Praregistrasi" && $mahasiswa->id_dospem != null)

        <li class="nav-item">
          <a href="/registrasi" class="nav-link {{ Request::is('registrasi')?'active':'' }}">
            <i class="nav-icon bi bi-people-fill"></i>
            <p>
              Registrasi PKL
            </p>
          </a>
        </li>

        @endif

        @if ($mahasiswa->status != "Lulus")
        <li class="nav-item">
          <a href="/pkl" class="nav-link {{ Request::is('pkl')?'active':'' }}">
            <i class="nav-icon bi bi-briefcase-fill"></i>
            <p>
              PKL
            </p>
          </a>
        </li>
        @endif

        @if ($mahasiswa->status == "Aktif" || $mahasiswa->status == "Lulus")

        <li class="nav-item {{ Request::is('seminar*') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ Request::is('seminar*') ? 'active' : '' }}">
            <i class="nav-icon bi bi-calendar2-week"></i>
            <p>
              Seminar PKL
              <i class="right bi bi-caret-left-fill"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/seminar" class="nav-link {{ Request::is('seminar') ? 'active' : '' }}">
                <i class="far nav-icon bi bi-circle"></i>
                <p>Info Seminar</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/seminar/jadwal" class="nav-link {{ Request::is('seminar/jadwal*') ? 'active' : '' }}">
                <i class="far nav-icon bi bi-circle"></i>
                <p>Jadwal Seminar</p>
              </a>
            </li>
          </ul>
        </li>

          @if ($mahasiswa->seminar_pkl != null && $mahasiswa->seminar_pkl->status != 'Pengajuan')
            <li class="nav-item">
              <a href="/laporan" class="nav-link {{ Request::is('laporan')?'active':'' }}">
                <i class="nav-icon bi bi-journal-text"></i>
                <p>
                  Pengumpulan Laporan
                </p>
              </a>
            </li>
          @endif

        @endif

        <li class="nav-item">
          <a href="/riwayat" class="nav-link {{ Request::is('riwayat')?'active':'' }}">
            <i class="nav-icon bi bi-clock-history"></i>
            <p>
              Riwayat PKL
            </p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>