@extends('layouts.main_mhs')

@push('styles')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.11.6/viewer.css" integrity="sha512-eG8C/4QWvW9MQKJNw2Xzr0KW7IcfBSxljko82RuSs613uOAg/jHEeuez4dfFgto1u6SRI/nXmTr9YPCjs1ozBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

@section('container')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col">
          <h1 class="m-0">Data PKL</h1>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- data pkl -->
      @if ($pkl->status == "Praregistrasi")
      <div class="card card-danger">
        <div class="card-header">
          <h3 class="card-title"><em>Anda belum registrasi PKL</em></h3>
      @elseif ($pkl->status == 'Registrasi')
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title"><em>Menunggu registrasi PKL diterima...</em></h3>
      @else
      <div class="card card-success">
        <div class="card-header">
          <h3 class="card-title"><em>Anda sudah registrasi (Aktif) mengikuti PKL pada semester ini</em></h3>
      @endif
        </div>
        <!-- /.card-header -->
        <div class="card-body">

          @if ($pkl->status == "Praregistrasi" && $pkl->pesan != null)
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
              <button type="button" class="close" data-bs-dismiss="alert" aria-hidden="true" aria-label="Close">&times;</button>
              <h5><strong><i class="icon bi bi-exclamation-triangle-fill"></i> Perhatian!</strong></h5>
              Registrasi PKL Anda ditolak. Silahkan registrasi ulang. Pesan: <strong><em>“{{ $pkl->pesan }}”</em></strong>&nbsp;&nbsp;
              <a href="/registrasi" class="btn btn-primary btn-sm text-decoration-none">Registrasi Ulang</a>
            </div>
          @endif

          <div class="row">
            <div class="col-sm-5">
              <div class="form-group">
                <label for="status">Status PKL Anda</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="bi bi-hand-index-thumb-fill"></i></span>
                  </div>
                  <input type="text" class="form-control text-bold" id="status" value="{{ $mahasiswa->status }}" disabled>
                </div>
              </div>
              <div class="form-group">
                <label for="periode">Periode PKL</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="bi bi-hourglass-top"></i></span>
                  </div>
                  <input type="text" class="form-control" id="periode" name="periode" placeholder="Tidak tersedia" value="{{ $mahasiswa->periode_pkl }}" disabled>
                </div>
              </div>
            </div>
            <div class="col-sm-7">
              <div class="form-group">
                <label for="nama">Nama</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                  </div>
                  <input type="text" class="form-control" id="nama" value="{{ $mahasiswa->nama }}" disabled>
                </div>
              </div>
              <div class="form-group">
                <label for="nim">NIM</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="bi bi-person-vcard-fill"></i></span>
                  </div>
                  <input type="text" class="form-control" id="nim" value="{{ $mahasiswa->nim }}" disabled>
                </div>
              </div>
            </div>            
            
          </div>
          {{-- <div class="form-group">
            <dl class="row">
              <dt><i class="bi bi-building-fill mx-2"></i>Instansi</dt>
              <dd>{{ $pkl->instansi }}</dd>
              <dt><i class="bi bi-fonts mx-2"></i>Judul PKL</dt>
              <dd>{{ $pkl->judul }}</dd>
            </dl>
          </div> --}}

          <div class="form-group">
            <label for="instansi">Instansi</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="bi bi-building-fill"></i></span>
              </div>
              <input type="text" class="form-control @error('instansi') is-invalid @enderror" id="instansi" name="instansi" placeholder="Masukkan nama Instansi sementara" value="{{ $pkl->instansi }}" disabled>
            </div>
          </div>
          <div class="form-group">
            <label for="judul">Judul PKL</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="bi bi-fonts"></i></span>
              </div>
              <textarea class="form-control" name="judul" id="judul" cols="" rows="2" disabled>{{ $pkl->judul }}</textarea>
            </div>
          </div>
          <div class="form-group">
            <label for="scan_irs">Scan IRS</label>
            <input type="hidden" id="scanIRSSrc" name="scanIRSSrc" value="{{ $pkl->scan_irs }}">
            <img id="scanIRSImg" src="" alt="Picture" style="display:none;">
            <div class="input-group">
              <button type="button" id="scanIRSView" class="btn btn-outline-info btn-sm" @if ($pkl->scan_irs == null) disabled @endif>Lihat Scan IRS</button>
              {{-- @if ($pkl->scan_irs != null)
              <div>
                Tidak tersedia <br><a href="/registrasi" class="btn btn-outline-warning btn-sm" >Registrasi Sekarang</a>
              </div>
              @else
              @endif --}}
            </div>
          </div>
          <div class="callout callout-warning text-muted">
            <em>*Sesuaikan Instansi dan Judul PKL dengan rencana PKL Anda, selama laporan belum dikirim.</em>
          </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer text-center">
          <div class="btn btn-primary btn-edit-data" data-bs-toggle="modal" data-bs-target="#modal_edit"
          data-instansi="{{ $pkl->instansi }}" data-judul="{{ $pkl->judul }}">Edit Data</div>
          {{-- <button type="submit" class="btn btn-primary">Edit</button> --}}
        </div>
      </div>
      <!-- /.card -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->

  <!-- Modal Edit -->
  @include('mahasiswa.pkl.modal_edit')
@endsection

@push('scripts')
  <script type="text/javascript">
    $(document).ready(function(){
      // modal edit
      $('.btn-edit-data').on('click', function(){
        $("#form-edit-data :input").each(function () {
          $(this).removeClass("is-invalid");
          $(this).siblings(".invalid-feedback").html("");
        });
        $('#instansi-edit').val($(this).data('instansi'));
        $('#judul-edit').val($(this).data('judul'));
      });
      // update data
      $("#update-data").click(function (e) {
        e.preventDefault();
        let instansi = $("#instansi-edit").val();
        let judul = $("#judul-edit").val();
        let nim = $("#nim").val();

        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });

        $.ajax({
          type: "put",
          url: "/pkl/"+nim+"/update",
          data: {
            instansi: instansi,
            judul: judul,
            nim: nim,
          },
          dataType: "json",
          success: function (response) {
            $("#modal_edit").modal("hide");
            Swal.fire({
              title: "Berhasil!",
              text: "Data PKL berhasil diperbarui.",
              icon: "success",
              showConfirmButton: false,
              timer: 1500
            });
            $('#instansi').val(instansi);
            $('#judul').val(judul);
            $('.btn-edit-data').data('instansi', instansi);
            $('.btn-edit-data').data('judul', judul);
          },
          error: function (response) {
            // console.log(response.responseText);
            var errorResponse = $.parseJSON(response.responseText);
            if (errorResponse.errors && errorResponse.errors.instansi) {
              $("#instansi-edit").addClass("is-invalid");
              $("#instansi-edit-err").html(errorResponse.errors.instansi);
            }else{
              $("#instansi-edit").removeClass("is-invalid");
              $("#instansi-edit-err").html("");
            }
            if (errorResponse.errors && errorResponse.errors.judul) {
              $("#judul-edit").addClass("is-invalid");
              $("#judul-edit-err").html(errorResponse.errors.judul);
            }else{
              $("#judul-edit").removeClass("is-invalid");
              $("#judul-edit-err").html("");
            }
          }
        });
      });

    });
  </script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.11.6/viewer.min.js" integrity="sha512-EC3CQ+2OkM+ZKsM1dbFAB6OGEPKRxi6EDRnZW9ys8LghQRAq6cXPUgXCCujmDrXdodGXX9bqaaCRtwj4h4wgSQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script type="text/javascript">
    var scanIRSImg = $('#scanIRSImg')[0];
    // Inisialisasi Viewer.js
    scanIRSImg.src = '/preview/'+$('#scanIRSSrc').val();
    var viewer = new Viewer(scanIRSImg, {
      inline: false,
      viewed: function() {
        // viewer.zoomTo(1);
      },
    });
    $('#scanIRSView').click(function(){
      viewer.show();
    });
  </script>

@if (session()->has('success'))
  <script type="text/javascript">
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
