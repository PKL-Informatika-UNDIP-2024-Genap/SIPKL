<!DOCTYPE html>
<html lang="en">
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
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="/lte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">

  @stack('styles')
</head>
<body class="hold-transition sidebar-mini layout-fixed">

<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link py-0" data-widget="pushmenu" href="#" role="button"><i class="bi bi-list fs-3 text-black"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <div class="navbar-nav ml-auto">
      <a href="/logout" class="btn btn-primary ">Logout</a>
    </div>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('layouts.sidebar_mhs')
  <!-- /.Main Sidebar Container -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @yield('container')
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <strong>Copyright &copy; 2024 <a href="javascript:void(0)">Under development</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="/lte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
{{-- <script src="/lte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script> --}}
<!-- Bootstrap 5 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<!-- overlayScrollbars -->
<script src="/lte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="/lte/dist/js/adminlte.js"></script>

@stack('scripts')
</body>
</html>
