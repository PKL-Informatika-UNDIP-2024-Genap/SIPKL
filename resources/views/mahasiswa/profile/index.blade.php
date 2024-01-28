@extends('layouts.main_mhs')

@push('styles')
  {{-- <style>
    tr td{
      padding-left: 0 !important;
      padding-right: 0 !important;
    }
  </style> --}}
@endpush

@section('container')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Profil Saya</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item active">Profile</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Profile Image -->
      <div class="card card-primary card-outline col-xl-6">
        <div class="card-body box-profile">
          <div class="text-center">
            <img class="profile-user-img img-fluid img-circle"
              src="{{ (auth()->user()->foto_profil == null)?'/images/default.jpg':auth()->user()->foto_profil }}"
              alt="User profile picture">
          </div>

          <h3 class="profile-username text-center"><strong>{{ $mahasiswa->nama }}</strong></h3>
          <p class="text-muted text-center">{{ $mahasiswa->nim }}</p>

          {{-- <ul class="list-group list-group-unbordered mb-3">
            <li class="list-group-item">
              <b>No WA</b> <span class="float-right">{{ $mahasiswa->no_wa }}</span>
            </li>
            <li class="list-group-item">
              <b>Email</b> <span class="float-right">{{ $mahasiswa->email }}</span>
            </li>
            <li class="list-group-item">
              <b>Status</b> <span class="float-right">{{ $mahasiswa->status }}</span>
            </li>
          </ul> --}}
          <div class="table-responsive p-0 mb-3">
            <table class="table table-hover">
              <tbody>
                <tr>
                  <td class="text-nowrap px-0"><strong>Status</strong></td>
                  <td style="white-space: nowrap; width: 1%">:</td>
                  <td><strong class="{{ ($mahasiswa->status == 'Aktif' || $mahasiswa->status == 'Lulus')?'bg-success':'bg-danger' }} p-2 rounded-2">{{ $mahasiswa->status }}</strong></td>
                </tr>
                <tr>
                  <td class="text-nowrap px-0"><strong>Periode PKL</strong></td>
                  <td style="white-space: nowrap; width: 1%">:</td>
                  <td>{{ $mahasiswa->periode_pkl }}</td>
                </tr>
                <div id="edit_profil_area">
                {{-- <tr>
                  <td class="text-nowrap px-0"><strong>No WA</strong></td>
                  <td style="white-space: nowrap; width: 1%">:</td>
                  <td>{{ $mahasiswa->no_wa }}</td>
                </tr>
                <tr>
                  <td class="text-nowrap px-0"><strong>Email</strong></td>
                  <td style="white-space: nowrap; width: 1%">:</td>
                  <td>{{ $mahasiswa->email }}</td>
                </tr> --}}
                <tr>
                  <td class="text-nowrap px-0 pb-1"><label for="no_wa"><strong>No WA</strong></label></td>
                  <td style="white-space: nowrap; width: 1%">:</td>
                  <td class="px-0 pb-0 pt-1">
                    <div class="input-group">
                      <input type="text" class="form-control bg-transparent" id="no_wa" name="no_wa" placeholder="Masukkan Nomor Whatsapp" value="{{ old('no_wa',$mahasiswa->no_wa) }}" disabled>
                      <button class="input-group-text btn btn-outline-primary d-none" type="button" id="saveNoWaBtn"><i class="bi bi-floppy-fill"></i></button>
                      <button class="input-group-text btn btn-outline-primary" type="button" id="editNoWaBtn"><i class="bi bi-pencil-fill"></i></button>
                    </div>
                    <div id="no_wa-err" class="invalid-feedback d-block"></div>
                  </td>
                </tr>
                <tr>
                  <td class="text-nowrap px-0 pb-1"><label for="email"><strong>Email</strong></label></td>
                  <td style="white-space: nowrap; width: 1%">:</td>
                  <td class="px-0 pb-0 pt-1">
                    <div class="input-group">
                      <input type="text" class="form-control bg-transparent @error('email') is-invalid @enderror" id="email" name="email" placeholder="Masukkan email" value="{{ old('email',$mahasiswa->email) }}" disabled>
                      <button class="input-group-text btn btn-outline-primary d-none" type="button" id="saveEmailBtn"><i class="bi bi-floppy-fill"></i></button>
                      <button class="input-group-text btn btn-outline-primary" type="button" id="editEmailBtn"><i class="bi bi-pencil-fill"></i></button>
                    </div>
                    <div id="email-err" class="invalid-feedback d-block"></div>
                  </td>
                </tr>
                </div>
              </tbody>
            </table>
          </div>
          <!-- /.table-responsive -->

          <p><strong class="text-lightblue">Dosen Pembimbing</strong></p>
          <div class="table-responsive p-0 mb-3">
            <table class="table table-hover">
              <tbody>

                @if ($mahasiswa->nip_dospem == null)
                <tr>
                  <td class="text-nowrap px-0 text-center" style="white-space: nowrap; width: 1%"><strong>Belum ada</strong></td>
                </tr>
                @else
                <tr>
                  <td class="text-nowrap px-0" style="white-space: nowrap; width: 1%"><strong>NIP</strong></td>
                  <td style="white-space: nowrap; width: 1%">:</td>
                  <td>{{ $mahasiswa->nip_dospem }}</td>
                </tr>
                <tr>
                  <td class="text-nowrap px-0" style="white-space: nowrap; width: 1%"><strong>Nama</strong></td>
                  <td style="white-space: nowrap; width: 1%">:</td>
                  <td>{{ $mahasiswa->nama_dospem }} </td>
                </tr>
                @endif

              </tbody>
            </table>
          </div>
          <!-- /.table-responsive -->

          <div class="btn btn-primary btn-edit-password" data-bs-toggle="modal" data-bs-target="#modal_edit_password"><b>Edit Password</b></div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->

  <!-- Modal Edit -->
  @include('mahasiswa.profile.modal_edit_password')
@endsection

@push('scripts')
  <script>
    $(document).ready(function(){
      let nowa_old = $("#no_wa").val();
      let email_old = $("#email").val();

      // edit no wa
      $("#editNoWaBtn").click(function (e) {
        e.preventDefault();
        var noWaEl = $("#no_wa");
        if (noWaEl.prop("disabled") === true){
          noWaEl.prop("disabled", false);
          noWaEl.focus();
          noWaEl.val(noWaEl.val()); // This is optional and can help ensure proper behavior in some cases
          noWaEl[0].setSelectionRange(noWaEl.val().length, noWaEl.val().length);
          $("#saveNoWaBtn").removeClass("d-none");
          $("#editNoWaBtn").html('<i class="bi bi-x-lg"></i>');
        } else {
          noWaEl.prop("disabled", true);
          $("#saveNoWaBtn").addClass("d-none");
          $("#editNoWaBtn").html('<i class="bi bi-pencil-fill"></i>');
          $("#no_wa").val(nowa_old);
        }
      });

      // update no wa
      $("#saveNoWaBtn").click(function (e) {
        e.preventDefault();
        let nowa = $("#no_wa").val();

        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });

        $.ajax({
          type: "put",
          url: "/profile/update_nowa",
          data: {
            no_wa: nowa,
          },
          dataType: "json",
          success: function (response) {
            $("#no_wa").prop("disabled", true);
            $("#saveNoWaBtn").addClass("d-none");
            $("#editNoWaBtn").html('<i class="bi bi-pencil-fill"></i>');
            Swal.fire({
              title: "Berhasil!",
              text: "Nomor Whatsapp berhasil diperbarui.",
              icon: "success",
              showConfirmButton: true,
              timer: 1500
            });
            $("#no_wa").removeClass("is-invalid");
            $("#no_wa-err").html("");
            nowa_old = nowa;
          },
          error: function (response) {
            // console.log(response.responseText);
            var errorResponse = $.parseJSON(response.responseText);
            if (errorResponse.errors && errorResponse.errors.no_wa) {
              $("#no_wa").addClass("is-invalid");
              $("#no_wa-err").html(errorResponse.errors.no_wa[0]);
            }else{
              $("#no_wa").removeClass("is-invalid");
              $("#no_wa-err").html("");
            }
          }
        });
      });


      // edit email
      $("#editEmailBtn").click(function (e) {
        e.preventDefault();
        var emailEl = $("#email");
        if (emailEl.prop("disabled") === true){
          emailEl.prop("disabled", false);
          emailEl.focus();
          emailEl.val(emailEl.val()); // This is optional and can help ensure proper behavior in some cases
          emailEl[0].setSelectionRange(emailEl.val().length, emailEl.val().length);
          $("#saveEmailBtn").removeClass("d-none");
          $("#editEmailBtn").html('<i class="bi bi-x-lg"></i>');
        } else {
          emailEl.prop("disabled", true);
          $("#saveEmailBtn").addClass("d-none");
          $("#editEmailBtn").html('<i class="bi bi-pencil-fill"></i>');
          $("#email").val(email_old);
        }
      });

      // update email
      $("#saveEmailBtn").click(function (e) {
        e.preventDefault();
        let email = $("#email").val();

        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });

        $.ajax({
          type: "put",
          url: "/profile/update_email",
          data: {
            email: email,
          },
          dataType: "json",
          success: function (response) {
            $("#email").prop("disabled", true);
            $("#saveEmailBtn").addClass("d-none");
            $("#editEmailBtn").html('<i class="bi bi-pencil-fill"></i>');
            Swal.fire({
              title: "Berhasil!",
              text: "Email berhasil diperbarui.",
              icon: "success",
              showConfirmButton: true,
              timer: 1500
            });
            $("#email").removeClass("is-invalid");
            $("#email-err").html("");
            email_old = email;
          },
          error: function (response) {
            // console.log(response.responseText);
            var errorResponse = $.parseJSON(response.responseText);
            if (errorResponse.errors && errorResponse.errors.email) {
              $("#email").addClass("is-invalid");
              $("#email-err").html(errorResponse.errors.email[0]);
            }else{
              $("#email").removeClass("is-invalid");
              $("#email-err").html("");
            }
          }
        });
      });


      // modal edit
      $('.btn-edit-password').on('click', function(){
        $("#form-edit-password :input").each(function () {
          $(this).removeClass("is-invalid");
          $(this).siblings(".invalid-feedback").html("");
        });
      });
      // update password
      $("#update-password").click(function (e) {
        e.preventDefault();
        let passwordlama = $("#passwordlama-edit").val();
        let passwordbaru = $("#passwordbaru-edit").val();
        let konfirmasipasswordbaru = $("#konfirmasipasswordbaru-edit").val();

        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });

        $.ajax({
          type: "put",
          url: "/profile/update_password",
          data: {
            password_lama: passwordlama,
            password_baru: passwordbaru,
            konfirmasi_password_baru: konfirmasipasswordbaru,
          },
          dataType: "json",
          success: function (response) {
            $("#passwordlama-edit").val('');
            $("#passwordbaru-edit").val('');
            $("#konfirmasipasswordbaru-edit").val('');
            $("#modal_edit_password").modal("hide");
            Swal.fire({
              title: "Berhasil!",
              text: "Password berhasil diperbarui.",
              icon: "success",
              showConfirmButton: false,
              timer: 1500
            });
          },
          error: function (response) {
            // console.log(response.responseText);
            var errorResponse = $.parseJSON(response.responseText);
            if (errorResponse.errors && errorResponse.errors.password_lama) {
              $("#passwordlama-edit").addClass("is-invalid");
              $("#passwordlama-edit-err").html(errorResponse.errors.password_lama);
            }else{
              $("#passwordlama-edit").removeClass("is-invalid");
              $("#passwordlama-edit-err").html("");
            }
            if (errorResponse.errors && errorResponse.errors.password_baru) {
              $("#passwordbaru-edit").addClass("is-invalid");
              $("#passwordbaru-edit-err").html(errorResponse.errors.password_baru[0]);
            }else{
              $("#passwordbaru-edit").removeClass("is-invalid");
              $("#passwordbaru-edit-err").html("");
            }
            if (errorResponse.errors && errorResponse.errors.konfirmasi_password_baru) {
              $("#konfirmasipasswordbaru-edit").addClass("is-invalid");
              $("#konfirmasipasswordbaru-edit-err").html(errorResponse.errors.konfirmasi_password_baru);
            }else{
              $("#konfirmasipasswordbaru-edit").removeClass("is-invalid");
              $("#konfirmasipasswordbaru-edit-err").html("");
            }
          }
        });
      });

    });
  </script>

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
