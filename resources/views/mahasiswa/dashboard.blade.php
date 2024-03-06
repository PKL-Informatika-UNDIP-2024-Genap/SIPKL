@extends('layouts.main_mhs')

@push('styles')
  <style>
    /* .timeline-icon {
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
    } */
    .no-border {
      border-bottom: none !important;
    }
    /* #timeline-section {
      box-shadow: none !important;
    } */
  </style>

  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">
@endpush

@section('container')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col">
          <h1 class="m-0">Dashboard</h1>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">

      @if ($mahasiswa->status == 'Lulus')
        <div class="row">
          <div class="col">
            <div class="alert alert-success alert-dismissible">
              <h5><i class="bi bi-check-square"></i> Selamat!</h5>
              Anda telah menyelesaikan PKL Anda.
            </div>
          </div>
        </div>
      @endif


      <!-- Timelime example  -->
      <div class="row">
        <div class="col-md-12">

          <a id="collapseTimelineBtn" class="btn btn-primary mb-3" data-bs-toggle="collapse" href="#collapseTimeline" role="button" aria-expanded="false" aria-controls="collapseTimeline">
            Tampilkan Timeline
          </a>
          <div class="collapse" id="collapseTimeline">
            
            <!-- The time line -->
            <div class="timeline">
              <!-- timeline time label -->
              {{-- <div class="time-label">
                <span class="bg-blue">Terbaru</span>
              </div> --}}
              <!-- /.timeline-label -->

              <!-- timeline item -->
              {{-- <div>
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
              </div> --}}
              <!-- END timeline item -->
              <!-- timeline item -->
              {{-- <div>
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
              </div> --}}
              <!-- END timeline item -->

              <!-- timeline item -->
              @if (($mahasiswa->status == 'Aktif' || $mahasiswa->status == 'Lulus') && $pkl != null && $pkl->status == 'Selesai')
              <div>
                <i class="fas bi bi-check-circle-fill bg-green"></i>
                <div class="timeline-item">
                  <span class="time"><i class="fas bi bi-clock"></i> {{ Carbon\Carbon::parse($pkl->tgl_verif_laporan)->diffForHumans() }}</span>
                  <h3 class="timeline-header no-border"><a href="javascript:void(0)">Koordinator</a> telah menerima Laporan PKL Anda</h3>
                </div>
              </div>
              @endif
              <!-- END timeline item -->

              <!-- timeline item -->
              @if ($pkl != null && $pkl->status == 'Aktif' && $pkl->pesan != null)
              <div>
                <i class="fas bi bi-exclamation-circle-fill bg-pink"></i>
                <div class="timeline-item">
                  <span class="time"><i class="fas bi bi-clock"></i> ~</span>
                  <h3 class="timeline-header"><a href="javascript:void(0)">Koordinator</a> telah menolak Laporan PKL Anda</h3>
                  <div class="timeline-body">
                    Pesan: <em>“{{ $pkl->pesan }}”</em>
                  </div>
                  <div class="timeline-footer">
                    <a href="/laporan" class="btn btn-primary btn-sm">Kirim Ulang Laporan</a>
                  </div>
                </div>
              </div>
              @endif
              <!-- END timeline item -->

              <!-- timeline item -->
              @if ($pkl != null && $pkl->tgl_laporan != null)
              <div>
                <i class="fas bi bi-send-check-fill bg-blue"></i>
                <div class="timeline-item">
                  <span class="time"><i class="fas bi bi-clock"></i> {{ Carbon\Carbon::parse($pkl->tgl_laporan)->diffForHumans() }}</span>
                  <h3 class="timeline-header no-border"><a href="javascript:void(0)">Anda</a> telah mengirim laporan PKL</h3>
                </div>
              </div>
              @endif
              <!-- END timeline item -->

              <!-- timeline item -->
              @if (($mahasiswa->status == 'Aktif' || $mahasiswa->status == 'Lulus') && $mahasiswa->seminar_pkl != null)
              <div>
                <i class="fas bi bi-info-circle-fill bg-info"></i>
                <div class="timeline-item">
                  <span class="time"><i class="fas bi bi-clock"></i> ~</span>
                  <h3 class="timeline-header"><a href="javascript:void(0)" class="text-info">Laporan PKL</a></h3>
                  <div class="timeline-body">
                    Buat dan kirim laporan PKL Anda sebelum periode PKL berakhir.
                  </div>
                  <div class="timeline-footer">
                    <a href="/laporan" class="btn btn-primary btn-sm">Buat Laporan</a>
                  </div>
                </div>
              </div>
              @endif
              <!-- END timeline item -->

              <!-- timeline item -->
              @if (($mahasiswa->status == 'Aktif' || $mahasiswa->status == 'Lulus') && $mahasiswa->seminar_pkl != null && $mahasiswa->seminar_pkl->status == 'Terjadwal')
              <div>
                <i class="fas bi bi-check-circle-fill bg-green"></i>
                <div class="timeline-item">
                  <span class="time"><i class="fas bi bi-clock"></i> {{ Carbon\Carbon::parse($mahasiswa->seminar_pkl->updated_at)->diffForHumans() }}</span>
                  <h3 class="timeline-header no-border"><a href="javascript:void(0)">Koordinator</a> telah memasukkan Anda ke dalam Seminar PKL Terjadwal</h3>
                </div>
              </div>
              @endif
              <!-- END timeline item -->
              <!-- timeline item -->
              @if (($mahasiswa->status == 'Aktif' || $mahasiswa->status == 'Lulus') && $mahasiswa->seminar_pkl != null && $mahasiswa->seminar_pkl->status == 'TakTerjadwal')
              <div>
                <i class="fas bi bi-check-circle-fill bg-green"></i>
                <div class="timeline-item">
                  <span class="time"><i class="fas bi bi-clock"></i> {{ Carbon\Carbon::parse($mahasiswa->seminar_pkl->updated_at)->diffForHumans() }}</span>
                  <h3 class="timeline-header no-border"><a href="javascript:void(0)">Koordinator</a> telah menerima pengajuan Seminar PKL Tak Terjadwal Anda</h3>
                </div>
              </div>
              @endif
              <!-- END timeline item -->

              <!-- timeline item -->
              @if ($mahasiswa->seminar_pkl != null && ($mahasiswa->seminar_pkl->status == 'Pengajuan' && $mahasiswa->seminar_pkl->pesan != null))
              <div>
                <i class="fas bi bi-exclamation-circle-fill bg-pink"></i>
                <div class="timeline-item">
                  <span class="time"><i class="fas bi bi-clock"></i> ~</span>
                  <h3 class="timeline-header"><a href="javascript:void(0)">Koordinator</a> telah menolak pendaftaran Seminar PKL Tak Terjadwal Anda</h3>
                  <div class="timeline-body">
                    Pesan: <em>“{{ $mahasiswa->seminar_pkl->pesan }}”</em>
                  </div>
                  <div class="timeline-footer">
                    <a href="/seminar" class="btn btn-primary btn-sm">Daftar Ulang</a>
                  </div>
                </div>
              </div>
              @endif
              <!-- END timeline item -->

              <!-- timeline item -->
              @if ($mahasiswa->seminar_pkl != null && ($mahasiswa->seminar_pkl->status == 'Pengajuan' || $mahasiswa->seminar_pkl->status == 'TakTerjadwal'))
              <div>
                <i class="fas bi bi-send-check-fill bg-blue"></i>
                <div class="timeline-item">
                  <span class="time"><i class="fas bi bi-clock"></i> {{ Carbon\Carbon::parse($mahasiswa->seminar_pkl->created_at)->diffForHumans() }}</span>
                  <h3 class="timeline-header no-border"><a href="javascript:void(0)">Anda</a> telah mengirim pengajuan Seminar PKL Tak Terjadwal</h3>
                </div>
              </div>
              @endif
              <!-- END timeline item -->

              <!-- timeline item -->
              @if ($mahasiswa->status == 'Aktif' || $mahasiswa->status == 'Lulus')
              <div>
                <i class="fas bi bi-info-circle-fill bg-info"></i>
                <div class="timeline-item">
                  <span class="time"><i class="fas bi bi-clock"></i> ~</span>
                  <h3 class="timeline-header"><a href="javascript:void(0)" class="text-info">Seminar PKL</a></h3>
                  <div class="timeline-body">
                    Perhatikan jadwal Seminar PKL. Jika Anda ingin mengajukan jadwal seminar (Seminar PKL Tak Terjadwal), silahkan lakukan pendaftaran. Jika tidak, maka jadwal seminar akan diatur oleh Koordinator (Seminar PKL Terjadwal).
                  </div>
                  <div class="timeline-footer">
                    <a href="/seminar" class="btn btn-primary btn-sm">Lihat Info Seminar</a>
                  </div>
                </div>
              </div>
              @endif
              <!-- END timeline item -->

              <!-- timeline item -->
              @if ($mahasiswa->status == 'Aktif' || $mahasiswa->status == 'Lulus')
              <div>
                <i class="fas bi bi-check-circle-fill bg-green"></i>
                <div class="timeline-item">
                  <span class="time"><i class="fas bi bi-clock"></i> ~</span>
                  <h3 class="timeline-header no-border"><a href="javascript:void(0)">Koordinator</a> telah menerima Registrasi PKL Anda</h3>
                </div>
              </div>
              @endif
              <!-- END timeline item -->

              <!-- timeline item -->
              @if ($mahasiswa->status == 'Nonaktif' && $pkl->status == 'Praregistrasi' && $pkl->pesan != null)
              <div>
                <i class="fas bi bi-exclamation-circle-fill bg-pink"></i>
                <div class="timeline-item">
                  <span class="time"><i class="fas bi bi-clock"></i> ~</span>
                  <h3 class="timeline-header"><a href="javascript:void(0)">Koordinator</a> telah menolak Registrasi PKL Anda</h3>
                  <div class="timeline-body">
                    Pesan: <em>“{{ $pkl->pesan }}”</em>
                  </div>
                  <div class="timeline-footer">
                    <a href="/registrasi" class="btn btn-primary btn-sm">Registrasi Ulang</a>
                  </div>
                </div>
              </div>
              @endif
              <!-- END timeline item -->

              <!-- timeline item -->
              @if ($pkl != null && $pkl->tgl_registrasi != null)
              <div>
                <i class="fas bi bi-send-check-fill bg-blue"></i>
                <div class="timeline-item">
                  <span class="time"><i class="fas bi bi-clock"></i> {{ Carbon\Carbon::parse($pkl->tgl_registrasi)->diffForHumans() }}</span>
                  <h3 class="timeline-header no-border"><a href="javascript:void(0)">Anda</a> telah mengirim Registrasi PKL</h3>
                </div>
              </div>
              @endif
              <!-- END timeline item -->
              
              <!-- timeline item -->
              {{-- @if ($mahasiswa->status == 'Nonaktif') --}}
              <div>
                <i class="fas bi bi-info-circle-fill bg-info"></i>
                <div class="timeline-item">
                  <span class="time"><i class="fas bi bi-clock"></i> ~</span>
                  <h3 class="timeline-header"><a href="javascript:void(0)" class="text-info">Registrasi PKL</a></h3>
                  <div class="timeline-body">
                    Lakukan registrasi PKL segera setelah Anda mengambil IRS, sebagai bukti bahwa Anda telah mengambil PKL.
                  </div>
                  {{-- <div class="timeline-footer">
                    <a href="/registrasi" class="btn btn-primary btn-sm">Registrasi Sekarang</a>
                  </div> --}}
                </div>
              </div>
              {{-- @endif --}}
              <!-- END timeline item -->
              
              <!-- timeline item -->
              @if ($mahasiswa->id_dospem != null)
              <div>
                <i class="fas bi bi-people-fill bg-green"></i>
                <div class="timeline-item">
                  <span class="time"><i class="fas bi bi-clock"></i> ~</span>
                  <h3 class="timeline-header"><a href="javascript:void(0)">Koordinator</a> telah membagikan Dosen Pembimbing</h3>
                  <div class="timeline-body">
                    Dosen Pembimbing Anda: {{ $mahasiswa->dosen_pembimbing->nama }}
                  </div>
                  <div class="timeline-footer">
                    <a href="/profile" class="btn btn-primary btn-sm">Periksa Profil</a>
                  </div>
                </div>
              </div>
              @endif
              <!-- END timeline item -->

              <!-- timeline item -->
              <div>
                <i class="fas bi bi-info-circle-fill bg-info"></i>
                <div class="timeline-item">
                  <span class="time"><i class="fas bi bi-clock"></i> {{ $created_at }}</span>
                  <h3 class="timeline-header no-border"><a href="javascript:void(0)" class="text-info">Koordinator</a> telah menambahkan Anda ke Sistem</h3>
                </div>
              </div>
              <!-- END timeline item -->
              
              <!-- timeline time label -->
              {{-- <div class="time-label">
                <span class="bg-green"><i class="bi bi-arrow-up-circle-fill mx-3"></i></span>
              </div> --}}
              <!-- /.timeline-label -->
              <!-- timeline item -->
              {{-- <div>
                <i class="fas bi bi-camera-video-fill bg-maroon"></i>
                <div class="timeline-item">
                  <span class="time"><i class="fas bi bi-clock"></i> {{ $created_at }}</span>
                  <h3 class="timeline-header"><a href="javascript:void(0)">Car</a></h3>
                  <div class="timeline-body">
                    <div class="embed-responsive embed-responsive-16by9">
                      <iframe class="embed-responsive-item" src="https://giphy.com/embed/MDJ9IbxxvDUQM" allowfullscreen></iframe>
                    </div>
                  </div>
                  <div class="timeline-footer">
                    <a href="javascript:void(0)" class="btn btn-sm bg-maroon">Selamat Datang!</a>
                  </div>
                </div>
              </div> --}}
              <!-- END timeline item -->
              
              <div>
                <i class="fas bi bi-clock bg-gray"></i>
              </div>
            </div>

          </div>

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row (main row) -->

      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h4 class="text-center">Pengumuman</h4>
              <div class="row">
                <div class="col-auto mb-2 d-flex align-items-center">
                  {{-- <strong class="mr-3 text-lightblue">Action:</strong> --}}
                  {{-- <button type="button" id="refreshPengumumanBtn" class="btn btn-primary btn-sm">
                    Refresh
                  </button> --}}
                </div>
              </div>
              <div class="table-responsive pt-1" id="tabel-pengumuman">
                <table class="table text-center" id="tabelPengumuman">
                  <thead>
                      <tr class="table-primary">
                        <th style="white-space: nowrap; width: 1%">No</th>
                        <th class="tanggal">Tanggal</th>
                        <th>Deskripsi</th>
                        <th class="lampiran" style="white-space: nowrap; width: 1%">Lampiran</th>
                      </tr>
                  </thead>
                  <tbody>
                    @foreach ($data_pengumuman as $pengumuman)
                      <tr>
                        <td></td>
                        <td>{{ $pengumuman->updated_at }}</td>
                        <td>{{ $pengumuman->deskripsi }}</td>
                        <td class="py-0 align-middle">
                          <a href="{{ $pengumuman->lampiran }}" class="btn btn-primary btn-sm">Download</a>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /.row () -->
      
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h4 class="text-center">Dokumen</h4>
              <div class="row">
                <div class="col-auto mb-2 d-flex align-items-center">
                  {{-- <strong class="mr-3 text-lightblue">Action:</strong> --}}
                  {{-- <button type="button" id="refreshDokumenBtn" class="btn btn-primary btn-sm">
                    Refresh
                  </button> --}}
                </div>
              </div>
              <div class="table-responsive pt-1" id="tabel-dokumen">
                <table class="table text-center" id="tabelDokumen" style="width: 100%">
                  <thead>
                      <tr class="table-primary">
                        <th style="white-space: nowrap; width: 1%">No</th>
                        <th class="tanggal hidden">Tanggal</th>
                        <th>Deskripsi</th>
                        <th class="lampiran" style="white-space: nowrap; width: 1%">Lampiran</th>
                      </tr>
                  </thead>
                  <tbody>
                    @foreach ($data_dokumen as $dokumen)
                      <tr>
                        <td></td>
                        <td>{{ $dokumen->updated_at }}</td>
                        <td>{{ $dokumen->deskripsi }}</td>
                        <td class="py-0 align-middle">
                          <a href="{{ $dokumen->lampiran }}" class="btn btn-primary btn-sm">Download</a>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /.row () -->

    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
@endsection

@push('scripts')
  <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
  <script src="/lte/plugins/moment/moment.min.js"></script>
  <script src="/lte/plugins/moment/locale/id.js"></script>
  <script type="text/javascript">
    function dataTableInit(idTable) {
      const table = new DataTable(idTable, {
				columnDefs: [
					{
						targets: [0,"lampiran"],
						searchable: false,
						orderable: false,
					},
          {
            target: 'tanggal',
            render: DataTable.render.datetime("D MMMM YYYY", "id"),
          },
          {
            target: 'hidden',
            visible: false,
            searchable: false
          },
				],
				order: [[1, 'asc']],
				lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
				pageLength: 10,
        // language: {
        //   url: 'https://cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json',
        // },
      });
			$(idTable+'_filter input').css('width', '200px');
			table.on('order.dt search.dt', function () {
				let i = 1;
				table
					.cells(null, 0, { search: 'applied', order: 'applied' })
					.every(function (cell) {
							this.data(i++);
					});
			}).draw();
    }

		$(document).ready(function() {
      dataTableInit('#tabelPengumuman');
      dataTableInit('#tabelDokumen');
		});

    $('#collapseTimeline').on('show.bs.collapse', function () {
      $('#collapseTimelineBtn').text('Sembunyikan Timeline');
    });
    $('#collapseTimeline').on('hide.bs.collapse', function () {
      $('#collapseTimelineBtn').text('Tampilkan Timeline');
    });
	</script>


  @if (session()->has('success'))
    <script type="text/javascript">
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        },
      })
      Toast.fire({
        icon: 'success',
        title: '{{ session('success') }}',
      })
    </script>
  @endif
@endpush
