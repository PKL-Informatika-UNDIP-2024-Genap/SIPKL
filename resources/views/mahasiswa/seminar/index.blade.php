@extends('layouts.main_mhs')

@push('styles')
  <link href="https://cdn.jsdelivr.net/npm/filepond@4/dist/filepond.min.css" rel="stylesheet" />
  <style>
    /* .filepond--root, */
    .filepond--root .filepond--drop-label {
      height: 150px;
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
        <div class="col-sm-6">
          <h1 class="m-0">Seminar PKL</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item active">Seminar PKL</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-xl-6 col-md-7">
          <div class="card card-primary card-outline">
            {{-- <div class="card-header">
            </div> --}}
    
            <div class="card-body">
              @if ($seminar_pkl != null && $seminar_pkl->pesan != null)
              <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-bs-dismiss="alert" aria-hidden="true" aria-label="Close">&times;</button>
                <h5><strong><i class="icon bi bi-exclamation-triangle-fill"></i> Perhatian!</strong></h5>
                Registrasi Seminar PKL Anda ditolak. Silahkan daftar ulang. Pesan: <strong><em>“{{ $seminar_pkl->pesan }}”</em></strong>&nbsp;&nbsp;
                <button type="button" id="btn-daftar-ulang" class="btn btn-primary btn-sm py-0">Daftar Ulang</button>
              </div>
              @endif

              <p><strong class="text-lightblue">Informasi Jadwal Seminar PKL Saya</strong></p>
              <div class="table-responsive p-0 mb-3">
                <table class="table table-hover">
                  <tbody>
                    @if ($seminar_pkl == null)
                    <tr>
                      <td class="text-nowrap px-0 text-center" style="white-space: nowrap; width: 1%"><strong>Belum ada</strong></td>
                    </tr>

                    @else
                    <tr>
                      <td class="text-nowrap px-0" style="width: 20%"><strong>Status</strong></td>
                      <td style="white-space: nowrap; width: 1%">:</td>
                      <td><strong class="{{ ($seminar_pkl->status == 'Pengajuan')?'bg-primary':'bg-success' }} px-2 py-1 rounded-1">{{ $seminar_pkl->status }}</strong></td>
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
                    {{-- <tr>
                      <td class="text-nowrap px-0"><strong>Keterangan</strong></td>
                      <td style="white-space: nowrap; width: 1%">:</td>
                      <td>@if ($seminar_pkl->status == 'Pengajuan' && $seminar_pkl->pesan == null)
                        <strong class="text-primary">Menunggu persetujuan pengajuan Seminar Tak Terjadwal oleh Koordinator PKL.</strong>
                        @elseif ($seminar_pkl->status == 'Pengajuan' && $seminar_pkl->pesan != null)
                        <strong class="text-warning">Pengajuan Seminar Tak Terjadwal ditolak. Silahkan daftar lagi.</strong>
                        @elseif ($seminar_pkl->status == 'TakTerjadwal')
                        <strong class="text-success">Pengajuan Seminar Tak Terjadwal telah disetujui.</strong>
                        @else
                        <strong class="text-success">Anda terdaftar dalam Seminar Terjadwal.</strong>
                        @endif
                      </td>
                    </tr> --}}
                    <tr>
                      <td class="text-nowrap px-0" colspan="3"><strong>Scan Surat Layak Seminar</strong> &nbsp;<a href="/preview/{{ $seminar_pkl->scan_layak_seminar }}" target="_blank" class="btn btn-outline-info btn-sm py-0">Lihat File</a></td>
                    </tr>
                    <tr>
                      <td class="text-nowrap px-0" colspan="3"><strong>Scan Surat Peminjaman Ruang</strong> &nbsp;<a href="/preview/{{ $seminar_pkl->scan_peminjaman_ruang }}" target="_blank" class="btn btn-outline-info btn-sm py-0">Lihat File</a></td>
                    </tr>
                    <tr>
                    @endif

                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->

              <p><strong class="text-lightblue">Dosen Pembimbing</strong></p>
              <div class="table-responsive p-0 mb-3">
                <table class="table table-hover">
                  <tbody>
    
                    @if ($mahasiswa->id_dospem == null)
                    <tr>
                      <td class="text-nowrap px-0 text-center" style="white-space: nowrap; width: 1%"><strong>Belum ada</strong></td>
                    </tr>
                    @else
                    <tr>
                      <td class="text-nowrap px-0" style="white-space: nowrap; width: 1%"><strong>NIP</strong></td>
                      <td style="white-space: nowrap; width: 1%">:</td>
                      <td>{{ $mahasiswa->dosen_pembimbing->nama }}</td>
                    </tr>
                    <tr>
                      <td class="text-nowrap px-0" style="white-space: nowrap; width: 1%"><strong>Nama</strong></td>
                      <td style="white-space: nowrap; width: 1%">:</td>
                      <td>{{ $mahasiswa->dosen_pembimbing->nip }} </td>
                    </tr>
                    @endif
    
                  </tbody>
                </table>

              </div>
              <!-- /.table-responsive -->

              @if ($seminar_pkl == null || ($seminar_pkl->pesan != null))
              <p>Ingin mengajukan Seminar PKL Tak Terjadwal? Silahkan daftar dengan mengisi form berikut ini. (Tidak wajib)</p><p>Anda akan dimasukkan ke Seminar Terjadwal jika tidak melakukan pendaftaran.</p>
              <button type="button" id="btn-daftar" class="btn btn-primary">Daftar</button>
              @endif
    
            </div>
          </div>
          <!-- /.card -->

        </div>

        <div class="col-xl-6 col-md-5">
          <div class="card card-primary card-outline">
            {{-- <div class="card-header">
            </div> --}}
            <div class="card-body">
              <p><strong class="text-lightblue">Catatan</strong></p>
              <dl>
                <dt>Status <span class="text-primary">Pengajuan</span></dt>
                <dd>Menunggu persetujuan dari Koordinator PKL mengenai pengajuan Seminar Tak Terjadwal.</dd>
                <dt>Status <span class="text-success">TakTerjadwal</span></dt>
                <dd>Terdaftar dalam Seminar Tak Terjadwal.</dd>
                <dt>Status <span class="text-success">Terjadwal</span></dt>
                <dd>Terdaftar dalam Seminar Terjadwal.</dd>
              </dl>
    
              <blockquote>
                <p><em>“Hope For The Best, Prepare For The Worst”</em></p>
                <small>— <cite title="Source Title">Random dude</cite></small>
              </blockquote>
            </div>
          </div>
          <!-- /.card -->

          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Jadwal Seminar PKL Terjadwal dan Tak Terjadwal</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <p><strong class="text-teal">Jadwal Seminar Terjadwal</strong></p>
              
              <p><strong class="text-teal">Jadwal Seminar Tak Terjadwal</strong></p>
            </div>
            <!-- /.card-body -->
            {{-- <div class="card-footer">
              <button type="submit" class="btn btn-primary">Kirim</button>
            </div> --}}
          </div>
          <!-- /.card -->
          
        </div>

        @if ($seminar_pkl == null || ($seminar_pkl->pesan != null))
        <div class="col-12" id="form-section">
          <div class="card card-primary collapsed-card">
            <div class="card-header">
              <h3 class="card-title">Form Pendaftaran Seminar PKL Tak Terjadwal</h3>
      
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
                        <input type="text" class="form-control" id="nama_dospem" name="nama_dospem" value="{{ $mahasiswa->dosen_pembimbing->nama }}" readonly>
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
                        <input type="time" class="form-control @error('waktu_seminar_mulai') is-invalid @enderror" id="waktu_seminar_mulai" name="waktu_seminar_mulai" value="{{ old('waktu_seminar_mulai') }}">
                        <span class="input-group-text"><i class="bi bi-dash"></i></span>
                        <input type="time" class="form-control @error('waktu_seminar_selesai') is-invalid @enderror" id="waktu_seminar_selesai" name="waktu_seminar_selesai" value="{{ old('waktu_seminar_selesai') }}">
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
                      <label for="scan_layak_seminar">Scan Surat Layak Seminar (pdf)</label>
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
                      <label for="scan_peminjaman_ruang">Scan Surat Peminjaman Ruang (pdf)</label>
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
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                  <button type="button" class="close" data-bs-dismiss="alert" aria-hidden="true" aria-label="Close">&times;</button>
                  <h5><strong><i class="icon bi bi-exclamation-triangle-fill"></i> Perhatian!</strong></h5>
                  Pesan: <strong><em>“{{ $seminar_pkl->pesan }}”</em></strong>
                </div>
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
                        <input type="text" class="form-control" id="nama_dospem" name="nama_dospem" value="{{ $mahasiswa->dosen_pembimbing->nama }}" readonly>
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
                        <input type="time" class="form-control @error('waktu_seminar_mulai') is-invalid @enderror" id="waktu_seminar_mulai" name="waktu_seminar_mulai" value="{{ old('waktu_seminar_mulai',substr($seminar_pkl->waktu_seminar,0,5)) }}">
                        <span class="input-group-text"><i class="bi bi-dash"></i></span>
                        <input type="time" class="form-control @error('waktu_seminar_selesai') is-invalid @enderror" id="waktu_seminar_selesai" name="waktu_seminar_selesai" value="{{ old('waktu_seminar_selesai',substr($seminar_pkl->waktu_seminar,6,10)) }}">
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
                      <label for="scan_layak_seminar">Scan Surat Layak Seminar (pdf)</label>
  
                      @if ($seminar_pkl->scan_layak_seminar != null)
                      <input type="text" class="form-control" id="scan_layak_seminar_old" name="scan_layak_seminar_old" value="{{ $seminar_pkl->scan_layak_seminar }}" hidden>
                      <div class=" mb-2">
                        <a href="/preview/{{ $seminar_pkl->scan_layak_seminar }}" target="_blank" class="btn btn-outline-info btn-sm">Lihat scan lama</a>
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
                      <label for="scan_peminjaman_ruang">Scan Surat Peminjaman Ruang (pdf)</label>

                      @if ($seminar_pkl->scan_peminjaman_ruang != null)
                      <input type="text" class="form-control" id="scan_peminjaman_ruang_old" name="scan_peminjaman_ruang_old" value="{{ $seminar_pkl->scan_peminjaman_ruang }}" hidden>
                      <div class=" mb-2">
                        <a href="/preview/{{ $seminar_pkl->scan_peminjaman_ruang }}" target="_blank" class="btn btn-outline-info btn-sm">Lihat scan lama</a>
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
        @endif
        
      </div>

    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->

@endsection

@push('scripts')

{{-- TO DO: modif code like in laporan page --}}
  @if ($seminar_pkl == null || ($seminar_pkl->pesan != null))
  <script type="text/javascript">
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
      if ($('#btn-daftar').hasClass('btn-primary')) {
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
      if ($('#btn-daftar').hasClass('btn-primary')) {
        $('#btn-form').click();
      }
      goToForm();
      setTimeout(() => {
        $('#btn-daftar-ulang').prop('disabled', false);
      }, 500);
    })
  </script>
  <script src="https://cdn.jsdelivr.net/npm/filepond-plugin-file-validate-type@1/dist/filepond-plugin-file-validate-type.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/filepond-plugin-file-validate-size@2/dist/filepond-plugin-file-validate-size.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/filepond@4/dist/filepond.min.js"></script>
  <script type="text/javascript">
    // Register the plugin
    FilePond.registerPlugin(
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
      acceptedFileTypes: ['application/pdf'],
      labelFileTypeNotAllowed: 'File tidak sesuai format',
      fileValidateTypeLabelExpectedTypes: 'Hanya file PDF yang diperbolehkan',
      maxFileSize: '1500KB',
      labelMaxFileSizeExceeded: 'Ukuran file terlalu besar',
      labelMaxFileSize: 'Total ukuran maksimum file adalah {filesize}',
      credits: false,
    });
  
    const pond2 = FilePond.create(inputElement2,{
      storeAsFile: true,
      stylePanelLayout: 'compact',
      labelIdle: `<i class="bi bi-upload fs-2"></i><br>Drag & Drop file atau <span class="filepond--label-action">Browse</span>`,
      acceptedFileTypes: ['application/pdf'],
      labelFileTypeNotAllowed: 'File tidak sesuai format',
      fileValidateTypeLabelExpectedTypes: 'Hanya file PDF yang diperbolehkan',
      maxFileSize: '1500KB',
      labelMaxFileSizeExceeded: 'Ukuran file terlalu besar',
      labelMaxFileSize: 'Total ukuran maksimum file adalah {filesize}',
      credits: false,
    });
  
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
  @endif
  
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