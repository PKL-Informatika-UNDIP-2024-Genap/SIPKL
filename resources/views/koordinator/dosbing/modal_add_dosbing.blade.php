<div class="modal fade" id="modal_add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="m-0">Tambah Dosen Pembimbing</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        {{-- <div class="mb-3">
          @if (session()->has('loginError'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              {{ session('loginError') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif
        </div> --}}

        <form id="form-add" action="" method="post">
          @csrf
          <div class="row">
            <div class="mb-3">
              <label for="nama" class="form-label">Nama</label>
              <input type="text" class="form-control" id="nama" name="nama">
              <div id="nama-err" class="invalid-feedback"></div>
            </div>
            <div class="mb-3">
              <label for="nip" class="form-label">NIP</label>
              <input type="text" class="form-control" id="nip" name="nip">
              <div id="nip-err" class="invalid-feedback"></div>
            </div>
            <div class="mb-3">
              <label for="golongan" class="form-label">Golongan</label>
              <select name="golongan" class="form-control" id="golongan">
                <option value="" disabled selected>Pilih Golongan</option>
                <option value="IIIa">IIIa</option>
                <option value="IIIb">IIIb</option>
                <option value="IIIc">IIIc</option>
                <option value="IIId">IIId</option>
                <option value="IVa">IVa</option>
                <option value="IVb">IVb</option>
                <option value="IVc">IVc</option>
                <option value="IVd">IVd</option>
                <option value="IVe">IVe</option>
              </select>
              <div id="golongan-err" class="invalid-feedback"></div>
            </div>
            <div class="mb-3">
              <label for="jabatan" class="form-label">Jabatan</label>
              <select name="jabatan" class="form-control" id="jabatan">
                <option value="" disabled selected>Pilih Jabatan</option>
                <option value="Pengajar">Pengajar</option>
                <option value="Asisten Ahli">Asisten Ahli</option>
                <option value="Lektor">Lektor</option>
                <option value="Lektor Kepala">Lektor Kepala</option>
                <option value="Guru Besar">Guru Besar</option>
              </select>
              <div id="jabatan-err" class="invalid-feedback"></div>
            </div>
            
          </div>
          <div class="row d-flex justify-content-center">
            <div class="col-auto">
              <button id="submit" type="submit" class="btn btn-primary">Submit</button>
            </div>
          </div>
        </form>
      </div>
      
    </div>
  </div>
</div>

<script>
  $("#btn-add").click(function (e) { 
    e.preventDefault();

    $("#form-add :input").each(function () {
      $(this).val("");
      $(this).removeClass("is-invalid");
      $(this).siblings(".invalid-feedback").html("");
    });
  });

  $("#submit").click(function (e) { 
    e.preventDefault();
    let nama = $("#nama").val();
    let nip = $("#nip").val();
    let golongan = $("#golongan").val();
    let jabatan = $("#jabatan").val();

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.ajax({
      type: "post",
      url: "/dosbing/kelola_dosbing/tambah",
      data: {
        nama: nama,
        nip: nip,
        golongan: golongan,
        jabatan: jabatan
      },
      dataType: "json",
      success: function (response) {
        $("#modal_add").modal("hide");
      },
      error: function (response) {
        // console.log(xhr.responseText);
        var errorResponse = $.parseJSON(response.responseText);
        if (errorResponse.errors && errorResponse.errors.nama) {
          $("#nama").addClass("is-invalid");
          $("#nama-err").html(errorResponse.errors.nama);
        }else{
          $("#nama").removeClass("is-invalid");
          $("#nama-err").html("");
        }

        if (errorResponse.errors && errorResponse.errors.nip) {
          $("#nip").addClass("is-invalid");
          $("#nip-err").html(errorResponse.errors.nip);
        }else{
          $("#nip").removeClass("is-invalid");
          $("#nip-err").html("");
        }

        if (errorResponse.errors && errorResponse.errors.golongan) {
          $("#golongan").addClass("is-invalid");
          $("#golongan-err").html(errorResponse.errors.golongan);
        }else{
          $("#golongan").removeClass("is-invalid");
          $("#golongan-err").html("");
        }

        if (errorResponse.errors && errorResponse.errors.jabatan) {
          $("#jabatan").addClass("is-invalid");
          $("#jabatan-err").html(errorResponse.errors.jabatan);
        }else{
          $("#jabatan").removeClass("is-invalid");
          $("#jabatan-err").html("");
        }
      }
    });
  });

</script>
