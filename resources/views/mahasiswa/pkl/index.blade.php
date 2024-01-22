@extends('layouts.main_mhs')

@section('container')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Data PKL</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item active">Data PKL</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      <!-- /.row (main row) -->
      <!-- data pkl -->
      @if ($mahasiswa->status == "Aktif")
      <div class="card card-success">
        <div class="card-header">
          <h3 class="card-title">Selamat! Anda sudah berstatus Aktif mengikuti PKL pada semester ini.</h3>
      @elseif ($pkl->scan_irs != null)
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Menunggu diterima.</h3>
      @else
      <div class="card card-danger">
        <div class="card-header">
          <h3 class="card-title">Anda belum registrasi PKL.</h3>
      @endif
        </div>
        <!-- /.card-header -->
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
              <input type="text" class="form-control" id="periode" name="periode" placeholder="Periode" value="{{ $mahasiswa->periode_pkl }}" readonly>
            </div>
          </div>
          <div class="callout callout-info text-secondary">
            <p>*Anda dapat mengubah isian Instansi dan Judul lagi nanti.<br>Harap segera sesuaikan lagi dengan rencana PKL Anda.</p>
          </div>
          <div class="form-group">
            <label for="instansi">Instansi</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="bi bi-building-fill"></i></span>
              </div>
              <input type="text" class="form-control @error('instansi') is-invalid @enderror" id="instansi" name="instansi" placeholder="Masukkan nama Instansi sementara" value="{{ $pkl->instansi }}" readonly>
            </div>
          </div>
          <div class="form-group">
            <label for="judul">Judul PKL</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="bi bi-fonts"></i></span>
              </div>
              <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" placeholder="Masukkan Judul PKL sementara" value="{{ $pkl->judul }}" readonly>
            </div>
          </div>
          <div class="form-group">
            <label for="scan_irs">Scan IRS</label>
            <div class="input-group">
              @if ($pkl->scan_irs != null)
              <a href="/preview/{{ $pkl->scan_irs }}" class="btn btn-info" >Preview</a>
              @else
              <div>
                  Anda belum registrasi PKL ... <br><a href="/registrasi" class="btn btn-primary" >Registrasi Sekarang</a>
              </div>
              @endif
            </div>
          </div>
        </div>
        <!-- /.card-body -->
        {{-- <div class="card-footer">
          <button type="submit" class="btn btn-primary">Edit</button>
        </div> --}}
      </div>
      <!-- /.card -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
@endsection
