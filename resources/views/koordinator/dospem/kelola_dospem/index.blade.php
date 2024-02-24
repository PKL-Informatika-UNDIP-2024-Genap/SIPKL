@extends('layouts.main')

@section('container')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col">
        <h1 class="m-0">Kelola Pembimbing</h1>
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
              <div class="col-auto mb-3 d-flex align-items-center">
                {{-- <strong class="mr-3 text-lightblue">Action:</strong> --}}
                <button type="button" id="btn-add" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modal_add">
                  + Tambah Pembimbing
                </button>
              </div>
            </div>
            <div id="tabel-dospem" class="table-responsive pt-1">
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
                                <div class="btn btn-sm btn-primary btn-edit-dospem" data-bs-toggle="modal" data-bs-target="#modal_edit_dospem" 
                                data-dospem="{{ $dos }}">Edit</div>
                                <div class="btn btn-sm btn-danger btn-delete-dospem" data-id="{{ $dos->id }}" data-nip="{{ $dos->nip }}">
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