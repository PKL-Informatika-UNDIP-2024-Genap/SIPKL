<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>SIPKL</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/lte/dist/css/adminlte.min.css">

  <!-- BS Stepper -->
  <link rel="stylesheet" href="/lte/plugins/bs-stepper/css/bs-stepper.min.css">

  <style>
    html {
      scrollbar-gutter: stable;
      scrollbar-width: thin; /* Firefox */
      -ms-overflow-style: none; /* IE 10+ */
      ::-webkit-scrollbar-track {
        -webkit-box-shadow: none !important;
        background-color: transparent !important;
      }
      ::-webkit-scrollbar {
        width: .6rem !important;
        background-color: transparent;
      }
        ::-webkit-scrollbar-thumb {
        background-color: #acacac;
      }
    }
  </style>
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      <a href="{{ request()->fullUrl() }}" class="navbar-brand">
        <img src="/images/logo_if.png" alt="Logo IF" class="brand-image elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">SIPKL Informatika</span>
      </a>

      <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <li class="nav-item">
          <a href="/logout" class="btn btn-primary ">Logout</a>
        </li>
      </ul>
    </div>
  </nav>
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-default">
              <div class="card-header">
                {{-- <h3 class="card-title">Pra Registrasi</h3> --}}
                <h5 class="m-0 text-bold">Pra Registrasi</h5>
              </div>
              <div class="card-body">
                <div class="bs-stepper">
                  <div class="bs-stepper-header flex-wrap" role="tablist">
                    <!-- your steps here -->
                    <div class="step" data-target="#datapribadi-part">
                      <button type="button" class="step-trigger" role="tab" aria-controls="datapribadi-part" id="datapribadi-part-trigger">
                        <span class="bs-stepper-circle">1</span>
                        <span class="bs-stepper-label">Data Pribadi</span>
                      </button>
                    </div>
                    <div class="line"></div>
                    <div class="step" data-target="#datapkl-part">
                      <button type="button" class="step-trigger" role="tab" aria-controls="datapkl-part" id="datapkl-part-trigger">
                        <span class="bs-stepper-circle">2</span>
                        <span class="bs-stepper-label">Data PKL (Sementara)</span>
                      </button>
                    </div>
                  </div>
                  <div class="bs-stepper-content">
                      <!-- your steps content here -->
                    <form id="form" action="/update-data" method="post" class="needs-validation" onsubmit="return false" >
                      @csrf
                      @method('put')
                      <div id="datapribadi-part" class="content" role="tabpanel" aria-labelledby="datapribadi-part-trigger">
                        <div class="form-group">
                          <label for="nama">Nama</label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                            </div>
                            <input type="text" class="form-control" id="nama" placeholder="Nama" value="{{ auth()->user()->mahasiswa->nama }}" disabled>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="nim">Username/NIM</label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="bi bi-person-vcard-fill"></i></span>
                            </div>
                            <input type="text" class="form-control" id="nim" placeholder="NIM" value="{{ auth()->user()->mahasiswa->nim }}" disabled>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="email">Alamat Email</label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                            </div>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Masukkan alamat email..." value="{{ old('email') }}">
                            @error('email')
                              <div class="invalid-feedback">
                                {{ $message }}
                              </div>
                            @enderror
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="no_wa">No WA</label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="bi bi-whatsapp"></i></span>
                            </div>
                            <input type="text" class="form-control @error('no_wa') is-invalid @enderror" id="no_wa" name="no_wa" placeholder="Masukkan nomor WA..." value="{{ old('no_wa') }}" data-inputmask='"mask": "+99 999 9999 9{4,8}"' data-mask>
                            @error('no_wa')
                              <div class="invalid-feedback">
                                {{ $message }}
                              </div>
                            @enderror
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="password">Password Baru</label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="bi bi-key-fill"></i></span>
                            </div>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Masukkan password baru..." value="{{ old('password') }}">
                            <div class="input-group-append">
                              <button class="input-group-text btn btn-outline-primary" type="button" id="passwordTgBtn"><i class="bi bi-eye"></i></button>
                            </div>
                            @error('password')
                              <div class="invalid-feedback">
                                {{ $message }}
                              </div>
                            @enderror
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="konfirmasi_password">Konfirmasi Password</label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="bi bi-key-fill"></i></span>
                            </div>
                            <input type="password" class="form-control @error('konfirmasi_password') is-invalid @enderror" id="konfirmasi_password" name="konfirmasi_password" placeholder="Masukkan ulang password..." value="{{ old('konfirmasi_password') }}">
                            <div class="input-group-append">
                              <button class="input-group-text btn btn-outline-primary" type="button" id="konfirmasiPasswordTgBtn"><i class="bi bi-eye"></i></button>
                            </div>
                            @error('konfirmasi_password')
                              <div class="invalid-feedback">
                                {{ $message }}
                              </div>
                            @enderror
                          </div>
                        </div>
                        <button class="btn btn-primary" onclick="stepper.next()">Next</button>
                      </div>
                      <div id="datapkl-part" class="content" role="tabpanel" aria-labelledby="datapkl-part-trigger">
                        <div class="form-group">
                          <label for="instansi">Instansi</label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="bi bi-building-fill"></i></span>
                            </div>
                            <input type="text" class="form-control @error('instansi') is-invalid @enderror" id="instansi" name="instansi" placeholder="Masukkan nama Instansi sementara" value="{{ old('instansi') }}">
                            @error('instansi')
                              <div class="invalid-feedback">
                                {{ $message }}
                              </div>
                            @enderror
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="judul">Judul PKL</label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="bi bi-fonts"></i></span>
                            </div>
                            <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" placeholder="Masukkan Judul PKL sementara" value="{{ old('judul') }}">
                            @error('judul')
                              <div class="invalid-feedback">
                                {{ $message }}
                              </div>
                            @enderror
                          </div>
                        </div>
                        {{-- <div class="form-group">
                          <label for="exampleInputFile">File input</label>
                          <div class="input-group">
                            <div class="custom-file">
                              <input type="file" class="custom-file-input" id="exampleInputFile">
                              <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            </div>
                            <div class="input-group-append">
                              <span class="input-group-text">Upload</span>
                            </div>
                          </div>
                        </div> --}}

                        <button class="btn btn-primary" onclick="stepper.previous()">Previous</button>
                        <button type="submit" class="btn btn-primary" onclick="submitForm()">Submit</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
              {{-- <div class="card-footer">
              </div> --}}
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2024 <a href="javascript:void(0)">Under development</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline">
      <b>Version</b> 1.0.0
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="/lte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/lte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- BS-Stepper -->
<script src="/lte/plugins/bs-stepper/js/bs-stepper.min.js"></script>
<!-- InputMask -->
{{-- <script src="/lte/plugins/moment/moment.min.js"></script> --}}
<script src="/lte/plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- AdminLTE App -->
<script src="/lte/dist/js/adminlte.min.js"></script>

<script>
  // BS-Stepper Init
  document.addEventListener('DOMContentLoaded', function () {
    window.stepper = new Stepper(document.querySelector('.bs-stepper'))
  })

  $('[data-mask]').inputmask()

  function submitForm() {
    var form = document.getElementById('form');
    form.submit();
  }

  // Toggle password visibility
  const passwordInput = document.getElementById('password');
  const konfirmasiPasswordInput = document.getElementById('konfirmasi_password');
  const passwordTgBtn = document.getElementById('passwordTgBtn');
  const konfirmasiPasswordTgBtn = document.getElementById('konfirmasiPasswordTgBtn');

  passwordTgBtn.addEventListener('click', function () {
    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordInput.setAttribute('type', type);
    if (type === 'password') {
      passwordTgBtn.innerHTML = '<i class="bi bi-eye"></i>';
    } else {
      passwordTgBtn.innerHTML = '<i class="bi bi-eye-slash"></i>';
    }
  });
  konfirmasiPasswordTgBtn.addEventListener('click', function () {
    const type2 = konfirmasiPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
    konfirmasiPasswordInput.setAttribute('type', type2);
    if (type2 === 'password') {
      konfirmasiPasswordTgBtn.innerHTML = '<i class="bi bi-eye"></i>';
    } else {
      konfirmasiPasswordTgBtn.innerHTML = '<i class="bi bi-eye-slash"></i>';
    }
  });
</script>
</body>
</html>
