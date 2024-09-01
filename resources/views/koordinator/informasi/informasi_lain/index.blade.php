@extends('layouts.main')

@section('container')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col">
        <h1 class="m-0">Kelola Informasi Lain</h1>
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
            <div id="tabel-dokumen" class="table-responsive pt-1">
              <table class="table" id="myTable" style="width: 100%">
                <thead>
                    <tr class="table-primary">
                        <th>No</th>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Value</th>
                        <th class="action">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($arr_informasi_lain as $informasi_lain)
                        <tr data-id="{{ $informasi_lain->id }}">
                            <td></td>
                            <td class="kolom-id">{{ $informasi_lain->id }}</td>
                            <td>{{ $informasi_lain->nama }}</td>
                            <td class="kolom-value">{{ $informasi_lain->value }}</td>
                            <td class="py-0 align-middle">
                              <div class="btn btn-sm btn-primary btn-edit" data-bs-toggle="modal" data-bs-target="#modal_edit" 
                              data-id="{{ $informasi_lain->id }}" data-nama="{{ $informasi_lain->nama }}" data-value="{{ $informasi_lain->value }}">Edit</div>
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

{{-- modal edit dokumen --}}
@include('koordinator.informasi.informasi_lain.modal_edit')
{{-- end modal edit dokumen --}}
@endsection

@push('scripts')
  <script src="/js/datatables-jquery.js"></script>
  <script>
    let table = simpleDatatable();
    //add columnDefs render moments
    table.column(0).visible(false);

  </script>
  <script src="/js/ajax-informasi-lain.js"></script>
@endpush