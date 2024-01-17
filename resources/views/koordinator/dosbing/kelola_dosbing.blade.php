@extends('layouts.main')
@push('styles')
    @livewireStyles
@endpush

@push('scripts')
    @livewireScripts
@endpush
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
          <div class="card-body">
            <table class="table" id="myTable">
              <thead>
                  <tr class="table-primary">
                      <th>No</th>
                      <th>Nama</th>
                      <th>NIP</th>
                      <th>Golongan</th>
                      <th>Jabatan</th>
                      <th>Action</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach ($dosbing as $index => $dos)
                      <tr>
                          <td></td>
                          <td>{{ $dos->nama }}</td>
                          <td>{{ $dos->nip }}</td>
                          <td>{{ $dos->golongan }}</td>
                          <td>{{ $dos->jabatan }}</td>
                          <td>
                              <a href="/koordinator/kelola_dosbing/{{ $dos->nip }}" class="btn btn-primary">Edit</a>
                              <form action="/koordinator/kelola_dosbing/{{ $dos->id }}" method="post" class="d-inline">
                                  @method('delete')
                                  @csrf
                                  <button class="btn btn-danger">Delete</button>
                              </form>
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

{{-- modal add dosbing --}}
@include('koordinator.dosbing.modal_add_dosbing')
{{-- end modal add dosbing --}}

<script src="/js/datatables-jquery.js"></script>
@endsection