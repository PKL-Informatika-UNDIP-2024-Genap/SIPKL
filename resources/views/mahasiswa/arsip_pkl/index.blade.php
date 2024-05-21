@extends('layouts.main_mhs')

@section('container')
	<!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
			<div class="row mb-2">
        <div class="col">
          <h1 class="m-0">Arsip PKL</h1>
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

              <div class="row">
                <div class="col d-flex align-items-center justify-content-between gap-1">
                  <strong class="text-lightblue my-3">Arsip PKL Saya</strong>
                  {{--  --}}
                </div>
              </div>
							
              <div class="table-responsive p-0 mb-3">
                <table class="table table-hover">
                  <tbody>
										<tr>
											<td class="text-nowrap px-0" style="width: 20%"><strong>Nama</strong></td>
											<td style="white-space: nowrap; width: 1%">:</td>
                      <td>{{ $arsip_pkl->nama }}</td>
										</tr>
                    <tr>
                      <td class="text-nowrap px-0"><strong>NIM</strong></td>
                      <td style="white-space: nowrap; width: 1%">:</td>
                      <td>{{ $arsip_pkl->nim }}</td>
                    </tr>
                    <tr>
                      <td class="text-nowrap px-0"><strong>Periode Lulus</strong></td>
                      <td style="white-space: nowrap; width: 1%">:</td>
                      <td>{{ $arsip_pkl->periode_pkl }}</td>
                    </tr>
                    <tr>
                      <td class="text-nowrap px-0"><strong>Nilai</strong></td>
                      <td style="white-space: nowrap; width: 1%">:</td>
                      <td>
												@if ($arsip_pkl->nilai == "A")
													<strong class="bg-success px-2 py-1 rounded-1">A</strong>
												@elseif($arsip_pkl->nilai == "B")
													<h4><span class="bg-primary px-2 py-1 rounded-1">B</span></h4>
												@else
													<h4><span class="bg-warning px-2 py-1 rounded-1">C</span></h4>
												@endif
											</td>
                    </tr>

                    <tr>
                      <td class="text-nowrap px-0"><strong>Instansi</strong></td>
                      <td style="white-space: nowrap; width: 1%">:</td>
                      <td>{{ $arsip_pkl->instansi }}</td>
                    </tr>
                    <tr>
                      <td class="text-nowrap px-0"><strong>Judul PKL</strong></td>
                      <td style="white-space: nowrap; width: 1%">:</td>
                      <td>{{ $arsip_pkl->judul }}</td>
                    </tr>
                    <tr>
                      <td class="text-nowrap px-0" style="border-bottom:none"><strong>Abstrak</strong></td>
                      <td style="white-space: nowrap; width: 1%; border-bottom: none">:</td>
                      <td style="border-bottom:none"></td>
                    </tr>
                    <tr>
                      <td class="px-0" colspan="3" style="border-top:none">{{ $arsip_pkl->abstrak }}</td>
                    </tr>
                    <tr>
                      <td class="text-nowrap px-0"><strong>Kata Kunci</strong></td>
                      <td style="white-space: nowrap; width: 1%">:</td>
                      <td>
												@if ($arsip_pkl->keyword1)
													<span class="badge bg-primary">{{ $arsip_pkl->keyword1 }}</span>
												@endif
												@if ($arsip_pkl->keyword2)
													<span class="badge bg-primary">{{ $arsip_pkl->keyword2 }}</span>
												@endif
												@if ($arsip_pkl->keyword3)
													<span class="badge bg-primary">{{ $arsip_pkl->keyword3 }}</span>
												@endif
												@if ($arsip_pkl->keyword4)
													<span class="badge bg-primary">{{ $arsip_pkl->keyword4 }}</span>
												@endif
												@if ($arsip_pkl->keyword5)
													<span class="badge bg-primary">{{ $arsip_pkl->keyword5 }}</span>
												@endif
											</td>
                    </tr>
                    <tr>
                      <td class="text-nowrap px-0" colspan="3"><strong>Link Berkas</strong> &nbsp;<a href="{{ $arsip_pkl->link_berkas }}" target="_blank" class="btn btn-outline-info btn-sm py-0 @if ($arsip_pkl->link_berkas == null) disabled @endif">Pergi ke link</a></td>
                    </tr>

                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
    
            </div>
          </div>
          <!-- /.card -->

        </div>
			</div>
			<!-- /.row -->


		</div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->

@endsection