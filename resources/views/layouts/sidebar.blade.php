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
        <img id="sidebar_fp" src="{{ (auth()->user()->foto_profil == null)?'/images/default.jpg':'/preview/'.auth()->user()->foto_profil }}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        @if (auth()->user()->is_admin == 1)
          <a href="/profile" class="d-block">{{ auth()->user()->koordinator->nama }}</a>
        @else
          <a href="/profile" class="d-block">{{ auth()->user()->mahasiswa->nama }}</a>
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

        <li class="nav-item {{ Request::is('dospem*') ? 'menu-open' : '' }}">
          <a href="/" class="nav-link {{ Request::is('dospem*') ? 'active' : '' }}">
            <i class="nav-icon fas bi bi-person-vcard-fill"></i>
            <p>
              Pembimbing
              <i class="right fas bi bi-caret-left-fill"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/dospem/kelola_dospem" class="nav-link {{ Request::is('dospem/kelola_dospem') ? 'active' : '' }}">
                <i class="far nav-icon bi bi-circle"></i>
                <p>Kelola Pembimbing</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/dospem/assign_mhs_bimbingan" class="nav-link {{ Request::is('dospem/assign_mhs_bimbingan') ? 'active' : '' }}">
                <i class="far nav-icon bi bi-circle"></i>
                <p>Assign Mhs Bimbingan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/dospem/beban_bimbingan" class="nav-link {{ Request::is('dospem/beban_bimbingan') ? 'active' : '' }}">
                <i class="far nav-icon bi bi-circle"></i>
                <p>Beban Bimbingan</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item {{ Request::is('mhs*') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ Request::is('mhs*') ? 'active' : '' }}">
            <i class="nav-icon fas bi bi-people-fill"></i>
            <p>
              Mahasiswa
              <i class="right fas bi bi-caret-left-fill"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/mhs/kelola_mhs" class="nav-link {{ Request::is('mhs/kelola_mhs') ? 'active' : '' }}">
                <i class="far nav-icon bi bi-circle"></i>
                <p>Kelola Mahasiswa</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/mhs/assign_dospem" class="nav-link {{ Request::is('mhs/assign_dospem') ? 'active' : '' }}">
                <i class="far nav-icon bi bi-circle"></i>
                <p>Assign Pembimbing</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/mhs/daftar_mhs_belum_selesai" class="nav-link {{ Request::is('mhs/daftar_mhs_belum_selesai') ? 'active' : '' }}">
                <i class="far nav-icon bi bi-circle"></i>
                <p>Daftar Mhs Belum Selesai</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item {{ Request::is('pkl*') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ Request::is('pkl*') ? 'active' : '' }}">
            <i class="nav-icon fas bi bi-briefcase-fill"></i>
            <p>
              PKL
              <i class="right fas bi bi-caret-left-fill"></i>
              {{-- <span class="badge badge-danger right p-1 m-1 rounded-circle"><span class="visually-hidden"></span></span> --}}
              <span class="right badge badge-danger">5</span>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/pkl/kelola_periode" class="nav-link {{ Request::is('pkl/kelola_periode*') ? 'active' : '' }}">
                <i class="far nav-icon bi bi-circle"></i>
                <p>Kelola Periode</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/pkl/verifikasi_registrasi" class="nav-link {{ Request::is('pkl/verifikasi_registrasi*') ? 'active' : '' }}">
                <i class="far nav-icon bi bi-circle"></i>
                <p>Verifikasi Registrasi</p>
                <span class="right badge badge-danger">5</span>
              </a>
            </li>
            <li class="nav-item">
              <a href="/pkl/verifikasi_laporan" class="nav-link {{ Request::is('pkl/verifikasi_laporan*') ? 'active' : '' }}">
                <i class="far nav-icon bi bi-circle"></i>
                <p>Verifikasi Laporan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/pkl/assign_nilai" class="nav-link {{ Request::is('pkl/assign_nilai*') ? 'active' : '' }}">
                <i class="far nav-icon bi bi-circle"></i>
                <p>Assign Nilai</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item {{ Request::is('seminar*') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ Request::is('seminar*') ? 'active' : '' }}">
            <i class="nav-icon fas bi bi-calendar2-week"></i>
            <p>
              Seminar
              <i class="right fas bi bi-caret-left-fill"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/seminar/verifikasi_pengajuan" class="nav-link {{ Request::is('seminar/verifikasi_pengajuan*') ? 'active' : '' }}">
                <i class="far nav-icon bi bi-circle"></i>
                <p>Verifikasi Pengajuan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/seminar/jadwal_seminar" class="nav-link {{ Request::is('seminar/jadwal_seminar*') ? 'active' : '' }}">
                <i class="far nav-icon bi bi-circle"></i>
                <p>Jadwal Seminar</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item">
          <a href="/cetak_sk" class="nav-link {{ Request::is('cetak_sk') ? 'active' : '' }}">
            <i class="nav-icon fas bi bi-file-earmark-spreadsheet-fill"></i>
            <p>
              Cetak SK PKL
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="/arsip_pkl" class="nav-link {{ Request::is('arsip_pkl*') ? 'active' : '' }}">
            <i class="nav-icon fas bi bi-file-earmark-zip-fill"></i>
            <p>
              Arsip PKL
            </p>
          </a>
        </li>
        
        <li class="nav-item">
          <a href="/riwayat_pkl" class="nav-link {{ Request::is('riwayat_pkl') ? 'active' : '' }}">
            <i class="nav-icon fas bi bi-clock-history"></i>
            <p>
              Riwayat PKL
            </p>
          </a>
        </li>

        <li class="nav-item {{ Request::is('informasi*') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ Request::is('informasi*') ? 'active' : '' }}">
            <i class="nav-icon fas bi bi-newspaper"></i>
            <p>
              Kelola Informasi
              <i class="right fas bi bi-caret-left-fill"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/informasi/kelola_pengumuman" class="nav-link {{ Request::is('informasi/kelola_pengumuman') ? 'active' : '' }}">
                <i class="far nav-icon bi bi-circle"></i>
                <p>Pengumuman</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/informasi/kelola_dokumen" class="nav-link {{ Request::is('informasi/kelola_dokumen') ? 'active' : '' }}">
                <i class="far nav-icon bi bi-circle"></i>
                <p>Dokumen</p>
              </a>
            </li>
          </ul>
        </li>

        <br>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
