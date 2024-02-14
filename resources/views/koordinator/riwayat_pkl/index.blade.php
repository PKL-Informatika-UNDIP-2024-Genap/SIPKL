@extends('layouts.main')

@push('styles')
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" /> --}}
	<link rel="stylesheet" href="/plugins/select2-bootstrap5-theme/select2-bootstrap5.min.css">
@endpush

@section('container')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col">
        <h1 class="m-0">Riwayat PKL</h1>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="card px-3">
      <div class="card-body table-responsive px-0" id="tabel-mhs">
				<div class="row justify-content-center">
					{{-- <div class="col-auto mb-2 d-flex align-items-center">
						<strong class="m-0">Filter:</strong>
					</div> --}}
					<div class="col-auto mb-2 d-flex align-items-center">
						<strong class="mr-3 text-lightblue">Filter:</strong>
						<label for="status" class="my-0 mr-2 fw-normal">Status:</label for="status">
						<div class="d-inline-block" style="width: 200px">
							<select name="status" id="status" class="form-control">
								<option value="" selected>Semua</option>
								<option value="Baru">Baru (Belum Pra-Reg)</option>
								<option value="Nonaktif">Nonaktif</option>
								<option value="Aktif">Aktif</option>
								<option value="Lulus">Lulus</option>
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
                  <th>Status</th>
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
                      <td class="py-0 align-middle">
                          <div class="btn btn-primary detailRiwayatBtn" data-bs-toggle="modal" data-bs-target="#modal_detail_mhs" data-mhs="{{ $mhs }}">
                            Detail
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

@include('koordinator.riwayat_pkl.modal_riwayat')

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
				order: [[1, 'asc']],
				lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
				pageLength: 10,
				"initComplete": function(settings, json) {
					$.fn.dataTable.ext.search.push(
					function (setting, data, index) {
						if (setting.nTable.id !== 'myTable') {
							return true;
						}
						var selectedStatus = $('#status').val();
						if (selectedStatus == "") {
							return true;
						}
						if (selectedStatus == data[3]) {
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
			// 		if (selectedStatus == data[3]) {
			// 			return true;
			// 		}
			// 		return false;
			// 	});
		});
	</script>

	<script type="text/javascript">
		$(document).on("click", ".detailRiwayatBtn", function(e){
			e.preventDefault();
			let table_modal;
			let data_mhs = $(this).data("mhs");
			let nim = data_mhs.nim;
			let nama = data_mhs.nama;
			let status = data_mhs.status;
			let id_dospem = data_mhs.id_dospem || "-";
			let periode_pkl = data_mhs.periode_pkl || "-";
			// let dospem = "-";

			$("#data-nama").html(": " + nama);
			$("#data-nim").html(": " + nim);
			$("#data-status").html(": " + status);
			$("#data-periode-pkl").html(": " + periode_pkl);
			// $("#data-dospem").html(": " + dospem);

			$('#tabel-modal').html('<div class="d-flex align-items-center"><div class="spinner-border spinner-border-lg me-2" role="status" aria-hidden="true"></div><div class="fs-5">Mengambil Data Mahasiswa...</div></div>');

			$.ajax({
				type: "GET",
				url: "/riwayat_pkl/" + nim + "/get_data_riwayat",
				data: {
					status: status,
					periode_pkl: periode_pkl,
					id_dospem: id_dospem,
				},
				success: function (response) {
					$('#tabel-modal').html(response.view);
					if (table_modal) {
						table_modal.destroy();
					}
					table_modal = new DataTable('#myTable2', {
						columnDefs: [
							{
								searchable: false,
								orderable: false,
								targets: [0,"action"]
							},
						],
						order: [[1, 'asc']],
						lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
						pageLength: 5,
					});
					// $('#myTable2_filter input').css('width', '200px');
					table_modal.on('order.dt search.dt', function () {
						let i = 1;
						table_modal
							.cells(null, 0, { search: 'applied', order: 'applied' })
							.every(function (cell) {
									this.data(i++);
							});
					}).draw();
				}
			});

			// if(id_dospem != "-"){
			// 	$(".spinner").removeClass("d-none");
			// 	$(".content-modal").addClass("d-none");
			// 	console.log(id_dospem);
			// 	$.ajax({
			// 		url: '/mhs/kelola_mhs/'+ id_dospem +'/get_data_dospem',
			// 		type: 'GET',
			// 		success: function (response) {
			// 			dospem = response.nama_dospem;
			// 			$("#data-dospem").html(": " + dospem);
			// 			console.log("success");
			// 		},
			// 		error: function (error) {
			// 			console.error('Error:', error);
			// 			Swal.fire({
			// 				title: 'Error!',
			// 				text: 'Terjadi kesalahan saat mengambil data.',
			// 				icon: 'error',
			// 			});
			// 		},
			// 		complete: function () {
			// 			$(".spinner").addClass("d-none");
			// 			$(".content-modal").removeClass("d-none");
			// 		},
			// 	});
			// }
		});
	</script>
@endpush