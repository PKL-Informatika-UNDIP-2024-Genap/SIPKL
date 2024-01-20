function update_tabel_dokumen() {
  $.ajax({
    type: 'GET',
    url: '/informasi/update_tabel_dokumen',
    success: function(response) {
      $('#tabel-dokumen').html(response.view);
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
  let deskripsi = $("#deskripsi").val();
  let lampiran = $("#lampiran").val();

  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $.ajax({
    type: "post",
    url: "/informasi/kelola_dokumen/tambah",
    data: {
      deskripsi: deskripsi,
      lampiran: lampiran,
    },
    dataType: "json",
    success: function (response) {
      $("#modal_add").modal("hide");
      Swal.fire({
        title: "Success",
        text: "Data dokumen Berhasil Ditambahkan",
        icon: "success",
        showConfirmButton: false,
        timer: 1500
      });
      update_tabel_dokumen();
    },
    error: function (response) {
      // console.log(xhr.responseText);
      var errorResponse = $.parseJSON(response.responseText);
      if (errorResponse.errors && errorResponse.errors.deskripsi) {
        $("#deskripsi").addClass("is-invalid");
        $("#deskripsi-err").html(errorResponse.errors.deskripsi);
      }else{
        $("#deskripsi").removeClass("is-invalid");
        $("#deskripsi-err").html("");
      }

      if (errorResponse.errors && errorResponse.errors.lampiran) {
        $("#lampiran").addClass("is-invalid");
        $("#lampiran-err").html(errorResponse.errors.lampiran);
      }else{
        $("#lampiran").removeClass("is-invalid");
        $("#lampiran-err").html("");
      }

    }
  });
});

$(document).ready(function() {
  $(document).on("click", ".btn-edit-dokumen", function(e){
    $("#form-edit-dokumen :input").each(function () {
      $(this).removeClass("is-invalid");
      $(this).siblings(".invalid-feedback").html("");
    });
  
    var deskripsi = $(this).data('deskripsi');
    var lampiran = $(this).data('lampiran');
    var id = $(this).data('id');
  
    $("#deskripsi-edit").val(deskripsi);
    $("#lampiran-edit").val(lampiran);
    $("#id").val(id);
  });

  $("#update-dokumen").click(function (e) { 
    e.preventDefault();
    let deskripsi = $("#deskripsi-edit").val();
    let lampiran = $("#lampiran-edit").val();
    let id = $("#id").val();

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.ajax({
      type: "put",
      url: "/informasi/kelola_dokumen/"+ id +"/update",
      data: {
        id: id,
        deskripsi: deskripsi,
        lampiran: lampiran,
      },
      dataType: "json",
      success: function (response) {
        $("#modal_edit_dokumen").modal("hide");
        Swal.fire({
          title: "Success",
          text: 'Data dokumen "' + deskripsi + '" Berhasil Diupdate',
          icon: "success",
          showConfirmButton: false,
          timer: 1500
        });
        update_tabel_dokumen();
      },
      error: function (response) {
        // console.log(xhr.responseText);
        var errorResponse = $.parseJSON(response.responseText);
        if (errorResponse.errors && errorResponse.errors.deskripsi) {
          $("#deskripsi-edit").addClass("is-invalid");
          $("#deskripsi-edit-err").html(errorResponse.errors.deskripsi);
        }else{
          $("#deskripsi-edit").removeClass("is-invalid");
          $("#deskripsi-edit-err").html("");
        }

        if (errorResponse.errors && errorResponse.errors.lampiran) {
          $("#lampiran-edit").addClass("is-invalid");
          $("#lampiran-edit-err").html(errorResponse.errors.lampiran);
        }else{
          $("#lampiran-edit").removeClass("is-invalid");
          $("#lampiran-edit-err").html("");
        }
      }
    });

  });
});

$(document).on("click", ".btn-delete-dokumen", function(e){
  e.preventDefault();
  let deskripsi = $(this).data("deskripsi");
  let id = $(this).data("id");
  
  Swal.fire({
    title: "Yakin?",
    text: 'Apakah anda yakin ingin menghapus dokumen "'+ deskripsi +'"? Data yang dihapus tidak dapat dikembalikan!',
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!"
  }).then((result) => {
    if (result.isConfirmed) {
      // Kirim permintaan DELETE ke server menggunakan AJAX
      $.ajax({
        url: '/informasi/kelola_dokumen/'+ id +'/delete',
        type: 'DELETE',
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
          // Navigasi ke rute lain setelah berhasil menghapus
          // window.location.href = '/dokumen/kelola_dokumen';
          Swal.fire({
            title: "Success",
            text: 'Data dokumen "' + deskripsi + '" Berhasil Dihapus',
            icon: "success",
            showConfirmButton: false,
            timer: 1500
          });
          update_tabel_dokumen();
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
