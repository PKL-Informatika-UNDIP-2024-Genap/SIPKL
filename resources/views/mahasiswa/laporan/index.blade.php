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
                Laporan PKL Anda ditolak. Silahkan perbaiki dan kirim ulang. Pesan: <strong><em>“{{ $pkl->pesan }}”</em></strong>&nbsp;&nbsp;
                <button type="button" id="btn-lapor-ulang" class="btn btn-primary btn-sm py-0">Kirim Ulang Laporan</button>
              </div>
            @endif

							<p><strong class="text-lightblue">Data Laporan PKL Saya</strong></p>
							{{-- <div class="row">
								<div class="col-md-6">

								</div>
							</div> --}}
              <div class="table-responsive p-0 mb-3">
                <table class="table table-hover">
                  <tbody>
										<tr>
											<td class="text-nowrap px-0" style="width: 20%"><strong>Status</strong></td>
											<td style="white-space: nowrap; width: 1%">:</td>
											<td><strong class="{{ ($pkl->status == 'Selesai')?'bg-success':'bg-primary' }} px-2 py-1 rounded-1">{{ $pkl->status }}</strong></td>
										</tr>

                    <tr>
                      <td class="px-0 text-center" colspan="3">
												@if ($pkl->status == 'Aktif')
													@if ($pkl->pesan == null)
													<strong class="text-warning">Belum Mengirim Laporan</strong>
													@else
													<strong class="text-pink">Laporan ditolak. Silahkan diperbaiki.</strong>
													@endif
												@elseif ($pkl->status == 'Laporan')
												<strong class="text-primary">Menunggu konfirmasi.</strong>
												@elseif ($pkl->status == 'Selesai')
												<strong class="text-success">Laporan diterima.</strong>
												@endif
											</td>
                    </tr>

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
                      <td></td>
                    </tr>
                    <tr>
                      <td class="px-0" colspan="3">{{ $pkl->abstrak }}</td>
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

                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->


            @if ($pkl->status == 'Aktif')
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
				
			@if ($pkl->status == 'Aktif')
        <div class="col-12">
          <div class="card card-primary collapsed-card" id="form-section">
            <div class="card-header">
              <h3 class="card-title">Form Pengumpulan Laporan PKL</h3>
      
              <div class="card-tools">
                <a href="#form-section" class="btn btn-tool" id="btn-form" data-card-widget="collapse"><i class="bi bi-plus fs-4"></i>
                </a>
              </div>
              <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <!-- form start -->
              <form action="/laporan/kirim" class="needs-validation" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="nama">Nama</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                        </div>
                        <input type="text" class="form-control" id="nama" value="{{ $mahasiswa->nama }}" readonly>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="nim">NIM</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="bi bi-person-vcard-fill"></i></span>
                        </div>
                        <input type="text" class="form-control" id="nim" name="nim" value="{{ $mahasiswa->nim }}" readonly>
                      </div>
                    </div>
									</div>
									<div class="col-md-6">
                    <input type="text" class="form-control" id="id_dospem" name="id_dospem" value="{{ $mahasiswa->id_dospem }}" hidden>
                    <div class="form-group">
                      <label for="nama_dospem">Dosen Pembimbing</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="bi bi-person-check-fill"></i></span>
                        </div>
                        <input type="text" class="form-control" id="nama_dospem" name="nama_dospem" value="{{ $mahasiswa->dosen_pembimbing->nama }}" readonly>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="tgl_seminar">Tanggal Seminar</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="bi bi-calendar-event-fill"></i></span>
                        </div>
                        <input type="date" class="form-control" id="tgl_seminar" name="tgl_seminar" value="{{ $mahasiswa->seminar_pkl->tgl_seminar }}" readonly>
                        @error('tgl_seminar')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                      </div>
                    </div>
									</div>
                  <div class="col-12">
										<div class="form-group">
											<label for="instansi">Instansi (Final)</label>
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text"><i class="bi bi-building-fill"></i></span>
												</div>
												<input type="text" class="form-control @error('instansi') is-invalid @enderror" id="instansi" name="instansi" placeholder="Masukkan nama Instansi final" value="{{ old('instansi',$pkl->instansi) }}">
												@error('instansi')
													<div class="invalid-feedback">
														{{ $message }}
													</div>
												@enderror
											</div>
										</div>
                    <div class="form-group">
											<label for="judul">Judul PKL (Final)</label>
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text"><i class="bi bi-fonts"></i></span>
												</div>
												<input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" placeholder="Masukkan Judul PKL final" value="{{ old('judul', $pkl->judul) }}">
												@error('judul')
													<div class="invalid-feedback">
														{{ $message }}
													</div>
												@enderror
											</div>
										</div>
										<div class="form-group">
											<label for="link_laporan">Link Laporan</label>
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text"><i class="bi bi-link"></i></span>
												</div>
												<input type="url" class="form-control @error('link_laporan') is-invalid @enderror" id="link_laporan" name="link_laporan" placeholder="Masukkan link laporan yang valid" value="{{ old('link_laporan',$pkl->link_laporan) }}">
												@error('link_laporan')
													<div class="invalid-feedback">
														{{ $message }}
													</div>
												@enderror
											</div>
										</div>
                  </div>
                </div>

                <div class="callout callout-warning text-secondary">
                  {{-- <p>Follow the steps to continue to payment.</p> --}}
                  <em>*Isi abstrak dan 3-5 kata kunci berdasarkan laporan PKL</em>
                </div>

								<div class="row">
									<div class="col-12">
										<div class="form-group">
											<label for="abstrak">Abstrak</label>
											<textarea class="form-control @error('abstrak') is-invalid @enderror" id="abstrak" name="abstrak" placeholder="Masukkan Abstrak" rows="5">{{ old('abstrak', $pkl->abstrak) }}</textarea>
											@error('abstrak')
												<div class="invalid-feedback">
													{{ $message }}
												</div>
											@enderror
										</div>
										<div class="form-group">
											<label for="keyword1">Kata Kunci 1</label>
											<div class="input-group">
												<div class="input-group-prepend">
                          <span class="input-group-text"><i class="bi bi-tag-fill"></i></span>
                        </div>
												<input type="text" class="form-control @error('keyword1') is-invalid @enderror" id="keyword1" name="keyword1" placeholder="Masukkan Kata Kunci 1" value="{{ old('keyword1', $pkl->keyword1) }}">
												@error('keyword1')
													<div class="invalid-feedback">
														{{ $message }}
													</div>
												@enderror
											</div>
										</div>
										<div class="form-group">
											<label for="keyword2">Kata Kunci 2</label>
											<div class="input-group">
												<div class="input-group-prepend">
                          <span class="input-group-text"><i class="bi bi-tag-fill"></i></span>
                        </div>
												<input type="text" class="form-control @error('keyword2') is-invalid @enderror" id="keyword2" name="keyword2" placeholder="Masukkan Kata Kunci 2" value="{{ old('keyword2', $pkl->keyword2) }}">
												@error('keyword2')
													<div class="invalid-feedback">
														{{ $message }}
													</div>
												@enderror
											</div>
										</div>
										<div class="form-group">
											<label for="keyword3">Kata Kunci 3</label>
											<div class="input-group">
												<div class="input-group-prepend">
                          <span class="input-group-text"><i class="bi bi-tag-fill"></i></span>
                        </div>
												<input type="text" class="form-control @error('keyword3') is-invalid @enderror" id="keyword3" name="keyword3" placeholder="Masukkan Kata Kunci 3" value="{{ old('keyword3', $pkl->keyword3) }}">
												@error('keyword3')
													<div class="invalid-feedback">
														{{ $message }}
													</div>
												@enderror
											</div>
										</div>
										<div class="form-group">
											<label for="keyword4">Kata Kunci 4 (Opsional)</label>
											<div class="input-group">
												<div class="input-group-prepend">
                          <span class="input-group-text"><i class="bi bi-tag-fill"></i></span>
                        </div>
												<input type="text" class="form-control @error('keyword4') is-invalid @enderror" id="keyword4" name="keyword4" placeholder="Masukkan Kata Kunci 4" value="{{ old('keyword4', $pkl->keyword4) }}">
												@error('keyword4')
													<div class="invalid-feedback">
														{{ $message }}
													</div>
												@enderror
											</div>
										</div>
										<div class="form-group">
											<label for="keyword5">Kata Kunci 5 (Opsional)</label>
											<div class="input-group">
												<div class="input-group-prepend">
                          <span class="input-group-text"><i class="bi bi-tag-fill"></i></span>
                        </div>
												<input type="text" class="form-control @error('keyword5') is-invalid @enderror" id="keyword5" name="keyword5" placeholder="Masukkan Kata Kunci 5" value="{{ old('keyword5', $pkl->keyword5) }}">
												@error('keyword5')
													<div class="invalid-feedback">
														{{ $message }}
													</div>
												@enderror
											</div>
										</div>
									</div>
								</div>

								@if ($pkl->status == 'Aktif' && $pkl->pesan != null)
								<div class="alert alert-warning alert-dismissible fade show" role="alert">
									<button type="button" class="close" data-bs-dismiss="alert" aria-hidden="true" aria-label="Close">&times;</button>
									{{-- <h5><strong><i class="icon bi bi-exclamation-triangle-fill"></i> Perhatian!</strong></h5> --}}
									<i class="icon bi bi-exclamation-triangle-fill"></i> Pesan: <strong><em>“{{ $pkl->pesan }}”</em></strong>
								</div>
								@endif

                <div class="form-check ms-1 mb-3">
                  <input type="checkbox" class="form-check-input" id="checkbox1">
                  <label class="form-check-label" for="checkbox1"><em>Pastikan semua data sudah benar, dan link laporan valid dan dapat diakses.</em></label>
                </div>
                
                <button type="submit" class="btn btn-primary">Kirim</button>
              </form>
              <!-- /form end -->
							
            </div>
            <!-- /.card-body -->
            {{-- <div class="card-footer">
            </div> --}}
          </div>
          <!-- /.card -->
					
        </div>
      @endif

			</div>

    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->

@endsection

@push('scripts')

@if ($pkl->status == 'Aktif')
	<script type="text/javascript">
		function goToForm() {
      setTimeout(() => {
        document.querySelector($('#btn-form').attr('href')).scrollIntoView({
          behavior: "smooth",
          offsetTop: 1 - 60,
        });
        $('#btn-lapor').prop('disabled', false);
      }, 500);
    }
    $('#btn-lapor').click(function() {
      $(this).prop('disabled', true);
      $('#btn-form').click();
    })
    $('#btn-form').click(function() {
      if ($('#form-section').hasClass('collapsed-card')) {
        $('#btn-lapor').removeClass('btn-primary');
        $('#btn-lapor').addClass('btn-secondary');
        $('#btn-lapor').html('Tutup');
        goToForm();
      } else {
        $('#btn-lapor').removeClass('btn-secondary');
        $('#btn-lapor').addClass('btn-primary');
        $('#btn-lapor').html('Buat Laporan');
        setTimeout(() => {
          $('#btn-lapor').prop('disabled', false);
        }, 500);
      }
    });
		$('#btn-lapor-ulang').click(function() {
      $(this).prop('disabled', true);
      if ($('#form-section').hasClass('collapsed-card')) {
        $('#btn-form').click();
      }
      goToForm();
      setTimeout(() => {
        $('#btn-lapor-ulang').prop('disabled', false);
      }, 500);
    })


		if ($("#checkbox1").checked) {
      $('button[type=submit]').prop('disabled', false);
    } else {
      $('button[type=submit]').prop('disabled', true);
    }
    $("#checkbox1").change(function() {
      if(this.checked) {
        this.classList.add('is-valid');
        $('button[type=submit]').prop('disabled', false);
      } else {
        this.classList.remove('is-valid');
        $('button[type=submit]').prop('disabled', true);
      }
    });

		//add alert confirmation before submiting form
		$('button[type=submit]').click(function() {
			event.preventDefault();
			Swal.fire({
				title: 'Apakah data sudah benar?',
				text: "Pastikan semua data sudah benar, dan link laporan valid dan dapat diakses.",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#007bff',
        cancelButtonColor: '#dc3545',
        confirmButtonText: 'Ya, Kirim!',
        cancelButtonText: 'Batal'
			}).then((result) => {
				if (result.isConfirmed) {
					$('form').submit();
				}
			})
		});
    
    // disable submit button
    $('form').submit(function() {
      // show spinner on button
      $('button[type=submit]').html(`
        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
        Mengirim...
      `);
      $('button[type=submit]').prop('disabled', true);
    });
	</script>
@endif

@if (session()->has('fails'))
	<script>
		if ($('#form-section').hasClass('collapsed-card')) {
			$('#btn-form').click();
		}
		goToForm();
	</script>
@endif


@if (session()->has('success'))
	<script>
	$(document).ready(function(){
		Swal.fire({
			icon: 'success',
			title: 'Berhasil!',
			text: '{{ session('success') }}',
			// showConfirmButton: false,
			timer: 1500
		})
	});
	</script>
@endif
@endpush