@extends('layouts.main')

@section('container')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Jadwal Seminar per Mahasiswa</h1>
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
    <div class="card px-3">
      <div class="card-body table-responsive px-0" id="tabel-jadwal">
        <div class="row">
          <div class="col-auto mb-3 d-flex align-items-center gap-1">
            {{-- <strong class="mr-3 text-lightblue">Action:</strong> --}}
            <div class="btn btn-sm btn-primary" id="btn-tambah-jadwal" data-bs-toggle="modal" data-bs-target="#modal-tambah-jadwal">
              + Tambah
            </div>
            <div class="btn btn-sm btn-info" id="btn-import-jadwal" data-bs-toggle="modal" data-bs-target="#modal-import-jadwal">
              <span class="bi bi-upload me-1"></span>
              Import
            </div>
            <div class="btn btn-sm btn-success" id="btn-export-jadwal" data-bs-toggle="modal" data-bs-target="#modal-export-jadwal">
              <span class="bi bi-download me-1"></span>
              Export
            </div>
          </div>
        </div>
        <table class="table" id="myTable">
          <thead>
              <tr class="table-primary">
                  <th>No</th>
                  <th>Nama</th>
                  <th>NIM</th>
                  <th>Tanggal Seminar</th>
                  <th>Waktu</th>
                  <th>Jenis</th>
                  <th class="action">Action</th>
              </tr>
          </thead>
          <tbody>
              @foreach ($data_jadwal as $jadwal)
                  <tr>
                      <td></td>
                      <td>{{ $jadwal->mahasiswa->nama }}</td>
                      <td>{{ $jadwal->nim }}</td>
                      <td>{{ $jadwal->tgl_seminar }}</td>
                      <td>{{ $jadwal->waktu_seminar }}</td>
                      <td>{{ $jadwal->status }}</td>
                      <td>
                        <div class="btn btn-primary btn-sm btn-detail-jadwal" data-bs-toggle="modal" data-bs-target="#modal-detail-jadwal"
                        data-mhs="{{ $jadwal->mahasiswa }}" data-jadwal="{{ $jadwal }}" data-dospem="{{ $jadwal->dosen_pembimbing }}"
                        data-tgl-jadwal="{{ $jadwal->created_at }}">Detail</div>

                        <div class="btn btn-danger btn-sm btn-delete-jadwal" data-nim="{{ $jadwal->nim }}">
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

@include('koordinator.seminar.jadwal_seminar.modal_detail')
@include('koordinator.seminar.jadwal_seminar.modal_tambah')
@include('koordinator.seminar.jadwal_seminar.modal_import')
@include('koordinator.seminar.jadwal_seminar.modal_export')

@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/filepond@4/dist/filepond.min.css" rel="stylesheet" />
<style>
  /* .filepond--root, */
  .filepond--root .filepond--drop-label {
    height: 150px;
  }
  /* bordered drop area */
  .filepond--panel-root {
    background-color: transparent;
    border: 2px dashed #ced4da;
  }
</style>
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.11.6/viewer.min.js" integrity="sha512-EC3CQ+2OkM+ZKsM1dbFAB6OGEPKRxi6EDRnZW9ys8LghQRAq6cXPUgXCCujmDrXdodGXX9bqaaCRtwj4h4wgSQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="/js/ajax-jadwal-seminar.js"></script>
<script src="/js/datatables-jquery.js"></script>
<script>
  let tabel = simpleDatatable();
  tabel.order([[3, 'asc'],[4, 'asc']]).draw();

  
</script>
<script src="https://cdn.jsdelivr.net/npm/filepond-plugin-file-validate-type@1/dist/filepond-plugin-file-validate-type.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/filepond@4/dist/filepond.min.js"></script>
<script>
  // Register the plugin
  FilePond.registerPlugin(
    FilePondPluginFileValidateType,
  );

  // Get a reference to the file input element
  const inputElement = document.querySelector('input[id="file"]');

  // Create a FilePond instance
  const pond = FilePond.create(inputElement,{
    storeAsFile: true,
    stylePanelLayout: 'compact',
    labelIdle: `<i class="bi bi-upload fs-2"></i><br>Drag & Drop file atau <span class="filepond--label-action">Browse</span>`,
    acceptedFileTypes: ['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.ms-excel'],
    labelFileTypeNotAllowed: 'File tidak sesuai format',
    fileValidateTypeLabelExpectedTypes: 'Hanya mendukung file .xlsx atau .xls',
    credits: false,
  });

</script>
@endpush