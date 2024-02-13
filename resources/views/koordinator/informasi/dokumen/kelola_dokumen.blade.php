@extends('layouts.main')

@section('container')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col">
        <h1 class="m-0">Kelola Dokumen</h1>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col">
        <div class="card px-3">
          <div class="card-body table-responsive px-0" id="tabel-dokumen">
            <div class="row">
              <div class="col-auto mb-3 d-flex align-items-center">
                {{-- <strong class="mr-3 text-lightblue">Action:</strong> --}}
                <button type="button" id="btn-add" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_add">
                  + Tambah Dokumen
                </button>
              </div>
            </div>
            <table class="table" id="myTable">
              <thead>
                  <tr class="table-primary">
                      <th>No</th>
                      <th>Tanggal</th>
                      <th>Deskripsi</th>
                      <th class="lampiran">Lampiran</th>
                      <th class="action">Action</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach ($arr_dokumen as $dokumen)
                      <tr>
                          <td></td>
                          <td>{{ date('d M Y', strtotime($dokumen->updated_at)) }}</td>
                          <td>{{ $dokumen->deskripsi }}</td>
                          <td>
                            <a href="{{ $dokumen->lampiran }}" class="btn btn-primary">Download</a>
                          </td>
                          <td>
                              <div class="btn btn-primary btn-edit-dokumen" data-bs-toggle="modal" data-bs-target="#modal_edit_dokumen" 
                              data-id="{{ $dokumen->id }}" data-deskripsi="{{ $dokumen->deskripsi }}" data-lampiran="lampiran">Edit</div>
                              <div class="btn btn-danger btn-delete-dokumen" data-id="{{ $dokumen->id }}" data-deskripsi="{{ $dokumen->deskripsi }}">
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

{{-- modal add dokumen --}}
@include('koordinator.informasi.dokumen.modal_add_dokumen')
{{-- end modal add dokumen --}}

{{-- modal edit dokumen --}}
@include('koordinator.informasi.dokumen.modal_edit_dokumen')
{{-- end modal edit dokumen --}}
@endsection

@push('scripts')
<script src="/js/datatables-jquery.js"></script>
<script>
  simpleDatatable();
</script>
<script src="/js/ajax-dokumen.js"></script>
@endpush