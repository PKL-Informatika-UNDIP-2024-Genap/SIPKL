@extends('layouts.main')

@push('styles')
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" /> --}}
	<link rel="stylesheet" href="/plugins/select2-bootstrap5-theme/select2-bootstrap5.min.css">

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

@section('container')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col">
        <h1 class="m-0">Jadwal Seminar per Mahasiswa</h1>
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
          <div class="col-auto mb-2 d-flex align-items-center mx-auto mr-md-0">
						<strong class="mr-3 text-lightblue">Filter:</strong>
						<label for="status" class="my-0 mr-2 fw-normal">Status/Jenis:</label for="status">
						<div class="d-inline-block" style="width: 200px">
							<select name="status" id="status" class="form-control">
								<option value="" selected>Semua</option>
								<option value="Terjadwal">Terjadwal</option>
								<option value="Tak Terjadwal">Tak Terjadwal</option>
							</select>
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
                      {{-- <td>{{ Carbon\Carbon::parse($jadwal->tgl_seminar)->isoFormat('dddd, D MMMM Y') }}</td> --}}
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

@push('scripts')
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script type="text/javascript">
    $('#status').select2({
      theme: 'bootstrap-5',
      // allowClear: true,
      minimumResultsForSearch: Infinity,
      // placeholder: 'Semua',
      // width: '100%',
    });
  </script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.11.6/viewer.min.js" integrity="sha512-EC3CQ+2OkM+ZKsM1dbFAB6OGEPKRxi6EDRnZW9ys8LghQRAq6cXPUgXCCujmDrXdodGXX9bqaaCRtwj4h4wgSQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="/js/ajax-jadwal-seminar.js"></script>

  <script type="text/javascript">
    $(document).ready(function() {
      const table = new DataTable('#myTable', {
        columnDefs: [
          {
            searchable: false,
            orderable: false,
            targets: [0,"action"]
          },
        ],
        order: [[3, 'asc'],[4, 'asc']],
        lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
        pageLength: 10,
        "initComplete": function(settings, json) {
          $.fn.dataTable.ext.search.push(
          function (setting, data, index) {
            // if (setting.nTable.id !== 'myTable') {
            //   return true;
            // }
            var selectedStatus = $('#status').val();
            if (selectedStatus == "") {
              return true;
            }
            if (selectedStatus == data[5]) {
              return true;
            }
            return false;
          })
        }
      });
      $('#myTable_filter input').css('width', '200px');
      table.on('order.dt search.dt', function () {
        let i = 1;
        table
          .cells(null, 0, { search: 'applied', order: 'applied' })
          .every(function (cell) {
              this.data(i++);
          });
      }).draw();
      
      $('#status').on('change', function() {
        table.draw();
      })
    
      // $.fn.dataTableExt.afnFiltering.push(
      // 	function (setting, data, index) {
      // 		var selectedStatus = $('#status').val();
      // 		if (selectedStatus == "") {
      // 			return true;
      // 		}
      // 		if (selectedStatus == data[5]) {
      // 			return true;
      // 		}
      // 		return false;
      // 	});
    });
  </script>
  <script src="/js/datatables-jquery.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/filepond-plugin-file-validate-type@1/dist/filepond-plugin-file-validate-type.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/filepond@4/dist/filepond.min.js"></script>
  <script type="text/javascript">
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