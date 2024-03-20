<div class="modal fade" id="modal_login" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Login</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          @if (session()->has('loginError'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              {{ session('loginError') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif
        </div>

        <div class="row d-flex justify-content-center">
          {{-- <img src="/images/logo_undip.png" style="width: 100px;"> --}}
          <img src="/images/logo_if.png" style="width: 100px;">
        </div>
        <div class="row text-center mt-2">
          <h3>SIPKL Informatika</h3>
        </div>
        <form action="/login" method="post">
          @csrf
          <div class="my-3">
            <label for="username" class="form-label"><strong>Username</strong></label>
            <div class="input-group">
              <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
              <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username') }}">
            </div>
            @error('username')
            <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
          </div>
          <div class="my-3">
            <label for="password" class="form-label"><strong>Password</strong></label>
            <div class="input-group">
              <span class="input-group-text"><i class="bi bi-key-fill"></i></span>
              <input type="password" class="form-control" id="password" name="password">
              <button class="btn btn-outline-primary" type="button" id="togglePassword">
                <i class="bi bi-eye"></i>
              </button>
            </div>
            @error('password')
            <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
          </div>
          <div class="my-3">
            <em>*Hubungi koordinator PKL jika lupa password</em>
          </div>
          <div class="mt-4 d-flex justify-content-center">
            <div class="col-auto">
              <button type="submit" class="btn btn-primary">Masuk</button>
            </div>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>

<script type="text/javascript">
  // disable submit button
  $('form').submit(function() {
    // show spinner on button
    $('button[type=submit]').html(`
      <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
      Memuat...
    `);
    $('button[type=submit]').attr('disabled', true);
  });
</script>

<script type="text/javascript">
  const passwordInput = document.getElementById('password');
  const togglePasswordButton = document.getElementById('togglePassword');

  togglePasswordButton.addEventListener('click', function () {
    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordInput.setAttribute('type', type);

    // Toggle eye icon
    if (type === 'password') {
      togglePasswordButton.innerHTML = '<i class="bi bi-eye"></i>';
    } else {
      togglePasswordButton.innerHTML = '<i class="bi bi-eye-slash"></i>';
    }
  });
</script>

@if ($errors->any() || session()->has('loginError'))
  <script type="text/javascript">
    $(document).ready(function () {
      $('#modal_login').modal('show');
    });
  </script>
@endif
