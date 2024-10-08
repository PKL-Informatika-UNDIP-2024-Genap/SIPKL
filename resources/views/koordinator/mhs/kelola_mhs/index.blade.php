@extends('layouts.main')

@section('container')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Kelola Mahasiswa PKL</h1>
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
              <div class="col-auto mb-2 d-flex align-items-center gap-1">
                <button type="button" id="btn-add" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modal_add">
                  + Tambah Mahasiswa
                </button>
                <button type="button" id="btn-import" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modal_import_mhs">
                  Import Data
                </button>
              </div>
        
              <div class="col-auto mb-2 d-flex align-items-center mx-auto mr-md-0">
                <label for="status" class="my-0 mr-2 fw-normal">Status:</label for="status">
                <div class="d-inline-block" style="width: 200px">
                  <select name="status" id="status" class="form-control">
                    <option value="" {{ ($status == "")? "selected" : "" }}>Semua Status</option>
                    <option value="Baru" {{ ($status == "Baru")? "selected" : "" }}>Baru (Belum Pra-Reg)</option>
                    <option value="Nonaktif" {{ ($status == "Nonaktif")? "selected" : "" }}>Nonaktif (Belum Reg)</option>
                    <option value="Aktif" {{ ($status == "Aktif")? "selected" : "" }}>Aktif (Sudah Reg)</option>
                    <option value="Lulus" {{ ($status == "Lulus")? "selected" : "" }}>Lulus</option>
                  </select>
                </div>
              </div>
            </div>

            <div id="tabel-mhs" class="table-responsive pt-1">
              <table class="table" id="myTable">
                <thead>
                    <tr class="table-primary">
                        <th>No</th>
                        <th>Nama</th>
                        <th>NIM</th>
                        <th>Status</th>
                        <th>Periode</th>
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
                            <td>{{ $mhs->periode_pkl ? $mhs->periode_pkl : "-" }}</td>
                            <td>
                                <div class="mb-1 btn btn-sm btn-primary btn-detail-mhs" data-bs-toggle="modal" data-bs-target="#modal_detail_mhs" data-mhs="{{ $mhs }}">
                                  Detail
                                </div>
                                <div class="mb-1 btn btn-sm btn-info btn-edit-mhs {{ $mhs->status == "Lulus" ? "disabled" : "" }}" data-bs-toggle="modal" 
                                data-bs-target="#modal_edit_mhs" data-nim="{{ $mhs->nim }}" data-nama="{{ $mhs->nama }}" data-status="{{ $mhs->status }}">Edit</div>
                                <div class="mb-1 btn btn-sm btn-warning btn-reset-pass" data-nim="{{ $mhs->nim }}">
                                  Reset Password
                                </div>
                                <div class="mb-1 btn btn-sm btn-danger btn-delete-mhs {{ $mhs->status == "Lulus" ? "disabled" : "" }}" data-nim="{{ $mhs->nim }}">
                                  Delete
                                </div>
                                <button class="mb-1 btn btn-sm btn-success btn-wa" data-nim="{{ $mhs->nim }}" {{ $mhs->no_wa ? "" : "disabled" }}>
                                  <a href="//wa.me/{{ $mhs->no_wa }}" target="__blank" style="text-decoration: none; color: white">
                                    Hubungi Mhs
                                  </a>
                                </button>
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
<script src="/lte/plugins/moment/moment.min.js"></script>
<script src="/lte/plugins/moment/locale/id.js"></script>
<script src="/js/ajax-mhs.js"></script>
<script src="/js/datatables-jquery.js"></script>
<script>
  let tabel = datatableWithCustomFilter("#status", 3);
  tabel.order([[4, 'desc'], [1, 'asc'], [3, 'asc']]).draw();
</script>
@endpush