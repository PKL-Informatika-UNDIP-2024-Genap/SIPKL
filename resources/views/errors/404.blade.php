@extends('errors.layout')

@section('container')

	<!-- Content Header (Page header) -->
	<section class="content-header">
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="container">
			<div class="row">
				<div class="error-page">
					<h2 class="headline text-warning"> 404</h2>
		
					<div class="error-content">
						<h3><i class="bi bi-exclamation-triangle-fill text-warning"></i> Waduh! Halaman tidak ditemukan.</h3>
		
						<p>
							Kami tidak dapat menemukan halaman yang Anda cari.
							Sementara itu, Anda dapat <a href="/">kembali ke halaman utama</a>.
						</p>
		
						{{-- <form class="search-form">
							<div class="input-group">
								<input type="text" name="search" class="form-control" placeholder="Search">
		
								<div class="input-group-append">
									<button type="submit" name="submit" class="btn btn-warning"><i class="bi bi-search"></i>
									</button>
								</div>
							</div>
							<!-- /.input-group -->
						</form> --}}
					</div>
					<!-- /.error-content -->
				</div>
				<!-- /.error-page -->
			</div>
			<div class="d-flex justify-content-center">
				<img src="{{ asset('images/logo_if.png') }}" alt="Logo Undip" width="100px">
				<img src="{{ asset('images/logo_undip.png') }}" alt="Logo Undip" width="100px">
			</div>
		</div>
	</section>
	<!-- /.content -->

@endsection