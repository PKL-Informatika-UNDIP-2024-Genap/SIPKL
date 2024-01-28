@extends('layouts.main')

@section('container')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Kelola Dosen Pembimbing</h1>
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
        <button type="button" id="btn-add" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_add">
          + Tambah Dosen Pembimbing
        </button>
      </div>
    </div>

    <div class="row">
      <div class="col">
        <div class="card">
          <div class="card-body table-responsive" id="tabel-dospem">
            <table class="table" id="myTable">
              <thead>
                  <tr class="table-primary">
                      <th>No</th>
                      <th>Nama</th>
                      <th>NIP</th>
                      <th>Golongan</th>
                      <th>Jabatan</th>
                      <th class="action">Action</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach ($dospem as $index => $dos)
                      <tr>
                          <td></td>
                          <td>{{ $dos->nama }}</td>
                          <td>{{ $dos->nip }}</td>
                          <td>{{ $dos->golongan }}</td>
                          <td>{{ $dos->jabatan }}</td>
                          <td>
                              <div class="btn btn-primary btn-edit-dospem" data-bs-toggle="modal" data-bs-target="#modal_edit_dospem" 
                              data-nip="{{ $dos->nip }}" data-nama="{{ $dos->nama }}" data-nip="{{ $dos->nip }}" 
                              data-golongan="{{ $dos->golongan }}" data-jabatan="{{ $dos->jabatan }}">Edit</div>
                              <div class="btn btn-danger btn-delete-dospem" data-nip="{{ $dos->nip }}">
                                Delete
                              </div>
                          </td>
                      </tr>
                  @endforeach
              </tbody>
            </table>
          </div>
      </div>
      </div>
    </div>
    
    <!-- /.row (main row) -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

{{-- modal add dospem --}}
@include('koordinator.dospem.kelola_dospem.modal_add_dospem')
{{-- end modal add dospem --}}

{{-- modal edit dospem --}}
@include('koordinator.dospem.kelola_dospem.modal_edit_dospem')
{{-- end modal edit dospem --}}

@endsection

@push('scripts')
<script src="/js/ajax-dospem.js"></script>

<script src="/js/datatables-jquery.js"></script>
<script>
  simpleDatatable();
</script>
@endpush