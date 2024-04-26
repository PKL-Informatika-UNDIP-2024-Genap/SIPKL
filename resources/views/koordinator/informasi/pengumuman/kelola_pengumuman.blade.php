@extends('layouts.main')

@section('container')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col">
        <h1 class="m-0">Kelola Pengumuman</h1>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-auto mb-2 d-flex align-items-center">
                {{-- <strong class="mr-3 text-lightblue">Action:</strong> --}}
                <button type="button" id="btn-add" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modal_add">
                  + Tambah Pengumuman
                </button>
              </div>
            </div>
            <div id="tabel-pengumuman" class="table-responsive pt-1">
              <table class="table" id="myTable">
                <thead>
                    <tr class="table-primary">
                        <th>No</th>
                        <th class="tanggal">Tanggal</th>
                        <th>Deskripsi</th>
                        <th class="lampiran">Lampiran</th>
                        <th class="action">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($arr_pengumuman as $pengumuman)
                        <tr>
                            <td></td>
                            <td>{{ $pengumuman->updated_at }}</td>
                            <td>{{ $pengumuman->deskripsi }}</td>
                            <td class="py-0 align-middle">
                              <a href="{{ $pengumuman->lampiran }}" class="btn btn-sm btn-primary">Download</a>
                            </td>
                            <td class="py-0 align-middle">
                                <div class="btn btn-sm btn-primary btn-edit-pengumuman" data-bs-toggle="modal" data-bs-target="#modal_edit_pengumuman" 
                                data-id="{{ $pengumuman->id }}" data-deskripsi="{{ $pengumuman->deskripsi }}" data-lampiran="lampiran">Edit</div>
                                <div class="btn btn-sm btn-danger btn-delete-pengumuman" data-id="{{ $pengumuman->id }}" data-deskripsi="{{ $pengumuman->deskripsi }}">
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
    </div>
    
    <!-- /.row (main row) -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

{{-- modal add pengumuman --}}
@include('koordinator.informasi.pengumuman.modal_add_pengumuman')
{{-- end modal add pengumuman --}}

{{-- modal edit pengumuman --}}
@include('koordinator.informasi.pengumuman.modal_edit_pengumuman')
{{-- end modal edit pengumuman --}}
@endsection

@push('scripts')
  <script src="/lte/plugins/moment/moment.min.js"></script>
  <script src="/lte/plugins/moment/locale/id.js"></script>
  <script src="/js/datatables-jquery.js"></script>
  <script>
    simpleDatatable();
  </script>
  <script src="/js/ajax-pengumuman.js"></script>
@endpush