function update_tabel_dospem() {
  $.ajax({
    type: 'GET',
    url: '/dospem/update_tabel_dospem',
    success: function(response) {
      $('#tabel-dospem').html(response.view);
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
    url: "/dospem/kelola_dospem/tambah",
    data: {
      nama: nama,
      nip: nip,
      golongan: golongan,
      jabatan: jabatan
    },
    dataType: "json",
    success: function (response) {
      $("#modal_add").modal("hide");
      Swal.fire({
        title: "Success",
        text: "Data Dosen Pembimbing Berhasil Ditambahkan",
        icon: "success",
        showConfirmButton: false,
        timer: 1500
      });
      update_tabel_dospem();
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

$(document).ready(function() {
  $(document).on("click", ".btn-edit-dospem", function(e){
    $("#form-edit-dospem :input").each(function () {
      $(this).removeClass("is-invalid");
      $(this).siblings(".invalid-feedback").html("");
      $("#jabatan-edit").find("option").removeAttr('selected');
      $("#golongan-edit").find("option").removeAttr('selected');
    });
  
    var nama = $(this).data('nama');
    var nip = $(this).data('nip');
    var golongan = $(this).data('golongan');
    var jabatan = $(this).data('jabatan');
  
    // console.log(nama, nip, golongan, jabatan);s
  
    $("#nama-edit").val(nama);
    $("#nip-edit").val(nip);
    $("#golongan-edit").find("option[value='"+golongan+"']").attr('selected', true);
    $("#jabatan-edit").find("option[value='"+jabatan+"']").attr('selected', true);
  });

  $("#update-dospem").click(function (e) { 
    e.preventDefault();
    let nama = $("#nama-edit").val();
    let nip = $("#nip-edit").val();
    let golongan = $("#golongan-edit").val();
    let jabatan = $("#jabatan-edit").val();

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.ajax({
      type: "put",
      url: "/dospem/kelola_dospem/update",
      data: {
        nama: nama,
        nip: nip,
        golongan: golongan,
        jabatan: jabatan
      },
      dataType: "json",
      success: function (response) {
        $("#modal_edit_dospem").modal("hide");
        Swal.fire({
          title: "Success",
          text: "Data Dosen Pembimbing dengan nip " + nip + " Berhasil Diupdate",
          icon: "success",
          showConfirmButton: false,
          timer: 1500
        });
        update_tabel_dospem();
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

        if (errorResponse.errors && errorResponse.errors.nip) {
          $("#nip-edit").addClass("is-invalid");
          $("#nip-edit-err").html(errorResponse.errors.nip);
        }else{
          $("#nip-edit").removeClass("is-invalid");
          $("#nip-edit-err").html("");
        }

        if (errorResponse.errors && errorResponse.errors.golongan) {
          $("#golongan-edit").addClass("is-invalid");
          $("#golongan-edit-err").html(errorResponse.errors.golongan);
        }else{
          $("#golongan-edit").removeClass("is-invalid");
          $("#golongan-edit-err").html("");
        }

        if (errorResponse.errors && errorResponse.errors.jabatan) {
          $("#jabatan-edit").addClass("is-invalid");
          $("#jabatan-edit-err").html(errorResponse.errors.jabatan);
        }else{
          $("#jabatan-edit").removeClass("is-invalid");
          $("#jabatan-edit-err").html("");
        }
      }
    });

  });
});

$(document).on("click", ".btn-delete-dospem", function(e){
  e.preventDefault();
  let nip = $(this).data("nip");
  
  Swal.fire({
    title: "Yakin?",
    text: "Apakah anda yakin ingin menghapus dosen dengan NIP "+ nip +"? Data yang dihapus tidak dapat dikembalikan!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!"
  }).then((result) => {
    if (result.isConfirmed) {
      // Kirim permintaan DELETE ke server menggunakan AJAX
      $.ajax({
        url: '/dospem/kelola_dospem/'+ nip +'/delete',
        type: 'DELETE',
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
          // Navigasi ke rute lain setelah berhasil menghapus
          // window.location.href = '/dospem/kelola_dospem';
          Swal.fire({
            title: "Success",
            text: "Data Dosen Pembimbing dengan nip " + nip + " Berhasil Dihapus",
            icon: "success",
            showConfirmButton: false,
            timer: 1500
          });
          update_tabel_dospem();
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
