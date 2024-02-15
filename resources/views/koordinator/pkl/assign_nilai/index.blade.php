@extends('layouts.main')

@section('container')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Assign Nilai PKL Mahasiswa</h1>
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
    <div class="card px-3">
      <div class="card-body table-responsive px-0" id="tabel-nilai">
        <table class="table" id="myTable">
          <thead>
              <tr class="table-primary">
                  <th>No</th>
                  <th>Nama Mhs</th>
                  <th>NIM</th>
                  <th>Tanggal Kirim Laporan</th>
                  <th class="action">Action</th>
              </tr>
          </thead>
          <tbody>
              @foreach ($data_mhs as $mhs)
                  <tr>
                      <td></td>
                      <td>{{ $mhs->nama }}</td>
                      <td>{{ $mhs->nim }}</td>
                      <td>{{ $mhs->tgl_laporan }}</td>
                      <td>
                        <div class="btn btn-sm btn-primary btn-detail-nilai" data-bs-toggle="modal" data-bs-target="#modal-detail-nilai"
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

@include('koordinator.pkl.assign_nilai.modal_detail')

@endsection

@push('styles')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.11.6/viewer.css" integrity="sha512-eG8C/4QWvW9MQKJNw2Xzr0KW7IcfBSxljko82RuSs613uOAg/jHEeuez4dfFgto1u6SRI/nXmTr9YPCjs1ozBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.11.6/viewer.min.js" integrity="sha512-EC3CQ+2OkM+ZKsM1dbFAB6OGEPKRxi6EDRnZW9ys8LghQRAq6cXPUgXCCujmDrXdodGXX9bqaaCRtwj4h4wgSQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="/js/ajax-assign-nilai.js"></script>
<script src="/js/datatables-jquery.js"></script>
<script>
  let tabel = simpleDatatable();
  tabel.order([3, 'asc']).draw();

</script>
@endpush