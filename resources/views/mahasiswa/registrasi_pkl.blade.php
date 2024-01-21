@extends('layouts.main_mhs')

@section('container')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Registrasi PKL</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item active">Registrasi PKL</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  @if ($mahasiswa->periode_pkl != $periode_sekarang)

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- /.row (main row) -->
      <!-- general form elements -->
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Registrasi Sekarang! Isi data berikut untuk menyatakan bahwa Anda mengikuti PKL pada semester ini.</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form  id="form-register" action="/registrasi" class="needs-validation" method="post" enctype="multipart/form-data">
          @csrf
          @method('put')
          <div class="card-body">
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
              <label for="nim">Username/NIM</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="bi bi-person-vcard-fill"></i></span>
                </div>
                <input type="text" class="form-control" id="nim" placeholder="NIM" value="{{ $mahasiswa->nim }}" readonly>
              </div>
            </div>
            <div class="form-group">
              <label for="periode">Periode PKL</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="bi bi-hourglass-top"></i></span>
                </div>
                <input type="text" class="form-control" id="periode" name="periode" placeholder="Periode" value="{{ $periode_sekarang }}" readonly>
                {{-- @error('periode')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror --}}
              </div>
            </div>
            <div class="callout callout-info text-secondary">
              {{-- <p>Follow the steps to continue to payment.</p> --}}
              <p>*Anda dapat mengubah isian Instansi dan Judul lagi nanti.<br>Harap segera sesuaikan lagi dengan rencana PKL Anda.</p>
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
            <div class="form-group">
              <label for="scan_irs">Scan IRS</label>
              <div class="input-group">
                <div class="custom-file">
                  <input type="file" class="custom-file-input @error('scan_irs') is-invalid @enderror" id="scan_irs" name="scan_irs" value="{{ old('scan_irs') }}">
                  <label class="custom-file-label" for="scan_irs">Choose file</label>
                </div>
                {{-- <div class="input-group-append">
                  <span class="input-group-text">Upload</span>
                </div> --}}
                @error('scan_irs')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <img id="preview" src="#" alt="Scan IRS" class="mt-3 img-fluid" style="display:none;"/>
            </div>
            <div class="form-check">
              <input type="checkbox" class="form-check-input @error('checkbox1') is-invalid @enderror" id="checkbox1" name="checkbox1" {{ (old('checkbox1') != null)?"checked":"" }}>
              <label class="form-check-label" for="checkbox1">Pastikan sudah mengambil PKL di IRS.</label>
            </div>
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
      <!-- /.card -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
  @endif
@endsection

@push('scripts')
  <!-- bs-custom-file-input -->
  <script src="/lte/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
  <script>
    $(function () {
      bsCustomFileInput.init();
    });

    $("#scan_irs").change(function() {
      preview = document.getElementById('preview');
      preview.style.display = 'block';
      const [file] = this.files
      if (file) {
        preview.src = URL.createObjectURL(file)
      }
    });
  </script>
@endpush
