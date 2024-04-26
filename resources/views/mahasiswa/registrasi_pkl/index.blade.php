@extends('layouts.main_mhs')

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.11.6/viewer.css" integrity="sha512-eG8C/4QWvW9MQKJNw2Xzr0KW7IcfBSxljko82RuSs613uOAg/jHEeuez4dfFgto1u6SRI/nXmTr9YPCjs1ozBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link href="https://cdn.jsdelivr.net/npm/filepond@4/dist/filepond.min.css" rel="stylesheet" />
  {{-- filepond-plugin-image-preview --}}
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
    /* the background color of the file and file panel (used when dropping an image) */
    /* .filepond--item-panel {
      background-color: #555;
    } */
  </style>
@endpush

@section('container')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col">
          <h1 class="m-0">Registrasi PKL</h1>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col">
          
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title"><em>Isi data dan scan IRS untuk menyatakan bahwa Anda mengikuti PKL pada periode/semester ini.</em></h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="/registrasi" class="needs-validation" method="post" enctype="multipart/form-data">
              @csrf
              <div class="card-body">
                @if ($pkl->pesan != null)
                  <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-bs-dismiss="alert" aria-hidden="true" aria-label="Close">&times;</button>
                    <i class="icon bi bi-exclamation-triangle-fill"></i> Pesan: <strong><em>“{{ $pkl->pesan }}”</em></strong>
                  </div>
                @endif
    
                <div class="form-group">
                  <label for="nama">Nama</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                    </div>
                    <input type="text" class="form-control" id="nama" placeholder="Nama" value="{{ $mahasiswa->nama }}" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <label for="nim">NIM</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="bi bi-person-vcard-fill"></i></span>
                    </div>
                    <input type="text" class="form-control" id="nim" name="nim" placeholder="NIM" value="{{ $mahasiswa->nim }}" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <label for="periode">Periode PKL Target</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="bi bi-hourglass-top"></i></span>
                    </div>
                    <input type="text" class="form-control" id="periode" name="periode" placeholder="Periode" value="{{ $periode_sekarang }}" readonly>
    
                  </div>
                </div>
                <div class="form-group">
                  <label for="instansi">Instansi</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="bi bi-building-fill"></i></span>
                    </div>
                    <input type="text" class="form-control @error('instansi') is-invalid @enderror" id="instansi" name="instansi" placeholder="Masukkan nama Instansi sementara" value="{{ old('instansi',$pkl->instansi) }}">
                    @error('instansi')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
                <div class="form-group">
                  <label for="judul">Judul PKL</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="bi bi-fonts"></i></span>
                    </div>
                    <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" placeholder="Masukkan Judul PKL sementara" value="{{ old('judul', $pkl->judul) }}">
                    @error('judul')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
                <div class="callout callout-warning text-secondary">
                  {{-- <p>Follow the steps to continue to payment.</p> --}}
                  <em>*Anda dapat mengubah isian Instansi dan Judul PKL lagi nanti.<br>Harap segera sesuaikan lagi dengan rencana PKL Anda.
                  <br>*Scan IRS boleh belum maupun sudah disetujui.</em>
                </div>
                <div class="form-group">
                  <label for="scan_irs">Scan/Screenshot IRS (Ukuran maks gambar: 500KB)</label>
                  <div class="mb-2 d-flex">
                    @if ($pkl->scan_irs != null)
                      <a href="/preview/{{ $pkl->scan_irs }}" target="_blank" class="btn btn-outline-info btn-sm py-0 btnScanIRS">Lihat Scan Lama</a>
                    @endif
                      <a href="/preview/private/template/scan_irs_example.jpg" target="_blank" class="btn btn-warning btn-sm py-0 ms-auto btnScanIRS border">Contoh Screenshot IRS yang Benar</a>
                  </div>
                  {{-- <input type="file" class="custom-file-input @error('scan_irs') is-invalid @enderror" id="scan_irs" name="scan_irs" value="{{ old('scan_irs') }}"> --}}
                  {{-- <label class="custom-file-label" for="scan_irs">Choose file</label> --}}
                  <input type="file" class="@error('scan_irs') is-invalid @enderror" id="scan_irs" name="scan_irs">
                  @error('scan_irs')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
                <img id="scanImg" src="" alt="Picture" style="display:none;">
    
                <div class="form-check ms-1">
                  <input type="checkbox" class="form-check-input" id="checkbox1" name="checkbox1">
                  <label class="form-check-label" for="checkbox1"><em>Pastikan sudah mengambil PKL di IRS.</em></label>
                </div>
              </div>
              <!-- /.card-body -->
    
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Kirim</button>
              </div>
            </form>
          </div>
          <!-- /.card -->
          
        </div>
      </div>
      <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
@endsection

@push('scripts')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.11.6/viewer.min.js" integrity="sha512-EC3CQ+2OkM+ZKsM1dbFAB6OGEPKRxi6EDRnZW9ys8LghQRAq6cXPUgXCCujmDrXdodGXX9bqaaCRtwj4h4wgSQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script type="text/javascript">
    var scanImg = $('#scanImg')[0];
    $('.btnScanIRS').click(function(e){
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
    const inputElement = document.querySelector('input[id="scan_irs"]');
    // const inputElement = document.querySelector('input[type="file"]');

    // Create a FilePond instance
    const pond = FilePond.create(inputElement,{
      storeAsFile: true,
      stylePanelLayout: 'compact',
      labelIdle: `<i class="bi bi-upload fs-2"></i><br>Drag & Drop atau <span class="filepond--label-action">Browse</span>`,
      acceptedFileTypes: ['image/jpg', 'image/jpeg', 'image/png'],
      labelFileTypeNotAllowed: 'File tidak sesuai format',
      fileValidateTypeLabelExpectedTypes: 'Hanya file JPG, JPEG, PNG yang diperbolehkan',
      maxFileSize: '500KB',
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

  <script type="text/javascript">
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
@endpush
