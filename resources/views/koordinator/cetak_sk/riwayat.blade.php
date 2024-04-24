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
        <h1 class="m-0">Riwayat SK PKL</h1>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>

<section class="content">
  <div class="container-fluid">
    <div class="row">
			<div class="col">
				<div class="card">
					<div class="card-body">

						<form action="/cetak_sk/riwayat/export" method="post" >
							@csrf
							{{-- input tgl_mulai --}}
							<div class="row justify-content-center mb-2">
								<div class="col-auto mb-2 d-flex align-items-center flex-wrap">
									{{-- <strong class="mr-3 text-lightblue">Input:</strong> --}}
									<label for="periode_sk" class="my-0 mr-2 fw-normal">Periode SK:</label for="periode_sk">
										<div class="d-inline-block" style="width: 300px">
											<select name="periode_sk" id="periode_sk" class="form-control">
												<option value="" selected>Semua</option>
												@foreach ($periode_sk as $p_sk)
													<option value="{{ $p_sk[0] }}">{{ $p_sk[0].' - '.$p_sk[1] }}</option>
												@endforeach
											</select>
										</div>
								</div>
								{{-- submit --}}
								<div class="col-auto mb-2 d-flex mb-auto">
									<button type="submit" id="cetakBtn" class="btn btn-primary" disabled>Cetak Ulang sebagai Excel</button>
								</div>

							</div>
						</form>
						
						<ul class="nav nav-tabs" id="myTab" role="tablist">
							<li class="nav-item" role="presentation">
								<button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Data Riwayat SK</button>
							</li>
							{{-- <li class="nav-item" role="presentation">
								<button class="nav-link" id="preview-tab" data-bs-toggle="tab" data-bs-target="#preview-tab-pane" type="button" role="tab" aria-controls="preview-tab-pane" aria-selected="false">Preview Cetak Ulang SK</button>
							</li> --}}
						</ul>
						<div class="tab-content">
							<div class="tab-pane fade show active pt-2" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
								<div class="table-responsive pt-1">
									<table class="table" id="myTable" style="width: 100%">
										<thead>
												<tr class="table-primary">
														<th>No</th>
														<th>Nama Pembimbing<br>NIP</th>
														<th>Golongan<br>Jabatan</th>
														<th class="text-nowrap">Nama Mahasiswa<br>NIM</th>
														<th>Judul Laporan PKL</th>
														<th class="tanggal">Periode SK</th>
														<th class="tanggal hidden">Tanggal Selesai</th>
												</tr>
										</thead>
										<tbody>
												@foreach ($data_sk as $sk)
														<tr>
																<td></td>
																<td>{{ $sk->nama_dospem }}<br>{{ $sk->nip_dospem }}</td>
																<td>{{ $sk->gol_dospem }}<br>{{ $sk->jabatan_dospem }}</td>
																<td>{{ $sk->nama_mhs }}<br>{{ $sk->nim_mhs }}</td>
																<td>{{ $sk->judul_pkl }}</td>
																<td>{{ $sk->tgl_mulai }}</td>
																<td>{{ $sk->tgl_selesai }}</td>
														</tr>
												@endforeach
										</tbody>
									</table>
								</div>
							</div>

  						{{-- <div class="tab-pane fade pt-3" id="preview-tab-pane" role="tabpanel" aria-labelledby="preview-tab" tabindex="0">
								<div class="table-responsive">
									<table class="table table-bordered">
										<thead class="table-primary">
											<tr>
													<th>No</th>
													<th>Nama Pembimbing<br>NIP</th>
													<th>Golongan<br>Jabatan</th>
													<th class="text-nowrap">Nama Mahasiswa<br>NIM</th>
													<th>Judul Laporan PKL</th>
													<th>Jumlah</th>
											</tr>
										</thead>
										<tbody>
											@php
												$row = 0;
												$count = 1;
											@endphp
											@foreach ($data_sk as $sk)
												<tr>
													@if ($count == 1)
														<td rowspan="{!! $counter[$row] !!}" class="text-center">{{ $row+1 }}</td>
														<td rowspan="{!! $counter[$row] !!}">{{ $sk->nama_dospem }}<br>{{ $sk->nip_dospem }}</td>
														<td rowspan="{!! $counter[$row] !!}">{{ $sk->gol_dospem }}<br>{{ $sk->jabatan_dospem }}</td>
													@endif
			
														<td>{{ $sk->nama_mhs }}<br>{{ $sk->nim_mhs }}</td>
														<td>{{ $sk->judul_pkl }}</td>
			
													@if ($count == 1)
														<td rowspan="{!! $counter[$row] !!}" class="text-center">{{ $counter[$row] }}</td>
														@php
															$count = $counter[$row];
															$row++;
														@endphp
													@else
														@php
															$count--;
														@endphp
													@endif
												</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							</div> --}}
						</div>
						
					</div>
				</div>
			</div>

		</div>
	</div>
</section>
@endsection

@push('scripts')
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	<script type="text/javascript">
		$('#periode_sk').select2({
			theme: 'bootstrap-5',
			// allowClear: true,
			minimumResultsForSearch: Infinity,
			// placeholder: 'Semua',
			// width: '100%',
		});
	</script>

	<script src="/lte/plugins/moment/moment.min.js"></script>
	<script src="/lte/plugins/moment/locale/id.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			const table = new DataTable('#myTable', {
				columnDefs: [
					{
						searchable: false,
						orderable: false,
						targets: [0]
					},
					{
						targets: 'tanggal',
						render: function (data, type, row) {
							// 'type' parameter specifies the purpose, 'display' for display, 'filter' for filtering,
							// and 'type' for sorting. We will only change the display format.
							if (type === 'display' && data) {
								// Assuming data is in 'YYYY-MM-DD' format
								// const dateObj = new Date(data);
								// const options = { year: 'numeric', month: 'long', day: 'numeric' };
								// const formattedDate = dateObj.toLocaleDateString('id-ID', options);
								return moment(data).format('DD MMMM YYYY') + ' - ' + moment(row[6]).format('DD MMMM YYYY');
							}
							return data;
						}
					},
          {
            target: 'hidden',
            visible: false,
            searchable: false
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
						var selectedPeriodeSk = $('#periode_sk').val();
						if (selectedPeriodeSk == "") {
							return true;
						}
						if (selectedPeriodeSk == "") {
							return true;
						}
						if (selectedPeriodeSk == data[5]) {
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

			$('#periode_sk').on('change', function() {
				table.draw();
			});

			$('#periode_sk option').each(function() {
				var dates = $(this).text().split(' - ');
				$(this).text(moment(dates[0],"YYYY-MM-DD").format('D MMMM YYYY') + ' - ' + moment(dates[1],"YYYY-MM-DD").format('D MMMM YYYY'));
			});

			$('#periode_sk').on('change', function() {
				if ($(this).val() == "") {
					$('#cetakBtn').prop('disabled', true);
				} else {
					$('#cetakBtn').prop('disabled', false);
				}
			});
		});
	</script>
	
@endpush