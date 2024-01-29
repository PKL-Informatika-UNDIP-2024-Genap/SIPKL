@extends('layouts.main')

@push('styles')

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

    .filepond--root {
      width:170px;
      margin: 0 auto;
      border: 2px dashed #ced4da;
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
      <div class="card card-primary card-outline col-xl-6">
        <div class="card-body box-profile">
          <div class="text-center position-relative">
            <img id="image_profile_preview" class="profile-user-img img-fluid img-circle"
              src="{{ (auth()->user()->foto_profil == null)?'/images/default.jpg':'/preview/'.auth()->user()->foto_profil }}"
              alt="User profile picture" style="width: 170px">
            <input type="file" id="filepond"
              class="filepond d-none"
              name="filepond"
              accept="image/png, image/jpeg, image/gif"/>
            <div class="btn btn-outline-primary position-absolute top-0 end-0" type="button" id="editImageBtn"><i class="bi bi-pencil-square"></i></div>
            <div class="btn btn-outline-primary position-absolute top-0 d-none" type="button" id="saveImageBtn" style="right: 50px;"><i class="bi bi-floppy-fill"></i></div>
          </div>

          <h3 class="profile-username text-center"><strong>{{ $koordinator->nama }}</strong></h3>
          <p class="text-muted text-center">{{ $koordinator->nip }}</p>

          <div class="table-responsive p-0 mb-3">
            <table class="table table-hover">
              <tbody>
                <tr>
                  <td class="text-nowrap px-0" style="width: 20%"><strong>Id</strong></td>
                  <td style="white-space: nowrap; width: 1%">:</td>
                  <td><strong class="bg-success p-1 rounded-2">{{ $koordinator->id }}</strong></td>
                </tr>
                <tr>
                  <td class="text-nowrap px-0"><strong>Golongan</strong></td>
                  <td style="white-space: nowrap; width: 1%">:</td>
                  <td>{{ $koordinator->golongan }}</td>
                </tr>
                <tr>
                  <td class="text-nowrap px-0"><strong>Jabatan</strong></td>
                  <td style="white-space: nowrap; width: 1%">:</td>
                  <td>{{ $koordinator->jabatan }}</td>
                </tr>
                <tr>
                  <td class="text-nowrap px-0 pb-1"><label for="email"><strong>Email</strong></label></td>
                  <td style="white-space: nowrap; width: 1%">:</td>
                  <td class="px-0 pb-0 pt-1">
                    <div class="input-group">
                      <input type="text" class="form-control bg-transparent border-transparent" id="email" name="email" placeholder="Masukkan email" value="{{ old('email',$koordinator->email) }}" disabled>
                      <button class="input-group-text btn btn-outline-primary d-none" type="button" id="saveEmailBtn"><i class="bi bi-floppy-fill"></i></button>
                      <button class="input-group-text btn btn-outline-primary" type="button" id="editEmailBtn"><i class="bi bi-pencil-fill"></i></button>
                    </div>
                    <div id="email-err" class="invalid-feedback d-block"></div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- /.table-responsive -->

          <p><strong class="text-lightblue">Others?</strong></p>
          <div class="table-responsive p-0 mb-3">
            <table class="table table-hover">
              <tbody>
                <tr>
                  <td class="text-nowrap px-0" style="white-space: nowrap; width: 1%">Nothing</td>
                </tr>
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
  @include('layouts.modal_edit_password')
@endsection

@push('scripts')
  <script>
    $(document).ready(function(){

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

  <script>
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
