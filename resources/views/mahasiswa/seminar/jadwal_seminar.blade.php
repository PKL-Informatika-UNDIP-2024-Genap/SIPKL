@extends('layouts.main_mhs')

@push('styles')
	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">

  {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
	{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" /> --}}
	{{-- <link rel="stylesheet" href="/plugins/select2-bootstrap5-theme/select2-bootstrap5.min.css"> --}}
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
			<div class="card">
				<div class="card-body">
					{{-- <div class="row justify-content-center">
						<div class="col-auto mb-2 d-flex align-items-center">
							<strong class="m-0 text-lightblue">Filter:</strong>
						</div>
						<div class="col-auto mb-2 d-flex align-items-center flex-wrap">
							<strong class="mr-3 text-lightblue">Filter:</strong>
							<label for="jadwal" class="my-0 mr-2 fw-normal">Jadwal:</label>
							<div class="d-inline-block" style="width: 200px">
								<select name="jadwal" id="jadwal" class="form-control">
									<option value="">Semua</option>
									<option value="Mendatang" selected>Mendatang</option>
									<option value="Terlewat">Terlewat</option>
								</select>
							</div>
						</div>
					</div> --}}
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
											<th>Judul PKL</th>
											{{-- <th>Pembimbing</th> --}}
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
													<td>{{ $jadwal->pkl->judul }}</td>
													{{-- <td>{{ $jadwal->dosen_pembimbing->nama }}</td> --}}
													<td>
														<div class="btn btn-primary btn-sm btn-detail-jadwal" data-bs-toggle="modal" data-bs-target="#modal-detail-jadwal"
														data-jadwal="{{ $jadwal }}">Detail</div>
													</td>
											</tr>
									@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
			
			<!-- /.row (main row) -->
		</div><!-- /.container-fluid -->
	</section>
	<!-- /.content -->

	@include('mahasiswa.seminar.modal_detail')

@endsection


@push('scripts')
  {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script type="text/javascript">
    $('#jadwal').select2({
      theme: 'bootstrap-5',
      // allowClear: true,
      minimumResultsForSearch: Infinity,
      // placeholder: 'Semua',
      // width: '100%',
    });
  </script> --}}

	<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
	<script src="/lte/plugins/moment/moment.min.js"></script>
  <script src="/lte/plugins/moment/locale/id.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      const table = new DataTable('#myTable', {
        columnDefs: [
          {
            searchable: false,
            orderable: false,
            targets: [0,"action"]
          },
					{
            target: 'hari_tanggal',
            render: DataTable.render.datetime( "dddd, D MMMM YYYY", "id"),
					},
        ],
        order: [[1, 'asc'],[2, 'asc']],
        lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
        pageLength: 10,
        // "initComplete": function(settings, json) {
        //   $.fn.dataTable.ext.search.push(
        //   function (setting, data, index) {
        //     // if (setting.nTable.id !== 'myTable') {
        //     //   return true;
        //     // }
        //     var selectedJadwal = $('#jadwal').val();
				// 		let dataTgl = moment(data[1], "dddd, D MMMM YYYY").format("YYYY-MM-DD");
        //     if (selectedJadwal == "") {
        //       return true;
        //     }
        //     if (selectedJadwal == "Mendatang" && dataTgl >= moment().format("YYYY-MM-DD")) {
        //       return true;
        //     }
				// 		if (selectedJadwal == "Terlewat" && dataTgl < moment().format("YYYY-MM-DD")) {
				// 			return true;
				// 		}
        //     return false;
        //   })
        // }
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
      
      // $('#jadwal').on('change', function() {
      //   table.draw();
      // })
    
      // $.fn.dataTableExt.afnFiltering.push(
      // 	function (setting, data, index) {
      // 		var selectedJadwal = $('#jadwal').val();
      // 		if (selectedJadwal == "") {
      // 			return true;
      // 		}
      // 		if (selectedJadwal == data[5]) {
      // 			return true;
      // 		}
      // 		return false;
      // 	});

    });

		let data_nim;
		let data_tgl_seminar;
		let data_waktu_seminar;
		let data_ruang;
		const options = {
			weekday: 'long',
			year: 'numeric',
			month: 'long',
			day: 'numeric',
		};

		$(document).on('click', '.btn-detail-jadwal', function() {
				let data_jadwal = JSON.parse($(this).attr('data-jadwal'));
				// console.log(data_jadwal)
				data_nim = data_jadwal.nim;
				data_tgl_seminar = data_jadwal.tgl_seminar;
				data_waktu_seminar = data_jadwal.waktu_seminar;
				data_ruang = data_jadwal.ruang;
				
				let tanggal_seminar = new Date(data_jadwal.tgl_seminar);
				tanggal_seminar = tanggal_seminar.toLocaleDateString('id-ID', options);

				$("#data-nama").html(data_jadwal.mahasiswa.nama);
				$("#data-nim").html(data_jadwal.nim);
				$("#data-dospem").html(data_jadwal.dosen_pembimbing.nama);
				$("#data-tgl-seminar").html(tanggal_seminar);
				$("#data-waktu-seminar").html(data_jadwal.waktu_seminar);
				$("#data-ruang").html(data_jadwal.ruang);
				$('#data-instansi').html(data_jadwal.pkl.instansi);
				$('#data-judul').html(data_jadwal.pkl.judul);

			});
  </script>
@endpush