@extends('layouts.main')

@section('container')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Kelola Periode PKL</h1>
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
    <div class="row mb-2">
      <div class="col-auto">
        <button type="button" id="btn-add" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-add-periode">
          + Tambah Periode PKL
        </button>
      </div>
    </div>

    <div class="card">
      <div class="card-body table-responsive" id="tabel-mhs">
        <table class="table" id="myTable">
          <thead>
              <tr class="table-primary">
                  <th>No</th>
                  <th>Periode</th>
                  <th>Tanggal Mulai</th>
                  <th>Tanggal Selesai</th>
                  <th>Status</th>
                  <th class="action">Action</th>
              </tr>
          </thead>
          <tbody>
              @foreach ($data_periode as $periode)
                  <tr>
                      <td></td>
                      <td>{{ $periode->id_periode }}</td>
                      <td>{{ $periode->tgl_mulai }}</td>
                      <td>{{ $periode->tgl_selesai }}</td>
                      <td>{{ $periode->status }}</td>
                      <td>
                          <div class="btn btn-info btn-edit-mhs" data-bs-toggle="modal" data-bs-target="#modal_edit_mhs" 
                          >Edit</div>
                          <div class="btn btn-danger btn-delete-mhs">
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
@include('koordinator.pkl.kelola_periode.modal_add_periode')
{{-- end modal add mhs --}}

{{-- modal edit mhs --}}
@include('koordinator.pkl.kelola_periode.modal_edit_periode')
{{-- end modal edit mhs --}}

@endsection

@push('scripts')
<script src="/js/ajax-kelola-periode.js"></script>
<script src="/js/datatables-jquery.js"></script>
<script>
  simpleDatatable();
</script>
@endpush