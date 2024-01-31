@extends('layouts.main')

@section('container')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Verifikasi Registrasi PKL Mahasiswa</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-body table-responsive" id="tabel-reg">
        <table class="table" id="myTable">
          <thead>
              <tr class="table-primary">
                  <th>No</th>
                  <th>Nama Mhs</th>
                  <th>NIM</th>
                  <th>Tanggal Registrasi</th>
                  <th class="action">Action</th>
              </tr>
          </thead>
          <tbody>
              @foreach ($data_mhs as $mhs)
                  <tr>
                      <td></td>
                      <td>{{ $mhs->nama }}</td>
                      <td>{{ $mhs->nim }}</td>
                      <td>{{ $mhs->tgl_registrasi }}</td>
                      <td>
                        <div class="btn btn-primary btn-detail-reg" data-bs-toggle="modal" data-bs-target="#modal-detail-reg"
                        data-mhs="{{ $mhs }}">Detail</div>
                      </td>
                  </tr>
              @endforeach
          </tbody>
        </table>
      </div>
    </div>

    
    <!-- /.row (main row) -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

@include('koordinator.pkl.verifikasi_registrasi.modal_detail')

@endsection

@push('styles')
@endpush

@push('scripts')
<script src="/js/ajax-verif-reg.js"></script>
<script src="/js/datatables-jquery.js"></script>
<script>
  let tabel = simpleDatatable();
  tabel.order([3, 'asc']).draw();
  var myImage = document.getElementById('myImage');
  var showButton = document.getElementById('showButton');

  // Inisialisasi Viewer.js
  var viewer = new Viewer(myImage, {
    inline: false,
    viewed: function() {
      viewer.zoomTo(1);
    },
  });

  // Tambahkan event listener pada tombol
  showButton.addEventListener('click', function() {
    viewer.show();
  });
</script>
@endpush