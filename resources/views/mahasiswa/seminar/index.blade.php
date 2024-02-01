@extends('layouts.main_mhs')

@push('styles')
  <link href="https://cdn.jsdelivr.net/npm/filepond@4/dist/filepond.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/filepond-plugin-image-preview@4/dist/filepond-plugin-image-preview.min.css" rel="stylesheet" />

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
      <div class="card card-primary  p-0">
        <div class="card-header">
          <h3 class="card-title">Pendaftaran Seminar PKL Tak Terjadwal</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="bi bi-dash fs-4"></i>
            </button>
          </div>
          <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <!-- form start -->
          <form action="/seminar/daftar" class="needs-validation" method="post" enctype="multipart/form-data">
          @csrf
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
            <input type="text" class="form-control" id="nip_dospem" name="nip_dospem" value="{{ $mahasiswa->nip_dospem }}" hidden>
            <div class="form-group">
              <label for="nama_dospem">Dosen Pembimbing</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="bi bi-person-check-fill"></i></span>
                </div>
                <input type="text" class="form-control" id="nama_dospem" name="nama_dospem" value="{{ $mahasiswa->nama_dospem }}" readonly>
              </div>
            </div>
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
              <label for="pukul_seminar">Rentang Waktu Seminar (Mulai - Selesai)</label>
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
            <div class="callout callout-warning text-secondary">
              {{-- <p>Follow the steps to continue to payment.</p> --}}
              <em>*Lampirkan Scan Surat</em>
            </div>
            <div class="form-group">
              <label for="scan_layak_seminar">Scan Surat Layak Seminar (pdf)</label>
              <input type="file" class="@error('scan_layak_seminar') is-invalid @enderror" id="scan_layak_seminar" name="scan_layak_seminar">
              @error('scan_layak_seminar')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="form-group">
              <label for="scan_peminjaman_ruang">Scan Surat Peminjaman Ruang (pdf)</label>
              <input type="file" class="@error('scan_peminjaman_ruang') is-invalid @enderror" id="scan_peminjaman_ruang" name="scan_peminjaman_ruang">
              @error('scan_peminjaman_ruang')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="form-check ms-1">
              <input type="checkbox" class="form-check-input" id="checkbox1" name="checkbox1">
              <label class="form-check-label" for="checkbox1"><em>Pastikan semua data sudah benar, dan scan dapat dibaca dengan jelas.</em></label>
            </div>
          <!-- /form di bawah -->
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Kirim</button>
        </div>
          </form>
      </div>
      <!-- /.card -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->

@endsection

@push('scripts')
  <script src="https://cdn.jsdelivr.net/npm/filepond-plugin-file-validate-type@1/dist/filepond-plugin-file-validate-type.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/filepond-plugin-file-validate-size@2/dist/filepond-plugin-file-validate-size.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/filepond-plugin-image-preview@4/dist/filepond-plugin-image-preview.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/filepond@4/dist/filepond.min.js"></script>
  <script>
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
  </script>

  <script>
    // disable submit button
    $('form').submit(function() {
      // show spinner on button
      $('button[type=submit]').html(`
        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
        Mengirim...
      `);
      $('button[type=submit]').attr('disabled', true);
    });
  </script>

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