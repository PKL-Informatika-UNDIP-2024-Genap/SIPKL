<table class="table" id="myTable2">
	<thead>
			<tr class="table-primary">
					<th>No</th>
					<th>Periode PKL</th>
					<th>Status</th>
					<th>Nama Pembimbing</th>
					<th>NIP Pembimbing</th>
			</tr>
	</thead>
	<tbody>
			@foreach ($data_riwayat_pkl as $riwayat_pkl)
					<tr>
							<td></td>
							<td>{{ $riwayat_pkl->periode_pkl }}</td>
							<td>{{ $riwayat_pkl->status }}</td>
							<td>{{ $riwayat_pkl->nama_dospem }}</td>
							<td>{{ $riwayat_pkl->nip_dospem }}</td>
					</tr>
			@endforeach

			@if ($data_pkl)
					<tr>
							<td class="text-success"></td>
							<td class="text-success">{{ $data_pkl['periode_pkl'] }}</td>
							<td class="text-success">{{ $data_pkl['status'] }}</td>
							<td class="text-success">{{ $data_pkl['nama_dospem'] }}</td>
							<td class="text-success">{{ $data_pkl['nip_dospem'] }}</td>
					</tr>
			@endif
	</tbody>
</table>