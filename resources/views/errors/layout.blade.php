<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
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
<body class="hold-transition layout-top-nav dark-mode" data-bs-theme="dark">

	<div class="wrapper">
	
		<!-- Navbar -->
		<nav class="main-header navbar navbar-expand-md navbar-dark">
			<div class="container">
				<a href="/" class="navbar-brand">
					<img src="/images/logo_if.png" alt="Logo IF" class="brand-image" style="opacity: .8">
					<span class="brand-text font-weight-light">SIPKL Informatika</span>
				</a>

				<!-- Right navbar links -->
				<ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
					<div class="custom-switch my-auto mr-2">
						<input type="checkbox" class="custom-control-input" id="dark-mode-switcher" checked>
						<label class="custom-control-label" for="dark-mode-switcher"></label>
					</div>
					<a href="/" class="btn btn-primary" id="">Kembali</a>
				</ul>
			</div>
		</nav>
		<!-- /.navbar -->

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			@yield('container')
		</div>
		<!-- /.content-wrapper -->

		<!-- Main Footer -->
		@include('layouts.footer')

	</div>
	<!-- ./wrapper -->

  <!-- jQuery -->
  <script src="/lte/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 5 -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
  <!-- AdminLTE App -->
  <script src="/lte/dist/js/adminlte.js"></script>

  <script src='/js/main.js'></script>
  <script type="text/javascript">
    function activateDarkMode() {
      $('body').addClass('dark-mode');
      // change data-bs-theme to dark
      $('body').attr('data-bs-theme', 'dark');
      // add navbar-dark
      $('nav.main-header').addClass('navbar-dark');
      // remove navbar-white and navbar-light
      $('nav.main-header').removeClass('navbar-white navbar-light');

    }

    function deactivateDarkMode() {
      $('body').removeClass('dark-mode');
      // change data-bs-theme to light
      $('body').attr('data-bs-theme', 'light');
      // add navbar-white and navbar-light
      $('nav.main-header').addClass('navbar-white navbar-light');
      // remove navbar-dark
      $('nav.main-header').removeClass('navbar-dark');
      
    }

    $('#dark-mode-switcher').on('change', function() {
      if ($(this).is(':checked')) {
        activateDarkMode();
      } else {
        deactivateDarkMode();
      }
    });
  </script>
</body>
</html>
