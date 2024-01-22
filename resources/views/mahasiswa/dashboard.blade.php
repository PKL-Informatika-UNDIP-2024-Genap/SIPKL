@extends('layouts.main_mhs')

{{-- @push('styles')
  <style>
    .timeline-icon {
      background-color: #adb5bd;
      border-radius: 50%;
      font-size: 16px;
      height: 30px;
      left: 18px;
      line-height: 30px;
      position: absolute;
      text-align: center;
      top: 0;
      width: 30px;
    }
  </style>
@endpush --}}

@section('container')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- /.row (main row) -->
      <!-- Timelime example  -->
      <div class="row">
        <div class="col-md-12">
          <!-- The time line -->
          <div class="timeline">
            <!-- timeline time label -->
            <div class="time-label">
              <span class="bg-red">1 Jan 2024</span>
            </div>
            <!-- /.timeline-label -->
            <!-- timeline item -->
            <div>
              <i class="fas bi bi-people-fill bg-green"></i>
              <div class="timeline-item">
                <span class="time"><i class="fas bi bi-clock"></i> 5 mins ago</span>
                <h3 class="timeline-header no-border"><a href="javascript:void(0)">Koordinator</a> telah membagikan Dosen Pembimbing</h3>
                <div class="timeline-body">
                  Dosen Pembimbing Anda: {{ $mahasiswa->nama_dospem }}
                </div>
                <div class="timeline-footer">
                  <a href="/profile" class="btn btn-primary btn-sm">Periksa</a>
                </div>
              </div>
            </div>
            <!-- END timeline item -->
            <!-- timeline item -->
            <div>
              <i class="fas bi bi-envelope-fill bg-blue"></i>
              <div class="timeline-item">
                <span class="time"><i class="fas bi bi-clock"></i> 12:05</span>
                <h3 class="timeline-header"><a href="javascript:void(0)">Registrasi PKL</a></h3>
                <div class="timeline-body">
                  Lakukan registrasi PKL segera setelah Anda mengambil IRS, dan serahkan bukti bahwa Anda telah mengambil PKL.
                </div>
                <div class="timeline-footer">
                  <a href="/registrasi" class="btn btn-primary btn-sm">Registrasi Sekarang</a>
                  <a class="btn btn-danger btn-sm">Delete</a>
                </div>
              </div>
            </div>
            <!-- END timeline item -->
            <!-- timeline item -->
            <div>
              <i class="fas bi bi-person-fill bg-green"></i>
              <div class="timeline-item">
                <span class="time"><i class="fas bi bi-clock"></i> 5 mins ago</span>
                <h3 class="timeline-header no-border"><a href="javascript:void(0)">Koordinator</a> menerima Registrasi PKL Anda</h3>
              </div>
            </div>
            <!-- END timeline item -->
            <!-- timeline item -->
            <div>
              <i class="fas bi bi-chat-fill bg-yellow"></i>
              <div class="timeline-item">
                <span class="time"><i class="fas bi bi-clock"></i> 27 mins ago</span>
                <h3 class="timeline-header"><a href="javascript:void(0)">Seminar PKL</a></h3>
                <div class="timeline-body">
                  Perhatikan jadwal Seminar PKL. Jika Anda ingin mengajukan Seminar PKL Tak Terjadwal, lakukan pendaftaran terlebih dahulu.
                </div>
                <div class="timeline-footer">
                  <a class="btn btn-warning btn-sm">Lihat</a>
                </div>
              </div>
            </div>
            <!-- END timeline item -->
            <!-- timeline time label -->
            <div class="time-label">
              <span class="bg-green">5 Jan 2024</span>
            </div>
            <!-- /.timeline-label -->
            <!-- timeline item -->
            <div>
              <i class="fa bi bi-camera-fill bg-purple"></i>
              <div class="timeline-item">
                <span class="time"><i class="fas bi bi-clock"></i> 2 days ago</span>
                <h3 class="timeline-header"><a href="javascript:void(0)">Laporan PKL</a></h3>
                <div class="timeline-body">
                  Kirim laporan PKL Anda pada halaman yang telah disediakan.
                </div>
                <div class="timeline-footer">
                  <a href="javascript:void(0)" class="btn btn-sm bg-maroon">Lihat</a>
                </div>
              </div>
            </div>
            <!-- END timeline item -->
            <!-- timeline item -->
            <div>
              <i class="fas bi bi-camera-video-fill bg-maroon"></i>
              <div class="timeline-item">
                <span class="time"><i class="fas bi bi-clock"></i> 5 days ago</span>
                <h3 class="timeline-header"><a href="#">Tutorial</a></h3>
                <div class="timeline-body">
                  <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/tMWkeBIohBs" allowfullscreen></iframe>
                  </div>
                </div>
                <div class="timeline-footer">
                  <a href="#" class="btn btn-sm bg-maroon">See comments</a>
                </div>
              </div>
            </div>
            <!-- END timeline item -->
            <div>
              <i class="fas bi bi-clock bg-gray"></i>
            </div>
          </div>
        </div>
        <!-- /.col -->
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
@endsection
