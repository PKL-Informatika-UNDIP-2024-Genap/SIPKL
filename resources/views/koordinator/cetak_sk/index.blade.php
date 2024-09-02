@extends('layouts.main')

@section('container')
<div class="content-header">
  <div class="container-fluid">
		<div class="row mb-2">
      <div class="col">
        <h1 class="m-0">Cetak SK PKL</h1>
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

						<form action="/cetak_sk/export" method="post" >
							@csrf
							{{-- input tgl_mulai --}}
							<div class="row justify-content-center mb-2">
								<div class="col-auto mb-2 d-flex  flex-wrap">
									{{-- <strong class="mr-3 text-lightblue">Input:</strong> --}}
									<label for="tgl_mulai" class="my-0 mr-2 fw-normal mt-2">Tanggal Mulai:</label>
									<div class="d-inline-block" style="width: 200px">
										<input type="date" class="form-control @error('tgl_mulai') is-invalid @enderror" id="tgl_mulai" name="tgl_mulai" value="{{ old('tgl_mulai') }}">
										@error('tgl_mulai')
											<div class="invalid-feedback">
												{{ $message }}
											</div>
										@enderror
									</div>
								</div>
								{{-- input tgl_selesai --}}
								<div class="col-auto mb-2 d-flex  flex-wrap">
									<label for="tgl_selesai" class="my-0 mr-2 fw-normal mt-2">Tanggal Selesai:</label>
									<div class="d-inline-block" style="width: 200px">
										<input type="date" class="form-control @error('tgl_selesai') is-invalid @enderror" id="tgl_selesai" name="tgl_selesai" value="{{ old('tgl_selesai') }}">
										@error('tgl_selesai')
											<div class="invalid-feedback">
												{{ $message }}
											</div>
										@enderror
									</div>
								</div>
								{{-- submit --}}
								<div class="col-auto mb-2 d-flex mb-auto">
									<button type="submit" id="cetakBtn" class="btn btn-primary">Cetak sebagai Excel</button>
								</div>

							</div>
						</form>

						<ul class="nav nav-tabs" id="myTab" role="tablist">
							<li class="nav-item" role="presentation">
								<button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Data SK</button>
							</li>
							<li class="nav-item" role="presentation">
								<button class="nav-link" id="preview-tab" data-bs-toggle="tab" data-bs-target="#preview-tab-pane" type="button" role="tab" aria-controls="preview-tab-pane" aria-selected="false">Preview Cetak SK</button>
							</li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane fade show active pt-2" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
								<div class="table-responsive pt-1">
									<table class="table" id="myTable">
										<thead>
												<tr class="table-primary">
														<th>No</th>
														<th>Nama Pembimbing<br>NIP</th>
														<th>Golongan<br>Jabatan</th>
														<th class="text-nowrap">Nama Mahasiswa<br>NIM</th>
														<th>Judul Laporan PKL</th>
														<th class="tanggal">Tanggal Verifikasi Laporan</th>
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
																<td>{{ $sk->tgl_verif_laporan }}</td>
														</tr>
												@endforeach
										</tbody>
									</table>
								</div>
							</div>

  						<div class="tab-pane fade pt-3" id="preview-tab-pane" role="tabpanel" aria-labelledby="preview-tab" tabindex="0">
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
							</div>
						</div>

					</div>
				</div>
			</div>

		</div>
	</div>
</section>
@endsection

@push('scripts')
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
					targets: 'tanggal',
					render: function (data, type, row) {
						// 'type' parameter specifies the purpose, 'display' for display, 'filter' for filtering,
						// and 'type' for sorting. We will only change the display format.
						if (type === 'display' && data) {
							// Assuming data is in 'YYYY-MM-DD' format
							// const dateObj = new Date(data);
							// const options = { year: 'numeric', month: 'long', day: 'numeric' };
							// const formattedDate = dateObj.toLocaleDateString('id-ID', options);
							return moment(data).format('DD MMMM YYYY');
						}
						return data;
					}
        }
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
					let tglMulai = $('#tgl_mulai').val();
					let tglSelesai = $('#tgl_selesai').val();

					if (tglMulai != "") {
						if (data[5] < tglMulai) {
							return false;
						}
					}
					if (tglSelesai != "") {
						if (data[5] > tglSelesai) {
							return false;
						}
					}
					return true;
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

		$('#tgl_mulai, #tgl_selesai').on('change', function() {
			table.draw();
		})

		// Konfirmasi sebelum cetak SK PKL
		$('#cetakBtn').on('click', function(e) {
			e.preventDefault();
			if (table.rows().count() == 0) {
				Swal.fire({
					title: 'Peringatan',
					text: 'Tidak ada data yang akan dicetak.',
					icon: 'warning'
				});
			} else {
				Swal.fire({
					title: 'Cetak SK PKL',
					text: 'Apakah Anda yakin ingin mencetak SK PKL? Terdapat ' + table.rows().count() + ' data yang akan dicetak.',
					icon: 'question',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Ya, Cetak!',
					cancelButtonText: 'Batal'
				}).then((result) => {
					if (result.isConfirmed) {
						$(this).off('click').click();
						setTimeout(() => {
							location.reload();
						}, 3000);
					}
				})
			}
		})
	});
</script>
	
@endpush