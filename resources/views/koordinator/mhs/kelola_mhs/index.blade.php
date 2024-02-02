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
            <button type="button" id="btn-add" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_add">
              + Tambah Mahasiswa
            </button>
          </div>
          <div class="col-auto">
            <button type="button" id="btn-import" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal_import_mhs">
              Import Data
            </button>
          </div>
        </div>
      </div>

      <div class="col col-fixed-400">
        <div class="row mb-2">
          <div class="col-12">
            <h5 class="m-0 p-0">Filter</h5>
          </div>
        </div>
        <div class="row align-items-center">
          <div class="col-md-2">
            <p class="mb-0">Status:</p>
          </div>
          <div class="col-md-10">
            <div class="d-flex align-items-center">
              <select name="status" id="status" class="form-control">
                <option value="" selected>Semua Status</option>
                <option value="Belum Pra-Reg">Belum Pra-Reg</option>
                <option value="Nonaktif">Nonaktif</option>
                <option value="Aktif">Aktif</option>
              </select>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="card">
      <div class="card-body table-responsive" id="tabel-mhs">
        <table class="table" id="myTable">
          <thead>
              <tr class="table-primary">
                  <th>No</th>
                  <th>Nama</th>
                  <th>NIM</th>
                  <th>Status</th>
                  <th class="action">Action</th>
              </tr>
          </thead>
          <tbody>
              @foreach ($arr_mhs as $mhs)
                  <tr>
                      <td></td>
                      <td>{{ $mhs->nama }}</td>
                      <td>{{ $mhs->nim }}</td>
                      <td>{{ $mhs->status }}</td>
                      <td>
                          <div class="btn btn-primary btn-detail-mhs" data-bs-toggle="modal" data-bs-target="#modal_detail_mhs" data-mhs="{{ $mhs }}">
                            Detail
                          </div>
                          <div class="btn btn-info btn-edit-mhs" data-bs-toggle="modal" data-bs-target="#modal_edit_mhs" 
                          data-nim="{{ $mhs->nim }}" data-nama="{{ $mhs->nama }}" data-status="{{ $mhs->status }}" >Edit</div>
                          <div class="btn btn-warning btn-reset-pass" data-nim="{{ $mhs->nim }}">
                            Reset Password
                          </div>
                          <div class="btn btn-danger btn-delete-mhs" data-nim="{{ $mhs->nim }}">
                            Delete
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

{{-- modal add mhs --}}
@include('koordinator.mhs.kelola_mhs.modal_add_mhs')
{{-- end modal add mhs --}}

{{-- modal edit mhs --}}
@include('koordinator.mhs.kelola_mhs.modal_edit_mhs')
{{-- end modal edit mhs --}}

@include('koordinator.mhs.kelola_mhs.modal_detail_mhs')

@include('koordinator.mhs.kelola_mhs.modal_import_mhs')
@endsection

@push('scripts')
<script src="/js/ajax-mhs.js"></script>
<script src="/js/datatables-jquery.js"></script>
<script>
  simpleDatatable();
</script>
@endpush