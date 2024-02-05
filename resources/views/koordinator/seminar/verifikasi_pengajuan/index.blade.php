@extends('layouts.main')

@section('container')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Verifikasi Pengajuan Seminar Tak Terjadwal</h1>
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
      <div class="card-body table-responsive" id="tabel-pengajuan">
        <table class="table" id="myTable">
          <thead>
              <tr class="table-primary">
                  <th>No</th>
                  <th>Nama</th>
                  <th>NIM</th>
                  <th>Tanggal Pengajuan</th>
                  <th class="action">Action</th>
              </tr>
          </thead>
          <tbody>
              @foreach ($data_pengajuan as $pengajuan)
                  <tr>
                      <td></td>
                      <td>{{ $pengajuan->mahasiswa->nama }}</td>
                      <td>{{ $pengajuan->nim }}</td>
                      <td>{{ $pengajuan->created_at }}</td>
                      <td>
                        <div class="btn btn-primary btn-detail-pengajuan" data-bs-toggle="modal" data-bs-target="#modal-detail-pengajuan"
                        data-mhs="{{ $pengajuan->mahasiswa }}" data-pengajuan="{{ $pengajuan }}" data-dospem="{{ $pengajuan->dosen_pembimbing }}"
                        data-tgl-pengajuan="{{ $pengajuan->created_at }}">Detail</div>
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

@include('koordinator.seminar.verifikasi_pengajuan.modal_detail')

@endsection

@push('styles')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.11.6/viewer.css" integrity="sha512-eG8C/4QWvW9MQKJNw2Xzr0KW7IcfBSxljko82RuSs613uOAg/jHEeuez4dfFgto1u6SRI/nXmTr9YPCjs1ozBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.11.6/viewer.min.js" integrity="sha512-EC3CQ+2OkM+ZKsM1dbFAB6OGEPKRxi6EDRnZW9ys8LghQRAq6cXPUgXCCujmDrXdodGXX9bqaaCRtwj4h4wgSQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="/js/ajax-verif-pengajuan-seminar.js"></script>
<script src="/js/datatables-jquery.js"></script>
<script>
  let tabel = simpleDatatable();
  tabel.order([3, 'asc']).draw();

</script>
@endpush