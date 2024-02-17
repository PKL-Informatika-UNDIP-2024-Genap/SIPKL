@extends('layouts.main_mhs')

@push('styles')
	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">

  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" /> --}}
	<link rel="stylesheet" href="/plugins/select2-bootstrap5-theme/select2-bootstrap5.min.css">
@endpush

@section('container')
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col">
					<h1 class="m-0">Jadwal Seminar</h1>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="card px-3">
				<div class="card-body table-responsive px-0" id="tabel-jadwal">
					<div class="row">
						{{-- <div class="col-auto mb-3 d-flex align-items-center gap-1">
							<strong class="mr-3 text-lightblue">Action:</strong>
							<div class="btn btn-sm btn-success" id="btn-export-jadwal" data-bs-toggle="modal" data-bs-target="#modal-export-jadwal">
								<span class="bi bi-download me-1"></span>
								Export
							</div>
						</div> --}}
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
										<th>Dosen Pembimbing</th>
										<th>Hari, Tanggal</th>
										<th>Waktu</th>
										<th>Ruang</th>
										<th>Nama</th>
										<th>NIM</th>
										<th>Jenis</th>
										<th class="action">Action</th>
								</tr>
						</thead>
						<tbody>
								@foreach ($data_jadwal as $jadwal)
										<tr>
												<td></td>
												<td>{{ $jadwal->dosen_pembimbing->nama }}</td>
												{{-- <td>{{ Carbon\Carbon::parse($jadwal->tgl_seminar)->isoFormat('dddd, D MMMM Y') }}</td> --}}
												<td>{{ $jadwal->tgl_seminar }}</td>
												<td>{{ $jadwal->waktu_seminar }}</td>
												<td>{{ $jadwal->ruang }}</td>
												<td>{{ $jadwal->mahasiswa->nama }}</td>
												<td>{{ $jadwal->nim }}</td>
												<td>{{ $jadwal->status }}</td>
												<td>
													<div class="btn btn-primary btn-sm btn-detail-jadwal" data-bs-toggle="modal" data-bs-target="#modal-detail-jadwal"
													data-mhs="{{ $jadwal->mahasiswa }}" data-jadwal="{{ $jadwal }}" data-dospem="{{ $jadwal->dosen_pembimbing }}"
													data-tgl-jadwal="{{ $jadwal->created_at }}">Detail</div>
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

	<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
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
        order: [[2, 'asc'],[3, 'asc']],
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
            if (selectedStatus == data[7]) {
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
@endpush