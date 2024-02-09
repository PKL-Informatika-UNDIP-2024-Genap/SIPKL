<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="csrf-token" content="{{ csrf_token() }}">
  <title>SIPKL</title>
	<link
  rel="shortcut icon"
  href="/images/logo_if.png"
  />
	<!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <!-- Theme style -->
  <link rel="stylesheet" href="/lte/dist/css/adminlte.min.css">
</head>
<body class="hold-transition register-page">
	<div class="register-box">
		<div class="card card-outline card-primary">
			<div class="card-header text-center">
				<a href="/" class="h1"><b>SIPKL</b>Informatika</a>
			</div>
			<div class="card-body">
				{{-- <div class="alert alert-success alert-dismissible fade show" role="alert">
					<button type="button" class="close" data-bs-dismiss="alert" aria-hidden="true" aria-label="Close">&times;</button>
					<i class="icon bi bi-check-lg"></i> Email terkirim. Silahkan cek email Anda.
				</div> --}}
				<p class="login-box-msg"><strong>Verifikasi Email</strong><br>Kode OTP akan dikirimkan ke email yang telah Anda masukkan.</p>
	
				@if (session('otp'))
				<form action="{{ route('verifikasi_email') }}" method="post">
				@else
				<form action="{{ route('send_otp') }}" method="post">
				@endif
					@csrf
					<div class="form-group">
						<div class="input-group">
							<input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ $email }}" readonly>
							<div class="input-group-append">
								<div class="input-group-text">
									<span class="bi bi-envelope-at-fill"></span>
								</div>
							</div>
							@error('email')
								<div class="invalid-feedback">
									{{ $message }}
								</div>
							@enderror
						</div>
					</div>
					<div class="form-group" id="otpArea">
						@if (session('otp'))
							<div class="input-group">
								<input type="otp" id="otp" name="otp" class="form-control @error('otp') is-invalid @enderror" placeholder="Kode OTP">
								<div class="input-group-append">
									<div class="input-group-text">
										<span class="bi bi-lock-fill"></span>
									</div>
								</div>
								@error('otp')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
							<div class="invalid-feedback d-block" id="email-err"></div>

						@else
							<div class="input-group">
								<input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
								<div class="input-group-append">
									<div class="input-group-text">
										<span class="bi bi-key-fill"></span>
									</div>
								</div>
								@error('password')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
							<div class="invalid-feedback d-block" id="password-err"></div>
							
						@endif
					</div>
					<div class="row">
						<div class="col-8"></div>
						<!-- /.col -->
						<div class="col-4">
							@if (session('otp'))
								<button type="submit" class="btn btn-primary btn-block"><b>Submit</b></button>
							@else
								<button type="submit" id="kirimOtpBtn" class="btn btn-primary btn-block"><b>Kirim OTP</b></button>
							@endif
						</div>
						<!-- /.col -->
					</div>
				</form>
				{{-- <div class="social-auth-links text-center">
					<a href="#" class="btn btn-block btn-primary">
						<i class="bi bi-person-fill mr-2"></i>
						Sign up using Facebook
					</a>
				</div> --}}
	
				<a href="/profile" class="text-center" style="text-decoration: underline">Kembali</a>
			</div>
			<!-- /.form-box -->
		</div><!-- /.card -->
	</div>
	<!-- /.register-box -->

<!-- jQuery -->
<script src="/lte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 5 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
<!-- AdminLTE App -->
<script src="/lte/dist/js/adminlte.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
		// kirim otp
		$('#kirimOtpBtn').click(function (e) {
			e.preventDefault();
			var emailEl = $('#email');
			var passwordEl = $('#password');
			let validated = true;
			if (emailEl.val() == '') {
				emailEl.addClass('is-invalid');
				$('#email-err').html('Email tidak boleh kosong');
				validated = false;
			} else {
				emailEl.removeClass('is-invalid');
				$('#email-err').html('');
			}

			if (passwordEl.val() == '') {
				passwordEl.addClass('is-invalid');
				$('#password-err').html('Password tidak boleh kosong');
				validated = false;
			} else {
				passwordEl.removeClass('is-invalid');
				$('#password-err').html('');
			}
			if (!validated) return false;
			$('form').submit();

		});
	});
</script>

{{-- @if (session()->has('fails'))
	<script type="text/javascript">
	$(document).ready(function(){
		Swal.fire({
			icon: 'error',
			title: 'Gagal!',
			text: '{{ session('fails') }}',
			// showConfirmButton: false,
			timer: 1500
		})
	});
	</script>
@endif --}}

@if (session()->has('success'))
	<script type="text/javascript">
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

</body>
</html>