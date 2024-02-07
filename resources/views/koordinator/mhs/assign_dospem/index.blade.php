@extends('layouts.main')

@section('container')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Assign Dosen Pembimbing Mahasiswa PKL</h1>
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
      <div class="card-body table-responsive px-0" id="tabel-mhs">
        <table class="table" id="myTable2">
          <thead>
            <tr class="table-primary">
                <th>No</th>
                <th>Nama</th>
                <th>NIM</th>
                <th>Dosen Pembimbing</th>
                <th class="action">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($data_mhs as $mhs)
              <tr data-nim="{{ $mhs->nim }}">
                <td></td>
                <td class="details-control">{{ $mhs->nama }}</td>
                <td>{{ $mhs->nim }}</td>
                <td class="kolom-nama-dospem">{{ $mhs->nama_dospem ?? "-"}}</td>
                <td>
                  <div class="btn btn-primary btn-sm btn-assign-dospem" data-bs-toggle="modal" data-bs-target="#modal-assign-dospem"
                    data-nim="{{ $mhs->nim }}" data-id-dospem="{{ $mhs->id_dospem }}">
                    Assign Dospem
                  </div>
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

@include('koordinator.mhs.assign_dospem.modal_assign_dospem')

@endsection

@push('styles')
  <!-- Select2 -->
  <link rel="stylesheet" href="/lte/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="/lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endpush

@push('scripts')
<script src="/js/ajax-assign-dospem.js"></script>
<script src="/js/datatables-jquery.js"></script>
<!-- Select2 -->
<script src="/lte/plugins/select2/js/select2.full.min.js"></script>
@endpush