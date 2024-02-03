@extends('layouts.main_mhs')

@section('container')
	<!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
			<div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Laporan PKL</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item active">Laporan PKL</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
		</div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content" id="main-content">
    <div class="container-fluid">
      <div class="row">
				<div class="col-12">
          <div class="card card-primary card-outline">
            <div class="card-body">

              @if ($pkl->status == 'Aktif' && $pkl->pesan != null)
              <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-bs-dismiss="alert" aria-hidden="true" aria-label="Close">&times;</button>
                <h5><strong><i class="icon bi bi-exclamation-triangle-fill"></i> Perhatian!</strong></h5>
                Laporan PKL Anda ditolak. Silahkan perbaiki dan kirim ulang. Pesan: <strong><em>“{{ $seminar_pkl->pesan }}”</em></strong>&nbsp;&nbsp;
                {{-- <button type="button" id="btn-daftar-ulang" class="btn btn-primary btn-sm py-0">Daftar Ulang</button> --}}
              </div>
              @endif

							<p><strong class="text-lightblue">Data Laporan PKL Saya</strong></p>
							<div class="row">
								<div class="col-md-6">

								</div>

							</div>
              <div class="table-responsive p-0 mb-3">
                <table class="table table-hover">
                  <tbody>
										<tr>
											<td class="text-nowrap px-0" style="width: 20%"><strong>Status</strong></td>
											<td style="white-space: nowrap; width: 1%">:</td>
											<td><strong class="{{ ($pkl->status == 'Selesai')?'bg-success':'bg-primary' }} px-2 py-1 rounded-1">{{ $pkl->status }}</strong></td>
										</tr>

                    {{-- @if ($pkl->status == 'Aktif' && $pkl->pesan == null) --}}
                    <tr>
                      <td class="text-nowrap px-0 text-center" style="white-space: nowrap; width: 1%" colspan="3"><strong>Belum Mengirim Laporan</strong></td>
                    </tr>

                    {{-- @else --}}
                    <tr>
                      <td class="text-nowrap px-0"><strong>Instansi</strong></td>
                      <td style="white-space: nowrap; width: 1%">:</td>
                      <td>{{ $pkl->instansi }}</td>
                    </tr>
                    <tr>
                      <td class="text-nowrap px-0"><strong>Judul PKL</strong></td>
                      <td style="white-space: nowrap; width: 1%">:</td>
                      <td>{{ $pkl->judul }}</td>
                    </tr>
                    <tr>
                      <td class="text-nowrap px-0"><strong>Abstrak</strong></td>
                      <td style="white-space: nowrap; width: 1%">:</td>
                      <td>{{ $pkl->abstrak }}</td>
                    </tr>
                    <tr>
                      <td class="text-nowrap px-0"><strong>Kata Kunci</strong></td>
                      <td style="white-space: nowrap; width: 1%">:</td>
                      <td>
												@if ($pkl->keyword1)
													<span class="badge bg-primary">{{ $pkl->keyword1 }}</span>
												@endif
												@if ($pkl->keyword2)
													<span class="badge bg-primary">{{ $pkl->keyword2 }}</span>
												@endif
												@if ($pkl->keyword3)
													<span class="badge bg-primary">{{ $pkl->keyword3 }}</span>
												@endif
												@if ($pkl->keyword4)
													<span class="badge bg-primary">{{ $pkl->keyword4 }}</span>
												@endif
												@if ($pkl->keyword5)
													<span class="badge bg-primary">{{ $pkl->keyword5 }}</span>
												@endif
											</td>
                    </tr>
                    
                    <tr>
                      <td class="text-nowrap px-0" colspan="3"><strong>Link Laporan</strong> &nbsp;<a href="{{ $pkl->link_laporan }}" target="_blank" class="btn btn-outline-info btn-sm py-0 @if ($pkl->link_laporan == null) disabled @endif">Pergi ke link</a></td>
                    </tr>
                    {{-- @endif --}}

                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->


              @if ($pkl->status == 'Aktif' || ($pkl->pesan != null))
              <p>Kirim laporan sebelum Periode PKL berakhir. (Wajib)</p>
              <button type="button" id="btn-lapor" class="btn btn-primary">Buat Laporan</button>
              @endif
    
            </div>
          </div>
          <!-- /.card -->

        </div>
			</div>
			<!-- /.row -->

			<div class="row">
				
			</div>

    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->

@endsection

