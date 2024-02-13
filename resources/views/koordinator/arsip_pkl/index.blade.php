@extends('layouts.main')

@section('container')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Kelola Mahasiswa PKL</h1>
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
    <div class="row justify-content-between mb-3">
      <div class="col-auto">
        <div class="row mb-2">
          <div class="col-auto">
            <h5 class="m-0 p-0">Action</h5>
          </div>
        </div>
        <div class="row">
          <div class="col-auto">
            <button type="button" id="btn-export" class="btn btn-success">
              <span class="bi bi-upload me-1"></span>
              Export Nilai
            </button>
          </div>
        </div>
      </div>

      <div class="col" style="max-width: 350px">
        <div class="row mb-2">
          <div class="col-12">
            <h5 class="m-0 p-0">Filter</h5>
          </div>
        </div>
        <div class="row align-items-center">
          <div class="col" style="max-width: 100px">
            <p class="mb-0">Periode PKL:</p>
          </div>
          <div class="col" style="max-width: 250px">
            <div class="d-flex align-items-center">
              <select name="status" id="periode-pkl" class="form-control">
                <option value="" selected>Semua Periode</option>
                @foreach ($arr_periode as $periode)
                  <option value="{{ $periode }}">{{ $periode }}</option>
                @endforeach
              </select>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="card px-3">
      <div class="card-body table-responsive px-0" id="tabel-arsip">
        <div data-arsip="{{ $arr_arsip }}" id="data-arsip"></div>
        <table class="table" id="myTable">
          <thead>
            <tr class="table-primary">
              <th>No</th>
              <th>Nama</th>
              <th>NIM</th>
              <th>Periode PKL</th>
              <th>Nilai</th>
              <th class="action">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($arr_arsip as $arsip)
              <tr>
                <td></td>
                <td>{{ $arsip->nama }}</td>
                <td>{{ $arsip->nim }}</td>
                <td>{{ $arsip->periode_pkl }}</td>
                <td>{{ $arsip->nilai }}</td>
                <td class="py-0 align-middle">
                  <div class="btn btn-primary btn-detail-mhs btn-sm" data-bs-toggle="modal" data-bs-target="#modal_detail_mhs" data-mhs="{{ $arsip }}">
                    Detail
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

@endsection

@push('scripts')
<script src="/js/ajax-arsip-pkl.js"></script>
<script src="/js/datatables-jquery.js"></script>
<script>
  let tabel = simpleDatatable();
  tabel.order([[1, 'asc'],[3, 'desc'],[4, 'asc']]).draw();
</script>
@endpush