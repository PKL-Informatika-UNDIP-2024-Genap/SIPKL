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
    <div class="row">
      <div class="col">

        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-auto mb-3 d-flex align-items-center gap-1">
                <div class="btn btn-sm btn-primary" id="btn-tambah-jadwal" data-bs-toggle="modal" data-bs-target="#modal-tambah-jadwal">
                  + Tambah
                </div>
                <div class="btn btn-sm btn-info" id="btn-import-jadwal" data-bs-toggle="modal" data-bs-target="#modal-import-jadwal">
                  <span class="bi bi-upload me-1"></span>
                  Import
                </div>
                <div class="btn btn-sm btn-success" id="btn-export-jadwal">
                  <span class="bi bi-download me-1"></span>
                  Export
                </div>
              </div>
              <div class="col-auto mb-2 d-flex justify-content-center align-items-center flex-wrap gap-3 ml-auto">
                <strong class="text-lightblue">Filter:</strong>
                <div class="d-flex align-items-center">
                  <label for="status" class="my-0 mr-2 fw-normal">Status/Jenis:</label>
                  <div class="d-inline-block" style="width: 200px">
                    <select name="status" id="status" class="form-control">
                      <option value="" selected>Semua</option>
                      <option value="Terjadwal">Terjadwal</option>
                      <option value="Tak Terjadwal">Tak Terjadwal</option>
                    </select>
                  </div>
                </div>
                <div class="d-flex align-items-center">
                  <label for="jadwal" class="my-0 mr-2 fw-normal">Jadwal:</label>
                  <div class="d-inline-block" style="width: 200px">
                    <select name="jadwal" id="jadwal" class="form-control">
                      <option value="">Semua</option>
                      <option value="Mendatang" selected>Mendatang</option>
                      <option value="Terlewat">Terlewat</option>
                    </select>
                  </div>
                </div>

              </div>
            </div>
            <div id="tabel-jadwal" class="table-responsive pt-1">
              <table class="table" id="myTable">
                <thead>
                    <tr class="table-primary">
                        <th>No</th>
                        <th class="hari_tanggal">Hari, Tanggal</th>
                        <th>Waktu</th>
                        <th>Ruang</th>
                        <th>Nama</th>
                        <th>NIM</th>
                        <th>Jenis</th>
                        <th>Pembimbing</th>
                        <th class="action">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data_jadwal as $jadwal)
                        <tr>
                            <td></td>
                            <td>{{ $jadwal->tgl_seminar }}</td>
                            <td>{{ $jadwal->waktu_seminar }}</td>
                            <td>{{ $jadwal->ruang }}</td>
                            <td>{{ $jadwal->mahasiswa->nama }}</td>
                            <td>{{ $jadwal->nim }}</td>
                            <td>{{ $jadwal->status }}</td>
                            <td>{{ $jadwal->dosen_pembimbing->nama }}</td>
                            <td>
                              <div class="btn btn-primary btn-sm btn-detail-jadwal mb-1" data-bs-toggle="modal" data-bs-target="#modal-detail-jadwal"
                              data-mhs="{{ $jadwal->mahasiswa }}" data-jadwal="{{ $jadwal }}" data-dospem="{{ $jadwal->dosen_pembimbing }}"
                              data-tgl-jadwal="{{ $jadwal->created_at }}">Detail</div>
                              <div class="btn btn-sm btn-danger btn-sm btn-delete-jadwal mb-1" data-nim="{{ $jadwal->nim }}">
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

  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

@include('koordinator.seminar.jadwal_seminar.modal_detail')
@include('koordinator.seminar.jadwal_seminar.modal_tambah')
@include('koordinator.seminar.jadwal_seminar.modal_import')

@endsection

@push('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
@endpush

@push('scripts')
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script type="text/javascript">
    $('#status, #jadwal').select2({
      theme: 'bootstrap-5',
      // allowClear: true,
      minimumResultsForSearch: Infinity,
      // placeholder: 'Semua',
      // width: '100%',
    });
  </script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.11.6/viewer.min.js" integrity="sha512-EC3CQ+2OkM+ZKsM1dbFAB6OGEPKRxi6EDRnZW9ys8LghQRAq6cXPUgXCCujmDrXdodGXX9bqaaCRtwj4h4wgSQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="/js/ajax-jadwal-seminar.js"></script>
  {{-- <script src="/js/datatables-jquery.js"></script> --}}
  
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.colVis.min.js"></script>

  <script src="/lte/plugins/moment/moment.min.js"></script>
  <script src="/lte/plugins/moment/locale/id.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/filepond-plugin-file-validate-type@1/dist/filepond-plugin-file-validate-type.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/filepond@4/dist/filepond.min.js"></script>
  <script type="text/javascript">
    function datatableInit(id_filter, column_index) {
      const table = new DataTable('#myTable', {
        columnDefs: [
          {
            searchable: false,
            orderable: false,
            targets: [0, "action"]
          },
          {
            targets: ['hari_tanggal'],
            render: DataTable.render.datetime( "dddd, D MMMM YYYY", "id"),
          },
        ],
        order: [[1, 'asc']],
        lengthMenu: [5, 10, 25, 50],
        pageLength: 10,
        buttons: [
          {
            extend: 'excelHtml5',
            text: 'Export to Excel',
            filename: 'export_nilai',
            exportOptions: {
              columns: ':visible', // Ini akan mengekspor semua kolom yang terlihat
              columns: ':not(:last-child)' // Ini akan mengekspor semua kolom kecuali kolom terakhir
            }
          },
          {
            extend: 'excelHtml5',
            text: 'Export to Excel',
            filename: 'export_jadwal_seminar',
            exportOptions: {
              columns: ':visible', // Ini akan mengekspor semua kolom yang terlihat
              columns: ':not(:last-child)' // Ini akan mengekspor semua kolom kecuali kolom terakhir
            }
          }
        ],
        "initComplete": function (settings, json) {
          $.fn.dataTable.ext.search.push(
            function (settings, data, index) {
              if (settings.nTable.id !== 'myTable') {
                return true;
              }
              var selectedFilter = $(id_filter).val();
              var selectedJadwal = $('#jadwal').val();
              let dataTgl = moment(data[1], "dddd, D MMMM YYYY").format("YYYY-MM-DD");
              if (selectedFilter == "") {
                if (selectedJadwal == "") {
                  return true;
                }
                if (selectedJadwal == "Mendatang" && dataTgl >= moment().format("YYYY-MM-DD")) {
                  return true;
                }
                if (selectedJadwal == "Terlewat" && dataTgl < moment().format("YYYY-MM-DD")) {
                  return true;
                }
              }
              if (selectedFilter == data[column_index]) {
                if (selectedJadwal == "") {
                  return true;
                }
                if (selectedJadwal == "Mendatang" && dataTgl >= moment().format("YYYY-MM-DD")) {
                  return true;
                }
                if (selectedJadwal == "Terlewat" && dataTgl < moment().format("YYYY-MM-DD")) {
                  return true;
                }
              }
              return false;
            }
          )
        }
      });

      $(id_filter).on('change', function () {
        table.draw();
      });
      $('#jadwal').on('change', function () {
        table.draw();
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

      return table;
    }

    let tabel = datatableInit("#status", 6);
    tabel.order([[1, 'asc'], [2, 'asc'], [7, 'asc']]).draw();

    $('#btn-export-jadwal').on('click', function () {
      tabel.button(1).trigger();
    })

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