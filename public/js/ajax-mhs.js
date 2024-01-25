function update_tabel_mhs() {
  $.ajax({
    type: 'GET',
    url: '/mhs/update_tabel_mhs',
    success: function(response) {
      $('#tabel-mhs').html(response.view);
      simpleDatatable();
    },
    error: function(response) {
      console.log('Error:', response);
    }
  });
}

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
  let nim = $("#nim").val();

  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $.ajax({
    type: "post",
    url: "/mhs/kelola_mhs/tambah",
    data: {
      nama: nama,
      nim: nim,
    },
    dataType: "json",
    success: function (response) {
      $("#modal_add").modal("hide");
      Swal.fire({
        title: "Success",
        text: "Data Mahasiswa Berhasil Ditambahkan",
        icon: "success",
        showConfirmButton: false,
        timer: 1500
      });
      update_tabel_mhs();
    },
    error: function (response) {
      console.log(response.responseText);
      var errorResponse = $.parseJSON(response.responseText);
      if (errorResponse.errors && errorResponse.errors.nama) {
        $("#nama").addClass("is-invalid");
        $("#nama-err").html(errorResponse.errors.nama);
      }else{
        $("#nama").removeClass("is-invalid");
        $("#nama-err").html("");
      }

      if (errorResponse.errors && errorResponse.errors.nim) {
        $("#nim").addClass("is-invalid");
        $("#nim-err").html(errorResponse.errors.nim);
      }else{
        $("#nim").removeClass("is-invalid");
        $("#nim-err").html("");
      }
    }
  });
});

$(document).ready(function() {
  $(document).on("click", ".btn-edit-mhs", function(e){
    $("#form-edit-mhs :input").each(function () {
      $(this).removeClass("is-invalid");
      $(this).siblings(".invalid-feedback").html("");
    });
  
    var nama = $(this).data('nama');
    var nim = $(this).data('nim');
    var status = $(this).data('status');
    // console.log(status);
    $("#nama-edit").val(nama);
    $("#nim-edit").val(nim);
    $("#status-edit").find("option[value='"+status+"']").attr('selected', true);
  });

  $("#update-mhs").click(function (e) { 
    e.preventDefault();
    let nama = $("#nama-edit").val();
    let nim = $("#nim-edit").val();
    let status = $("#status-edit").val();

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.ajax({
      type: "put",
      url: "/mhs/kelola_mhs/update",
      data: {
        nama: nama,
        nim: nim,
        status: status,
      },
      dataType: "json",
      success: function (response) {
        console.log(response);
        $("#modal_edit_mhs").modal("hide");
        Swal.fire({
          title: "Success",
          text: "Data Mahasiswa dengan NIM " + nim + " Berhasil Diupdate",
          icon: "success",
          showConfirmButton: false,
          timer: 1500
        });
        update_tabel_mhs();
      },
      error: function (response) {
        // console.log(xhr.responseText);
        var errorResponse = $.parseJSON(response.responseText);
        if (errorResponse.errors && errorResponse.errors.nama) {
          $("#nama-edit").addClass("is-invalid");
          $("#nama-edit-err").html(errorResponse.errors.nama);
        }else{
          $("#nama-edit").removeClass("is-invalid");
          $("#nama-edit-err").html("");
        }

        if (errorResponse.errors && errorResponse.errors.nim) {
          $("#nim-edit").addClass("is-invalid");
          $("#nim-edit-err").html(errorResponse.errors.nim);
        }else{
          $("#nim-edit").removeClass("is-invalid");
          $("#nim-edit-err").html("");
        }
        
        if (errorResponse.errors && errorResponse.errors.status) {
          $("#status-edit").addClass("is-invalid");
          $("#status-edit-err").html(errorResponse.errors.status);
        }else{
          $("#status-edit").removeClass("is-invalid");
          $("#status-edit-err").html("");
        }
      }
    });

  });
});

$(document).on("click", ".btn-delete-mhs", function(e){
  e.preventDefault();
  let nim = $(this).data("nim");
  
  Swal.fire({
    title: "Yakin?",
    text: "Apakah anda yakin ingin menghapus mahasiswa dengan nim "+ nim +"? Data yang dihapus tidak dapat dikembalikan!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!"
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: '/mhs/kelola_mhs/'+ nim +'/delete',
        type: 'DELETE',
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
          Swal.fire({
            title: "Success",
            text: "Data Mahasiswa dengan NIM " + nim + " Berhasil Dihapus",
            icon: "success",
            showConfirmButton: false,
            timer: 1500
          });
          update_tabel_mhs();
        },
        error: function (error) {
          console.error('Error:', error);
          // Tampilkan pesan kesalahan jika ada
          Swal.fire({
            title: 'Error!',
            text: 'Terjadi kesalahan saat menghapus data.',
            icon: 'error',
          });
        }
      });
    }
  });
});

$(document).on("click", ".btn-reset-pass", function(e){
  e.preventDefault();
  let nim = $(this).data("nim");
  
  Swal.fire({
    title: "Yakin?",
    text: "Apakah anda yakin ingin mereset password mahasiswa dengan nim "+ nim +"?",
    icon: "warning",
    showCancelButton: true,
    cancelButtonText: "Batal",
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Ya, reset!"
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: '/mhs/kelola_mhs/'+ nim +'/reset_pass',
        type: 'PUT',
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
          Swal.fire({
            title: "Success",
            text: "Mahasiswa dengan NIM " + nim + " Berhasil Direset Passwordnya",
            icon: "success",
            showConfirmButton: false,
            timer: 1500
          });
          update_tabel_mhs();
        },
        error: function (error) {
          console.error('Error:', error);
          // Tampilkan pesan kesalahan jika ada
          Swal.fire({
            title: 'Error!',
            text: 'Terjadi kesalahan saat menghapus data.',
            icon: 'error',
          });
        }
      });
    }
  });
});


$(document).on("click", ".btn-detail-mhs", function(e){
  e.preventDefault();
  let nim = $(this).data("nim");
  let nama = $(this).data("nama");
  let status = $(this).data("status");
  let no_wa = $(this).data("no-wa") || "-";
  let email = $(this).data("email") || "-";
  let nip_dosbing = $(this).data("nip-dosbing") || "-";
  let periode_pkl = $(this).data("periode-pkl") || "-";

  let dosbing = "-";
  let judul_pkl = "-";
  let instansi = "-";

  $("#data-nama").html(": " + nama);
  $("#data-nim").html(": " + nim);
  $("#data-status").html(": " + status);
  $("#data-no-wa").html(": " + no_wa);
  $("#data-email").html(": " + email);
  $("#data-periode-pkl").html(": " + periode_pkl);
  $("#data-instansi").html(": " + instansi);
  $("#data-judul").html(": " + judul_pkl);
  $("#data-dosbing").html(": " + dosbing);

  if(status != "Baru"){
    $.ajax({
      url: '/mhs/kelola_mhs/'+ nim +'/get_data_pkl',
      type: 'GET',
      success: function (response) {
        judul_pkl = response.judul_pkl;
        instansi = response.instansi;
        $("#data-instansi").html(": " + instansi);
        $("#data-judul").html(": " + judul_pkl);
      },
      error: function (error) {
        console.error('Error:', error);
        Swal.fire({
          title: 'Error!',
          text: 'Terjadi kesalahan saat mengambil data.',
          icon: 'error',
        });
      }
    });
  }

  if(nip_dosbing != "-"){
    $.ajax({
      url: '/mhs/kelola_mhs/'+ nip_dosbing +'/get_data_dosbing',
      type: 'GET',
      success: function (response) {
        dosbing = response.nama_dosbing;
        $("#data-dosbing").html(": " + dosbing);
      },
      error: function (error) {
        console.error('Error:', error);
        Swal.fire({
          title: 'Error!',
          text: 'Terjadi kesalahan saat mengambil data.',
          icon: 'error',
        });
      }
    });
  }
});

$(document).on("click", "#btn-import", function(e){
  e.preventDefault();
  $("#file").val("");
  $("#file").removeClass("is-invalid");
  $("#file-err").html("");
});

$(document).on("click", "#btn-import-mhs", function(e){
  e.preventDefault();

  let file_input = $('#form-import')[0];

  let file = new FormData(file_input);

  $.ajax({
    url: "/mhs/kelola_mhs/import",
    type: 'POST',
    data: file,
    processData: false,
    contentType: false,
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function (response) {
      $("#modal_import_mhs").modal("hide");
      if(response.error_row.length == 0){
        Swal.fire({
          title: "Success",
          text: "Semua Data Mahasiswa Berhasil Diimport",
          icon: "success",
          showConfirmButton: false,
          timer: 2000
        });
      }else{
        var error = "<ul style='text-align: left; list-style-position: inside;'>";
        for (var i = 0; i < response.error_row.length; i++) {
          error += "<li>Baris " + response.error_row[i] + " error : " + response.error_message[i] + "</li>";
        }
        error += "</ul>";

        Swal.fire({
          title: "Warning",
          html: "Berhasil melakukan import data mahasiswa. Namun terdapat beberapa baris data yang tidak dapat diimport, yaitu :" + error,
          icon: "warning",
        });
      }

      update_tabel_mhs();
    },
    error: function (response) {
      var errorResponse = $.parseJSON(response.responseText);
      console.log(errorResponse.errors);
      if (errorResponse.errors && errorResponse.errors.file) {
        $("#file").addClass("is-invalid");
        $("#file-err").html(errorResponse.errors.file);
      }else if(errorResponse.errors){
        $("#file").addClass("is-invalid");
        $("#file-err").html(errorResponse.errors);
      }
    }
});
});