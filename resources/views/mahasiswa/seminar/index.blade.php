@extends('layouts.main_mhs')

@push('styles')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.11.6/viewer.css" integrity="sha512-eG8C/4QWvW9MQKJNw2Xzr0KW7IcfBSxljko82RuSs613uOAg/jHEeuez4dfFgto1u6SRI/nXmTr9YPCjs1ozBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link href="https://cdn.jsdelivr.net/npm/filepond@4/dist/filepond.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/filepond-plugin-image-preview@4/dist/filepond-plugin-image-preview.min.css" rel="stylesheet" />
  <style>
    /* .filepond--root, */
    .filepond--root .filepond--drop-label {
      height: 150px;
      color: inherit;
    }
    /* bordered drop area */
    .filepond--panel-root {
      background-color: transparent;
      border: 2px dashed #ced4da;
    }
  </style>
@endpush

@section('container')
	<!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col">
          <h1 class="m-0">Seminar PKL</h1>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card card-primary card-outline">
            <div class="card-body">

              @if ($seminar_pkl != null && $seminar_pkl->pesan != null)
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                  <button type="button" class="close" data-bs-dismiss="alert" aria-hidden="true" aria-label="Close">&times;</button>
                  <h5><strong><i class="icon bi bi-exclamation-triangle-fill"></i> Perhatian!</strong></h5>
                  Registrasi Seminar PKL Anda ditolak. Silahkan daftar ulang. Pesan: <strong><em>“{{ $seminar_pkl->pesan }}”</em></strong>&nbsp;&nbsp;
                  <button type="button" id="btn-daftar-ulang" class="btn btn-primary btn-sm py-0">Daftar Ulang</button>
                </div>
              @endif

              <div class="row">
                <div class="col d-flex align-items-center justify-content-between gap-1">
                  <strong class="text-lightblue my-3">Informasi Jadwal Seminar PKL Saya</strong>
                  <button type="button" id="btn-daftar" class="btn btn-primary @if ($seminar_pkl != null && $seminar_pkl->pesan == null) d-none @endif">Daftar Seminar</button>
                </div>
              </div>

              <div class="table-responsive p-0 mb-3">
                <table class="table table-hover">
                  <tbody>
                    @if ($seminar_pkl == null)
                    <tr>
                      <td class="text-nowrap px-0 text-center" style="white-space: nowrap; width: 1%"><strong class="text-warning">Tidak tersedia</strong></td>
                    </tr>

                    @else
                    <tr>
                      <td class="text-nowrap px-0" style="width: 20%"><strong>Status</strong></td>
                      <td style="white-space: nowrap; width: 1%">:</td>
                      @if ($seminar_pkl->status == 'Pengajuan')
                        @if ($seminar_pkl->pesan == null)
                          <td><strong class="bg-warning px-2 py-1 rounded-1 text-nowrap">Menunggu Persetujuan</strong></td>
                        @else
                          <td><strong class="bg-danger px-2 py-1 rounded-1 text-nowrap">Pengajuan Ditolak</strong></td>
                        @endif
                      @else
                        <td><strong class="bg-success px-2 py-1 rounded-1 text-nowrap">Terdaftar</strong></td>
                      @endif
                    </tr>
                    <tr>
                      <td class="text-nowrap px-0"><strong>Hari, Tanggal Seminar</strong></td>
                      <td style="white-space: nowrap; width: 1%">:</td>
                      <td>{{ $hari_tgl_seminar }}</td>
                    </tr>
                    <tr>
                      <td class="text-nowrap px-0"><strong>Waktu Seminar</strong></td>
                      <td style="white-space: nowrap; width: 1%">:</td>
                      <td>{{ $seminar_pkl->waktu_seminar }}</td>
                    </tr>
                    <tr>
                      <td class="text-nowrap px-0"><strong>Ruang</strong></td>
                      <td style="white-space: nowrap; width: 1%">:</td>
                      <td>{{ $seminar_pkl->ruang }}</td>
                    </tr>
                    <tr>
                      <td class="text-nowrap px-0" colspan="3"><strong>Scan Surat Layak Seminar</strong> &nbsp;<a href="/preview/{{ $seminar_pkl->scan_layak_seminar }}" target="_blank" class="btn btn-outline-info btn-sm py-0 btnScanLayakSeminar @if ($seminar_pkl->scan_layak_seminar == null) disabled @endif">Lihat Scan</a></td>
                    </tr>
                    <tr>
                      <td class="text-nowrap px-0" colspan="3"><strong>Scan Surat Peminjaman Ruang</strong> &nbsp;<a href="/preview/{{ $seminar_pkl->scan_peminjaman_ruang }}" target="_blank" class="btn btn-outline-info btn-sm py-0 scanPeminjamanRuang @if ($seminar_pkl->scan_peminjaman_ruang == null) disabled @endif">Lihat Scan</a></td>
                    </tr>
                    <tr>
                    @endif

                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->

              <img id="scanImg" src="" alt="Picture" style="display:none;">
              
              <div class="row">
                <div class="col-md-6">
                  <p><strong class="text-lightblue">Dosen Pembimbing</strong></p>
                  <div class="table-responsive p-0 mb-3">
                    <table class="table table-hover">
                      <tbody>
        
                        @if ($mahasiswa->id_dospem == null)
                        <tr>
                          <td class="text-nowrap px-0 text-center" style="white-space: nowrap; width: 1%"><strong class="text-warning">Tidak tersedia</strong></td>
                        </tr>
                        @else
                        <tr>
                          <td class="text-nowrap px-0" style="white-space: nowrap; width: 1%"><strong>Nama</strong></td>
                          <td style="white-space: nowrap; width: 1%">:</td>
                          <td>{{ $mahasiswa->dosen_pembimbing->nama }}</td>
                        </tr>
                        <tr>
                          <td class="text-nowrap px-0" style="white-space: nowrap; width: 1%"><strong>NIP</strong></td>
                          <td style="white-space: nowrap; width: 1%">:</td>
                          <td>{{ $mahasiswa->dosen_pembimbing->nip }} </td>
                        </tr>
                        @endif
        
                      </tbody>
                    </table>
    
                  </div>
                  <!-- /.table-responsive -->

                </div>
                <div class="col-md-6">
                  <p><strong class="text-lightblue">Data PKL</strong></p>
                  <div class="table-responsive p-0 mb-3">
                    <table class="table table-hover">
                      <tbody>
        
                        @if ($mahasiswa->pkl == null)
                          <tr>
                            <td class="text-nowrap px-0 text-center" style="white-space: nowrap; width: 1%"><strong class="text-warning">Tidak tersedia</strong></td>
                          </tr>
                        @else
                          <tr>
                            <td class="text-nowrap px-0" style="white-space: nowrap; width: 1%"><strong>Instansi</strong></td>
                            <td style="white-space: nowrap; width: 1%">:</td>
                            <td>{{ $mahasiswa->pkl->instansi }}</td>
                          </tr>
                          <tr>
                            <td class="text-nowrap px-0" style="white-space: nowrap; width: 1%"><strong>Judul</strong></td>
                            <td style="white-space: nowrap; width: 1%">:</td>
                            <td>{{ $mahasiswa->pkl->judul }} </td>
                          </tr>
                        @endif
        
                      </tbody>
                    </table>
    
                  </div>
                  <!-- /.table-responsive -->

                </div>
              </div>

            </div>
          </div>
          <!-- /.card -->

        </div>


        
        <div class="col-12">
          <div class="card card-primary collapsed-card" id="form-section">
            <div class="card-header">
              @if ($seminar_pkl == null || ($seminar_pkl->pesan != null))
              <h3 class="card-title">Form Pendaftaran Seminar PKL</h3>
              @else
              <h3 class="card-title">Ganti Jadwal Seminar</h3>
              @endif
              <div class="card-tools">
                <a href="#form-section" class="btn btn-tool" id="btn-form" data-card-widget="collapse"><i class="bi bi-plus fs-4"></i>
                </a>
              </div>
              <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">

              @if ($seminar_pkl == null)
              <!-- form start -->
              <form action="/seminar/daftar" class="needs-validation" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="nama">Nama</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                        </div>
                        <input type="text" class="form-control" id="nama" value="{{ $mahasiswa->nama }}" readonly>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="nim">NIM</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="bi bi-person-vcard-fill"></i></span>
                        </div>
                        <input type="text" class="form-control" id="nim" name="nim" value="{{ $mahasiswa->nim }}" readonly>
                      </div>
                    </div>
                    <input type="text" class="form-control" id="id_dospem" name="id_dospem" value="{{ $mahasiswa->id_dospem }}" hidden>
                    {{-- <input type="text" class="form-control" id="nip_dospem" name="nip_dospem" value="{{ $mahasiswa->dosen_pembimbing->nip }}" hidden> --}}
                    <div class="form-group">
                      <label for="nama_dospem">Dosen Pembimbing</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="bi bi-person-check-fill"></i></span>
                        </div>
                        <input type="text" class="form-control" id="nama_dospem" name="nama_dospem" value="{{ ($mahasiswa->dosen_pembimbing == null)?'':$mahasiswa->dosen_pembimbing->nama }}" readonly>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="tgl_seminar">Tanggal Seminar</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="bi bi-calendar-event-fill"></i></span>
                        </div>
                        <input type="date" class="form-control @error('tgl_seminar') is-invalid @enderror" id="tgl_seminar" name="tgl_seminar" value="{{ old('tgl_seminar') }}">
                        @error('tgl_seminar')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="pukul_seminar">Waktu Seminar (Mulai - Selesai)</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="bi bi-clock-fill"></i></span>
                        </div>
                        <input type="time" step="600" class="form-control @error('waktu_seminar_mulai') is-invalid @enderror" id="waktu_seminar_mulai" name="waktu_seminar_mulai" value="{{ old('waktu_seminar_mulai') }}">
                        <span class="input-group-text"><i class="bi bi-dash"></i></span>
                        <input type="time" step="600" class="form-control @error('waktu_seminar_selesai') is-invalid @enderror" id="waktu_seminar_selesai" name="waktu_seminar_selesai" value="{{ old('waktu_seminar_selesai') }}">
                        @error('waktu_seminar_mulai')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                        @error('waktu_seminar_selesai')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="ruang">Ruang Seminar</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="bi bi-pin-map-fill"></i></span>
                        </div>
                        <input type="text" class="form-control @error('ruang') is-invalid @enderror" id="ruang" name="ruang" placeholder="Contoh: A101" value="{{ old('ruang') }}">
                        @error('ruang')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                      </div>
                    </div>
                  </div>
                </div>

                <div class="callout callout-warning text-secondary">
                  {{-- <p>Follow the steps to continue to payment.</p> --}}
                  <em>*Lampirkan Scan Surat</em>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="scan_layak_seminar">Scan Surat Layak Seminar (jpg/png maks 500KB)</label>
                      <input type="file" class="@error('scan_layak_seminar') is-invalid @enderror" id="scan_layak_seminar" name="scan_layak_seminar">
                      @error('scan_layak_seminar')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="scan_peminjaman_ruang">Scan Surat Peminjaman Ruang (jpg/png maks 500KB)</label>
                      <input type="file" class="@error('scan_peminjaman_ruang') is-invalid @enderror" id="scan_peminjaman_ruang" name="scan_peminjaman_ruang">
                      @error('scan_peminjaman_ruang')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="form-check ms-1 mb-3">
                  <input type="checkbox" class="form-check-input" id="checkbox1">
                  <label class="form-check-label" for="checkbox1"><em>Pastikan semua data sudah benar, dan scan dapat dibaca dengan jelas.</em></label>
                </div>
                <button type="submit" class="btn btn-primary">Kirim</button>
              </form>
              <!-- /form end -->
                
              @else
              <!-- form start -->
              <form action="/seminar/daftar_ulang" class="needs-validation" method="post" enctype="multipart/form-data">
                @csrf
                @if ($seminar_pkl->pesan != null)
                <div class="row">
                  <div class="col">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                      <button type="button" class="close" data-bs-dismiss="alert" aria-hidden="true" aria-label="Close">&times;</button>
                      <i class="icon bi bi-exclamation-triangle-fill"></i>Pesan: <strong><em>“{{ $seminar_pkl->pesan }}”</em></strong>
                    </div>
                  </div>
                </div>
                @endif
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="nama">Nama</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                        </div>
                        <input type="text" class="form-control" id="nama" value="{{ $mahasiswa->nama }}" readonly>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="nim">NIM</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="bi bi-person-vcard-fill"></i></span>
                        </div>
                        <input type="text" class="form-control" id="nim" name="nim" value="{{ $mahasiswa->nim }}" readonly>
                      </div>
                    </div>
                    <input type="text" class="form-control" id="id_dospem" name="id_dospem" value="{{ $mahasiswa->id_dospem }}" hidden>
                    {{-- <input type="text" class="form-control" id="nip_dospem" name="nip_dospem" value="{{ $mahasiswa->dosen_pembimbing->nip }}" hidden> --}}
                    <div class="form-group">
                      <label for="nama_dospem">Dosen Pembimbing</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="bi bi-person-check-fill"></i></span>
                        </div>
                        <input type="text" class="form-control" id="nama_dospem" name="nama_dospem" value="{{ ($mahasiswa->dosen_pembimbing == null)?'':$mahasiswa->dosen_pembimbing->nama }}" readonly>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="tgl_seminar">Tanggal Seminar</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="bi bi-calendar-event-fill"></i></span>
                        </div>
                        <input type="date" class="form-control @error('tgl_seminar') is-invalid @enderror" id="tgl_seminar" name="tgl_seminar" value="{{ old('tgl_seminar',$seminar_pkl->tgl_seminar) }}">
                        @error('tgl_seminar')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="pukul_seminar">Waktu Seminar (Mulai - Selesai)</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="bi bi-clock-fill"></i></span>
                        </div>
                        <input type="time" step="600" class="form-control @error('waktu_seminar_mulai') is-invalid @enderror" id="waktu_seminar_mulai" name="waktu_seminar_mulai" value="{{ old('waktu_seminar_mulai',substr($seminar_pkl->waktu_seminar,0,5)) }}">
                        <span class="input-group-text"><i class="bi bi-dash"></i></span>
                        <input type="time" step="600" class="form-control @error('waktu_seminar_selesai') is-invalid @enderror" id="waktu_seminar_selesai" name="waktu_seminar_selesai" value="{{ old('waktu_seminar_selesai',substr($seminar_pkl->waktu_seminar,6,10)) }}">
                        @error('waktu_seminar_mulai')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                        @error('waktu_seminar_selesai')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="ruang">Ruang Seminar</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="bi bi-pin-map-fill"></i></span>
                        </div>
                        <input type="text" class="form-control @error('ruang') is-invalid @enderror" id="ruang" name="ruang" placeholder="Contoh: A101" value="{{ old('ruang',$seminar_pkl->ruang) }}">
                        @error('ruang')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="scan_layak_seminar">Scan Surat Layak Seminar (jpg/png maks 500KB)</label>
  
                      @if ($seminar_pkl->scan_layak_seminar != null)
                      <input type="text" class="form-control" id="scan_layak_seminar_old" name="scan_layak_seminar_old" value="{{ $seminar_pkl->scan_layak_seminar }}" hidden>
                      <div class=" mb-2">
                        <a href="/preview/{{ $seminar_pkl->scan_layak_seminar }}" target="_blank" class="btn btn-outline-info btn-sm btnScanLayakSeminar">Lihat scan lama</a>
                      </div>
                      @endif

                      <input type="file" class="@error('scan_layak_seminar') is-invalid @enderror" id="scan_layak_seminar" name="scan_layak_seminar">
                      @error('scan_layak_seminar')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="scan_peminjaman_ruang">Scan Surat Peminjaman Ruang (jpg/png maks 500KB)</label>

                      @if ($seminar_pkl->scan_peminjaman_ruang != null)
                      <input type="text" class="form-control" id="scan_peminjaman_ruang_old" name="scan_peminjaman_ruang_old" value="{{ $seminar_pkl->scan_peminjaman_ruang }}" hidden>
                      <div class=" mb-2">
                        <a href="/preview/{{ $seminar_pkl->scan_peminjaman_ruang }}" target="_blank" class="btn btn-outline-info btn-sm scanPeminjamanRuang">Lihat scan lama</a>
                      </div>
                      @endif

                      <input type="file" class="@error('scan_peminjaman_ruang') is-invalid @enderror" id="scan_peminjaman_ruang" name="scan_peminjaman_ruang">
                      @error('scan_peminjaman_ruang')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                  </div>
                </div>

                <div class="form-check ms-1 mb-3">
                  <input type="checkbox" class="form-check-input" id="checkbox1">
                  <label class="form-check-label" for="checkbox1"><em>Pastikan semua data sudah benar, dan scan dapat dibaca dengan jelas.</em></label>
                </div>
                <!-- /form di bawah -->
                <button type="submit" class="btn btn-primary">Kirim</button>
              </form>
              @endif
              
            </div>
            <!-- /.card-body -->
            {{-- <div class="card-footer">
            </div> --}}
          </div>
          <!-- /.card -->
        </div>
        
        
      </div>

    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->

@endsection

@push('scripts')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.11.6/viewer.min.js" integrity="sha512-EC3CQ+2OkM+ZKsM1dbFAB6OGEPKRxi6EDRnZW9ys8LghQRAq6cXPUgXCCujmDrXdodGXX9bqaaCRtwj4h4wgSQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script type="text/javascript">
    var scanImg = $('#scanImg')[0];
    $('.btnScanLayakSeminar, .scanPeminjamanRuang').click(function(e){
      e.preventDefault();
      scanImg.src = $(this).attr('href');
      // Inisialisasi Viewer.js
      var viewer = new Viewer(scanImg, {
        hidden: function () {
          viewer.destroy();
        },
      });
      viewer.show();
    });
  </script>

{{-- @if ($seminar_pkl == null || ($seminar_pkl->pesan != null)) --}}
  <script type="text/javascript">
    $('#waktu_seminar_mulai').step = 600;


    function goToForm() {
      setTimeout(() => {
        document.querySelector($('#btn-form').attr('href')).scrollIntoView({
          behavior: "smooth",
          offsetTop: 1 - 60,
        });
        $('#btn-daftar').prop('disabled', false);
      }, 500);
    }
    $('#btn-daftar').click(function() {
      $(this).prop('disabled', true);
      $('#btn-form').click();
    })
    $('#btn-form').click(function() {
      if ($('#form-section').hasClass('collapsed-card')) {
        $('#btn-daftar').removeClass('btn-primary');
        $('#btn-daftar').addClass('btn-secondary');
        $('#btn-daftar').html('Tutup');
        goToForm();
      } else {
        $('#btn-daftar').removeClass('btn-secondary');
        $('#btn-daftar').addClass('btn-primary');
        $('#btn-daftar').html('Daftar');
        setTimeout(() => {
          $('#btn-daftar').prop('disabled', false);
        }, 500);
      }
    });
    $('#btn-daftar-ulang').click(function() {
      $(this).prop('disabled', true);
      if ($('#form-section').hasClass('collapsed-card')) {
        $('#btn-form').click();
      }
      goToForm();
      setTimeout(() => {
        $('#btn-daftar-ulang').prop('disabled', false);
      }, 500);
    })


    if ($("#checkbox1").checked) {
      $('button[type=submit]').prop('disabled', false);
    } else {
      $('button[type=submit]').prop('disabled', true);
    }
    $("#checkbox1").change(function() {
      if(this.checked) {
        this.classList.add('is-valid');
        $('button[type=submit]').prop('disabled', false);
      } else {
        this.classList.remove('is-valid');
        $('button[type=submit]').prop('disabled', true);
      }
    });

    //add alert confirmation before submiting form
		$('button[type=submit]').click(function() {
			event.preventDefault();
			Swal.fire({
				title: 'Apakah data sudah benar?',
				text: "Pastikan semua data sudah benar, dan scan surat dapat dibaca.",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#007bff',
        cancelButtonColor: '#dc3545',
        confirmButtonText: 'Ya, Kirim!',
        cancelButtonText: 'Batal'
			}).then((result) => {
				if (result.isConfirmed) {
					$('form').submit();
				}
			})
		});

    // disable submit button
    $('form').submit(function() {
      // show spinner on button
      $('button[type=submit]').html(`
        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
        Mengirim...
      `);
      $('button[type=submit]').prop('disabled', true);
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/filepond-plugin-file-validate-type@1/dist/filepond-plugin-file-validate-type.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/filepond-plugin-file-validate-size@2/dist/filepond-plugin-file-validate-size.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/filepond-plugin-image-preview@4/dist/filepond-plugin-image-preview.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/filepond@4/dist/filepond.min.js"></script>
  <script type="text/javascript">
    // Register the plugin
    FilePond.registerPlugin(
      FilePondPluginImagePreview,
      FilePondPluginFileValidateType,
      FilePondPluginFileValidateSize,
    );
    // Get a reference to the file input element
    const inputElement = document.querySelector('input[id="scan_layak_seminar"]');
    const inputElement2 = document.querySelector('input[id="scan_peminjaman_ruang"]');
  
    // Create a FilePond instance
    const pond = FilePond.create(inputElement,{
      storeAsFile: true,
      stylePanelLayout: 'compact',
      labelIdle: `<i class="bi bi-upload fs-2"></i><br>Drag & Drop file atau <span class="filepond--label-action">Browse</span>`,
      acceptedFileTypes: ['image/jpg', 'image/jpeg', 'image/png'],
      labelFileTypeNotAllowed: 'File tidak sesuai format',
      fileValidateTypeLabelExpectedTypes: 'Hanya file JPG, JPEG, PNG yang diperbolehkan',
      maxFileSize: '500KB',
      labelMaxFileSizeExceeded: 'Ukuran file terlalu besar',
      labelMaxFileSize: 'Total ukuran maksimum file adalah {filesize}',
      credits: false,
    });
  
    const pond2 = FilePond.create(inputElement2,{
      storeAsFile: true,
      stylePanelLayout: 'compact',
      labelIdle: `<i class="bi bi-upload fs-2"></i><br>Drag & Drop file atau <span class="filepond--label-action">Browse</span>`,
      acceptedFileTypes: ['image/jpg', 'image/jpeg', 'image/png'],
      labelFileTypeNotAllowed: 'File tidak sesuai format',
      fileValidateTypeLabelExpectedTypes: 'Hanya file JPG, JPEG, PNG yang diperbolehkan',
      maxFileSize: '500KB',
      labelMaxFileSizeExceeded: 'Ukuran file terlalu besar',
      labelMaxFileSize: 'Total ukuran maksimum file adalah {filesize}',
      credits: false,
    });
  </script>
{{-- @endif --}}
  
@if (session()->has('fails'))
  <script>
    if ($('#btn-daftar').hasClass('btn-primary')) {
      $('#btn-form').click();
    }
    goToForm();
  </script>
@endif


@if (session()->has('success'))
  <script>
    $(document).ready(function(){
      Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '{{ session('success') }}',
        // showConfirmButton: false,
        timer: 1500
      })
    });
  </script>
@endif
@endpush