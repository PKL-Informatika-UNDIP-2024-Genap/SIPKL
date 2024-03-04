@extends('layouts.main_mhs')

@push('styles')
  {{-- <style>
    tr td{
      padding-left: 0 !important;
      padding-right: 0 !important;
    }
  </style> --}}

  <link href="https://cdn.jsdelivr.net/npm/filepond@4/dist/filepond.min.css" rel="stylesheet" />

  {{-- filepond-plugin-image-preview --}}
  <link href="https://cdn.jsdelivr.net/npm/filepond-plugin-image-preview@4/dist/filepond-plugin-image-preview.min.css" rel="stylesheet" />
  <style>
    /*
    * FilePond Custom Styles
    */
    .filepond--drop-label {
        color: #4c4e53;
    }
    .filepond--label-action {
        text-decoration-color: #babdc0;
    }
    .filepond--panel-root {
        background-color: #edf0f4;
    }

    /**
    * Page Styles
    */
    /* html {
        padding: 20vh 0 0;
    } */
    .filepond--root {
      width:170px;
      margin: 0 auto;
      border: 3px dashed #ced4da;
    }
  </style>

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
      <div class="card card-primary card-outline">
        <div class="card-body box-profile row">
          <div class="col-md-4 m-auto pb-4 pb-md-0">
            <div class="text-center position-relative">
              <img id="image_profile_preview" class="profile-user-img img-fluid img-circle"
                src="{{ (auth()->user()->foto_profil == null)?'/images/profile_default.svg':'/preview/'.auth()->user()->foto_profil }}"
                alt="User profile picture" style="width: 170px">
              <input type="file" id="filepond"
                class="filepond d-none"
                name="filepond"
                accept="image/png, image/jpeg, image/gif"/>
              <div class="btn btn-outline-primary position-absolute top-0 end-0 mr-md-2" type="button" id="editImageBtn"><i class="bi bi-pencil-square"></i></div>
              <div class="btn btn-outline-primary position-absolute top-0 mr-md-2 d-none" type="button" id="saveImageBtn" style="right: 50px;"><i class="bi bi-floppy-fill"></i></div>
            </div>
            
            <h3 class="profile-username text-center"><strong>{{ $mahasiswa->nama }}</strong></h3>
            <p class="text-muted text-center">{{ $mahasiswa->nim }}</p>

            <div class="btn btn-primary btn-edit-password" data-bs-toggle="modal" data-bs-target="#modal_edit_password"><b>Edit Password</b></div>

          </div>
          <div class="col-md-8">
  
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
            <p><strong class="text-lightblue">Status dan Data Pribadi</strong></p>
            <div class="table-responsive p-0 mb-3">
              <table class="table table-hover">
                <tbody>
                  <tr>
                    <td class="text-nowrap px-0" style="width: 20%"><strong>Status</strong></td>
                    <td style="white-space: nowrap; width: 1%">:</td>
                    <td><strong class="{{ ($mahasiswa->status == 'Aktif' || $mahasiswa->status == 'Lulus')?'bg-success':'bg-danger' }} p-2 rounded-1">{{ $mahasiswa->status }}</strong></td>
                  </tr>
                  <tr>
                    <td class="text-nowrap px-0"><strong>Periode PKL</strong></td>
                    <td style="white-space: nowrap; width: 1%">:</td>
                    <td>{{ ($mahasiswa->periode_pkl==null)?'-':$mahasiswa->periode_pkl }}</td>
                  </tr>
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
                        <input type="text" class="form-control bg-transparent border-transparent" id="no_wa" name="no_wa" placeholder="Masukkan Nomor Whatsapp" value="{{ old('no_wa',$mahasiswa->no_wa) }}" disabled>
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
                        <input type="text" class="form-control bg-transparent border-transparent" id="email" name="email" placeholder="Masukkan email" value="{{ old('email',$mahasiswa->email) }}" disabled>
                        @if (auth()->user()->email_verified_at == null)
                        <button class="input-group-text btn btn-outline-primary d-none" type="button" id="saveEmailBtn"><i class="bi bi-floppy-fill"></i></button>
                        <button class="input-group-text btn btn-outline-primary" type="button" id="editEmailBtn"><i class="bi bi-pencil-fill"></i></button>
                        @else
                        <div class="input-group-text">
                          <i class="bi bi-check-circle-fill text-success"></i>
                        </div>
                        @endif
                      </div>
                      <div id="email-err" class="invalid-feedback d-block"></div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- /.table-responsive -->
  
            <p><strong class="text-lightblue">Dosen Pembimbing</strong></p>
            <div class="table-responsive p-0 mb-3">
              <table class="table table-hover">
                <tbody>
  
                  @if ($mahasiswa->id_dospem == null)
                  <tr>
                    <td class="text-nowrap px-0 text-center" style="white-space: nowrap; width: 1%"><strong class="text-warning">Tidak tersedia</strong></td>
                  </tr>
                  @else
                  <tr>
                    <td class="text-nowrap px-0" style="white-space: nowrap; width: 1%"><strong>Nama</strong></td>
                    <td style="white-space: nowrap; width: 1%">:</td>
                    <td>{{ $mahasiswa->dosen_pembimbing->nama }} </td>
                  </tr>
                  <tr>
                    <td class="text-nowrap px-0" style="white-space: nowrap; width: 1%"><strong>NIP</strong></td>
                    <td style="white-space: nowrap; width: 1%">:</td>
                    <td>{{ $mahasiswa->dosen_pembimbing->nip }}</td>
                  </tr>
                  @endif
  
                </tbody>
              </table>
            </div>
            <!-- /.table-responsive -->
          </div>

        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->

  <!-- Modal Edit -->
  @include('layouts.modal_edit_password')
@endsection

@push('scripts')
  <script type="text/javascript">
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
          $("#no_wa").removeClass("border-transparent");
        } else {
          noWaEl.prop("disabled", true);
          $("#saveNoWaBtn").addClass("d-none");
          $("#editNoWaBtn").html('<i class="bi bi-pencil-fill"></i>');
          $("#no_wa").addClass("border-transparent");
          $("#no_wa").val(nowa_old);
          $('#no_wa').removeClass('is-invalid'); //reset validasi clientside
          $('#no_wa-err').html(''); //reset validasi clientside
        }
      });

      // update no wa
      $("#saveNoWaBtn").click(function (e) {
        e.preventDefault();
        let nowa = $("#no_wa").val();

        if (nowa == '') {
          $("#no_wa").addClass("is-invalid");
          $("#no_wa-err").html("Nomor Whatsapp harus diisi.");

        } else if (nowa == nowa_old) {
          $('#no_wa').prop('disabled', true);
          $('#saveNoWaBtn').addClass('d-none');
          $('#editNoWaBtn').html('<i class="bi bi-pencil-fill"></i>');
          $("#no_wa").addClass("border-transparent");
          $('#no_wa').removeClass('is-invalid'); //reset validasi clientside
          $('#no_wa-err').html(''); //reset validasi clientside

        } else {
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
        }
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
          $("#email").removeClass("border-transparent");
        } else {
          emailEl.prop("disabled", true);
          $("#saveEmailBtn").addClass("d-none");
          $("#editEmailBtn").html('<i class="bi bi-pencil-fill"></i>');
          $("#email").addClass("border-transparent");
          $("#email").val(email_old);
          $("#email").removeClass("is-invalid"); //reset validasi clientside
          $('#email-err').html(''); //reset validasi clientside
        }
      });

      // update email
      $("#saveEmailBtn").click(function (e) {
        e.preventDefault();
        let email = $("#email").val();

        if (email == '') {
          $('#email').addClass("is-invalid");
          $('#email-err').html("Email harus diisi.");

        } else if (email == email_old) {
          $("#email").prop("disabled", true);
          $("#saveEmailBtn").addClass("d-none");
          $("#editEmailBtn").html('<i class="bi bi-pencil-fill"></i>');
          $("#email").addClass("border-transparent");
          $("#email").removeClass("is-invalid"); //reset validasi clientside
          $('#email-err').html(''); //reset validasi clientside

        } else {
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
        }
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


      // edit foto profil
      $("#editImageBtn").click(function (e) {
        e.preventDefault();
        var filepondEl = $("#filepond");
        var previewEl = $('#image_profile_preview');
        if (filepondEl.hasClass("d-none")) {
          $("#saveImageBtn").removeClass("d-none");
          $("#editImageBtn").html('<i class="bi bi-x-lg"></i>');
          filepondEl.removeClass("d-none");
          previewEl.addClass("d-none");
        } else {
          if ($('input[name="filepond"]').val() != '') {
            $(".filepond--action-revert-item-processing").click();
          }
          $("#saveImageBtn").addClass("d-none");
          $("#editImageBtn").html('<i class="bi bi-pencil-square"></i>');
          filepondEl.addClass("d-none");
          previewEl.removeClass("d-none");
        }
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


  {{-- filepond-plugin-file-encode --}}
  <script src="https://cdn.jsdelivr.net/npm/filepond-plugin-file-encode@2/dist/filepond-plugin-file-encode.min.js"></script>
  {{-- filepond-plugin-file-validate-type --}}
  <script src="https://cdn.jsdelivr.net/npm/filepond-plugin-file-validate-type@1/dist/filepond-plugin-file-validate-type.min.js"></script>
  {{-- filepond-plugin-image-exif-orientation --}}
  <script src="https://cdn.jsdelivr.net/npm/filepond-plugin-image-exif-orientation@1/dist/filepond-plugin-image-exif-orientation.min.js"></script>
  {{-- filepond-plugin-image-preview --}}
  <script src="https://cdn.jsdelivr.net/npm/filepond-plugin-image-preview@4/dist/filepond-plugin-image-preview.min.js"></script>
  {{-- filepond-plugin-image-crop --}}
  <script src="https://cdn.jsdelivr.net/npm/filepond-plugin-image-crop@2/dist/filepond-plugin-image-crop.min.js"></script>
  {{-- filepond-plugin-image-resize --}}
  <script src="https://cdn.jsdelivr.net/npm/filepond-plugin-image-resize@2/dist/filepond-plugin-image-resize.min.js"></script>
  {{-- filepond-plugin-image-transform --}}
  <script src="https://cdn.jsdelivr.net/npm/filepond-plugin-image-transform@3/dist/filepond-plugin-image-transform.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/filepond@4/dist/filepond.min.js"></script>

  <script type="text/javascript">
    /*
    We need to register the required plugins to do image manipulation and previewing.
    */
    FilePond.registerPlugin(
      // encodes the file as base64 data
      FilePondPluginFileEncode,
      // validates files based on input type
      FilePondPluginFileValidateType,
      // corrects mobile image orientation
      FilePondPluginImageExifOrientation,
      // previews the image
      FilePondPluginImagePreview,
      // crops the image to a certain aspect ratio
      FilePondPluginImageCrop,
      // resizes the image to fit a certain size
      FilePondPluginImageResize,
      // applies crop and resize information on the client
      FilePondPluginImageTransform,
    );

    // Select the file input and use create() to turn it into a pond
    // in this example we pass properties along with the create method
    // we could have also put these on the file input element itself
    FilePond.create(
      document.querySelector('.filepond'),
      {
        labelIdle: `<i class="bi bi-upload fs-3"></i><br>Drag & Drop atau <span class="filepond--label-action">Browse</span>`,
        imagePreviewHeight: 170,
        imageCropAspectRatio: '1:1',
        imageResizeTargetWidth: 200,
        imageResizeTargetHeight: 200,
        stylePanelLayout: 'compact circle',
        styleLoadIndicatorPosition: 'center bottom',
        styleProgressIndicatorPosition: 'center bottom',
        styleButtonRemoveItemPosition: 'center bottom',
        styleButtonProcessItemPosition: 'center bottom',
        // imageTransformVariants: {
        //   thumb_small_: (transforms) => {
        //     transforms.resize = {
        //       size: {
        //         width: 128,
        //         height: 128,
        //       },
        //     };
        //     return transforms;
        //   },
        // },
      }
    );

    FilePond.setOptions({
      server: {
        process: '/tmp_upload_foto_profil',
        revert: '/tmp_delete_foto_profil',

        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
      },
    });

    $('#saveImageBtn').click(function (e) {
      e.preventDefault();
      var preview = $('#image_profile_preview');

      if ($('input[name="filepond"]').val() != '') {
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $.ajax({
          type: "put",
          url: "/profile/update_foto_profil",
          data: {
            foto_profil: $('input[name="filepond"]').val(),
          },
          dataType: "json",
          success: function (response) {
            preview.attr('src', '/preview/'+response.foto_profil);
            $('#sidebar_fp').attr('src', '/preview/'+response.foto_profil);
            $('.filepond').addClass('d-none');
            preview.removeClass('d-none');
            $('#editImageBtn').html('<i class="bi bi-pencil-square"></i>');
            $('#saveImageBtn').addClass('d-none');
            Swal.fire({
              title: "Berhasil!",
              text: "Foto profil berhasil diperbarui.",
              icon: "success",
              showConfirmButton: true,
              timer: 1500
            });
          },
          error: function (response) {
            console.log(response.responseText);
          }
        });
      } else {
        Swal.fire({
          title: "Gagal!",
          text: "Foto profil gagal diperbarui.",
          icon: "error",
          showConfirmButton: true,
          timer: 1500
        });
      }
    });
  </script>
@endpush
