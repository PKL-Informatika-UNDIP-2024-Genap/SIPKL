@extends('layouts.main')

@section('container')
<div class="content-header">
  <div class="container-fluid">
		<div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Cetak SK PKL</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>

<section class="content">
  <div class="container-fluid">
    <div class="row">
			<div class="col">
				<div class="card">
					<div class="card-body table-responsive">
						<div class="mb-2 text-right">
							<a href="/cetak_sk/export" class="btn btn-primary">Export sebagai Excel</a>
						</div>

						<table class="table table-bordered">
							<thead class="table-primary">
								<tr>
										<th>No</th>
										<th>Nama Dosen<br>NIP</th>
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
</section>
@endsection