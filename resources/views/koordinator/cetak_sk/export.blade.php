<br>
<table>
	<thead>
		<tr>
				<th >NO</th>
				<th >NAMA DOSEN<br>NIP</th>
				<th >GOLONGAN<br>JABATAN</th>
				<th >NAMA MAHASISWA<br>NIM</th>
				<th >JUDUL LAPORAN PKL</th>
				<th >JUMLAH</th>
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
					<td rowspan="{!! $counter[$row] !!}">{{ $row+1 }}</td>
					<td rowspan="{!! $counter[$row] !!}">{{ $sk->nama_dospem }}<br>{{ $sk->nip_dospem }}</td>
					<td rowspan="{!! $counter[$row] !!}">{{ $sk->gol_dospem }}<br>{{ $sk->jabatan_dospem }}</td>
				@endif

					<td>{{ $sk->nama_mhs }}<br>{{ $sk->nim_mhs }}</td>
					<td>{{ $sk->judul_pkl }}</td>

				@if ($count == 1)
					<td rowspan="{!! $counter[$row] !!}" class="text-right">{{ $counter[$row] }}</td>
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