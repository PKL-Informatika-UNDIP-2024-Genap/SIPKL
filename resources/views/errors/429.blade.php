@extends('errors.layout')

@section('container')

	<!-- Content Header (Page header) -->
	<section class="content-header">
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="error-page">
			<h2 class="headline text-warning"> 429</h2>

			<div class="error-content">
				<h3><i class="bi bi-exclamation-triangle-fill text-warning"></i> Too Many Request</h3>

				<p>
					Permintaan Anda terlalu banyak.
					Sementara itu, Anda dapat <a href="/">kembali ke halaman utama</a>.
				</p>
			</div>
			<!-- /.error-content -->
		</div>
		<!-- /.error-page -->
	</section>
	<!-- /.content -->

@endsection