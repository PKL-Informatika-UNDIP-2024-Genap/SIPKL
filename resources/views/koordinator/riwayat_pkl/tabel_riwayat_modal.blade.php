<table class="table" id="myTable2">
	<thead>
			<tr class="table-primary">
					<th>No</th>
					<th>Periode PKL</th>
					<th>Status</th>
					<th>Dosen Pembimbing</th>
					<th class="action">Action</th>
			</tr>
	</thead>
	<tbody>
			@foreach ($data_riwayat_pkl as $riwayat_pkl)
					<tr>
							<td></td>
							<td>{{ $riwayat_pkl->periode_pkl }}</td>
							<td>{{ $riwayat_pkl->status }}</td>
							<td>{{ $riwayat_pkl->nama_dospem }}</td>
							<td>
									<div class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#modal_detail_mhs" data-mhs="{{ $riwayat_pkl }}">
										Detail
									</div>
							 
							</td>
					</tr>
			@endforeach
	</tbody>
</table>