let data_nim;
let data_tgl_seminar;
let data_waktu_seminar;
let data_ruang;
let mhs_aktif;
let arr_mhs_tambah_jadwal = [];
let view = null;
let tabel_modal;

const options = {
  weekday: 'long',
  year: 'numeric',
  month: 'long',
  day: 'numeric',
};

function update_tabel_jadwal() {
  $.ajax({
    type: 'GET',
    url: '/seminar/jadwal_seminar/update_tabel_jadwal',
    success: function(response) {
      $('#tabel-jadwal').html(response.view);
      let tabel = datatableWithCustomFilter("#status", 6);
      tabel.order([[1, 'asc'], [2, 'asc'], [7, 'asc']]).draw();
    },
    error: function(response) {
      console.log('Error:', response);
    }
  });
}

$(document).on('click', '.btn-detail-jadwal', function() {
  let data_jadwal = JSON.parse($(this).attr('data-jadwal'));

  data_nim = data_jadwal.nim;
  data_tgl_seminar = data_jadwal.tgl_seminar;
  data_waktu_seminar = data_jadwal.waktu_seminar;
  data_ruang = data_jadwal.ruang;
  
  let tanggal_seminar = new Date(data_jadwal.tgl_seminar);
  tanggal_seminar = tanggal_seminar.toLocaleDateString('id-ID', options);

  $("#data-nama").html(data_jadwal.nama_mhs);
  $("#data-nim").html(data_jadwal.nim);
  $("#data-dospem").html(data_jadwal.nama_dospem);
  $("#data-tgl-seminar").html(tanggal_seminar);
  $("#data-waktu-seminar").html(data_jadwal.waktu_seminar);
  $("#data-ruang").html(data_jadwal.ruang);
  $("#data-jenis-seminar").html(data_jadwal.status);

  $("#edit-tgl-seminar").removeClass('d-none');
  $("#edit-tgl-err").html("");
  $("#edit-waktu-mulai").removeClass('d-none');
  $("#edit-waktu-selesai").removeClass('d-none');
  $("#edit-waktu-err").html("");
  $("#edit-ruang").removeClass('d-none');
  $("#edit-ruang-err").html("");
});

$(document).on('click', '#btn-edit', function() {
  
  if(!$(this).hasClass('edit')) {
    $(this).addClass('edit');
    $(this).html('Simpan');
    $("#data-tgl-seminar").addClass('d-none');
    $("#data-waktu-seminar").addClass('d-none');
    $("#data-ruang").addClass('d-none');
    $(".edit-item").removeClass('d-none');

    let waktu_seminar_split = data_waktu_seminar.split('-');
    
    $("#edit-tgl-seminar").val(data_tgl_seminar);
    $("#edit-waktu-mulai").val(waktu_seminar_split[0]);
    $("#edit-waktu-selesai").val(waktu_seminar_split[1]);
    $("#edit-ruang").val(data_ruang);
    $("#btn-batal").removeClass('d-none');
  } else {
    let validation = true;

    if($("#edit-tgl-seminar").val() == ""){
      validation = false;
      $("#edit-tgl-seminar").addClass('is-invalid');
      $("#edit-tgl-err").html("Tanggal seminar tidak boleh kosong");
    }else{
      $("#edit-tgl-seminar").removeClass('is-invalid');
      $("#edit-tgl-err").html("");
    }
    if($("#edit-waktu-mulai").val() == "" || $("#edit-waktu-selesai").val() == ""){
      validation = false;
      $("#edit-waktu-mulai").addClass('is-invalid');
      $("#edit-waktu-selesai").addClass('is-invalid');
      $("#edit-waktu-err").html("Waktu seminar tidak boleh kosong");
    } else{
      $("#edit-waktu-mulai").removeClass('is-invalid');
      $("#edit-waktu-selesai").removeClass('is-invalid');
      $("#edit-waktu-err").html("");
    }

    if($("#edit-ruang").val() == ""){
      validation = false;
      $("#edit-ruang").addClass('is-invalid');
      $("#edit-ruang-err").html("Ruang seminar tidak boleh kosong");
    }else{
      $("#edit-ruang").removeClass('is-invalid');
      $("#edit-ruang-err").html("");
    }

    if(validation == true){
      let tgl_seminar = $("#edit-tgl-seminar").val();
      let waktu_seminar = $("#edit-waktu-mulai").val() + '-' + $("#edit-waktu-selesai").val();
      let ruang = $("#edit-ruang").val();
      console.log(tgl_seminar);
      console.log(waktu_seminar);
      console.log(ruang);
      $.ajax({
        type: "PUT",
        url: "/seminar/jadwal_seminar/" + data_nim + "/update",
        data: {
          tgl_seminar: tgl_seminar,
          waktu_seminar: waktu_seminar,
          ruang: ruang,
        },
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
          console.log(response);
          Swal.fire({
            title: "Success",
            text: "Jadwal Seminar mahasiswa dengan nim " + data_nim + " Berhasil Diupdate",
            icon: "success",
            showConfirmButton: false,
            timer: 2000
          })
          update_tabel_jadwal();
          $("#btn-edit").removeClass('edit');
          $("#btn-edit").html('Edit');
          $("#btn-batal").addClass('d-none');

          data_tgl_seminar = tgl_seminar;
          data_waktu_seminar = waktu_seminar;
          data_ruang = ruang;

          tgl_seminar = new Date(tgl_seminar);
          $("#data-tgl-seminar").removeClass('d-none');
          $("#data-tgl-seminar").html(tgl_seminar.toLocaleDateString('id-ID', options));
          $("#data-waktu-seminar").removeClass('d-none');
          $("#data-waktu-seminar").html(waktu_seminar);
          $("#data-ruang").removeClass('d-none');
          $("#data-ruang").html(ruang);
          $(".edit-item").addClass('d-none');
  
          $(this).removeClass('edit');
          $(this).html('Edit');
        },
        error: function (response) {
          Swal.fire({
            title: "Error",
            text: "Jadwal Seminar mahasiswa dengan nim " + data_nim + " Gagal Diupdate",
            icon: "error",
            showConfirmButton: false,
            timer: 2000
          })
          console.log('Error:', response);
        },
      });
    }
  }

});

$(document).on('click', '#btn-batal', function() {
  $("#btn-edit").removeClass('edit');
  $("#btn-edit").html('Edit');
  $("#btn-batal").addClass('d-none');
  $("#data-tgl-seminar").removeClass('d-none');
  $("#data-waktu-seminar").removeClass('d-none');
  $("#data-ruang").removeClass('d-none');
  $(".edit-item").addClass('d-none');
});

$(document).on('click', '#btn-tambah-jadwal', function() {
  arr_mhs_tambah_jadwal = [];
  $('#input-tgl-seminar').val('');
  $('#input-waktu-mulai').val('');
  $('#input-waktu-selesai').val('');
  $('#input-ruang').val('');
  $('.form-check-input').prop('checked', false);
  
  if(view == null){
    $.ajax({
      type: 'GET',
      url: '/seminar/jadwal_seminar/get_mhs_aktif',
      success: function(response) {
        view = response.view;
        $('#container-tabel-modal').html(view);
        tabel_modal = simpleDatatable2();
        // console.log(response.view);
      },
      error: function(response) {
        console.log('Error:', response);
      }
    });
  }
});

$(document).on('click', 'td.details-control', function() {
  let tr = $(this).closest('tr');
  let row = tabel_modal.row(tr);
  let instansi_pkl;
  let judul_pkl;

  if (row.child.isShown()) {
    row.child.hide();
    tr.removeClass('shown');
  }
  else {
    tr.addClass('shown');
    row.child(
      '<div class="row">'+
      '<div class="col-md-4">'+
      '<dl>' +
      '<dt>Instansi PKL:</dt>' +
      '<dd>' + tr.data("mhs").instansi +'</dd>' +
      '</dl>'+
      '</div>'+
      '<div class="col-md-8">'+
      '<dl>' +
      '<dt>Judul PKL:</dt>' +
      '<dd>' + tr.data("mhs").judul +'</dd>' +
      '</dl>'+
      '</div>'+
      '</div>'
    ).show();
  }
});

$(document).on('click', '.form-check-input', function (e) {
  let nim = $(this).data('nim');
  let id_dospem = $(this).data('id-dospem');

  if(id_dospem == ""){
    Swal.fire({
      title: "Error",
      text: "Mahasiswa belum memiliki dosen pembimbing",
      icon: "error",
      showConfirmButton: false,
      timer: 2000
    });
    $(this).prop("checked", false);
  }else{
    let data = [nim, id_dospem];
    if($(this).prop("checked") == true){
      arr_mhs_tambah_jadwal.push(data);
    } else {
      arr_mhs_tambah_jadwal.splice(arr_mhs_tambah_jadwal.indexOf(data), 1);
    }

    console.log(arr_mhs_tambah_jadwal);
  }

});

$(document).on('click', '#btn-submit', function() {
  let input_tgl_seminar = $("#input-tgl-seminar").val();
  let input_waktu_seminar = $("#input-waktu-mulai").val() + '-' + $("#input-waktu-selesai").val();
  let input_ruang = $("#input-ruang").val();
  let validation = true;
  let error_message = "";
  console.log(input_waktu_seminar);

  if(input_tgl_seminar == undefined || input_tgl_seminar == ""){
    validation = false;
    error_message += "<p>Tanggal seminar tidak boleh kosong</p>";
  }
  if(input_waktu_seminar == "-"){
    validation = false;
    error_message += "<p>Waktu seminar tidak boleh kosong</p>";
  }
  if(input_ruang == undefined || input_ruang == ""){
    validation = false;
    error_message += "<p>Ruang seminar tidak boleh kosong</p>";
  }
  if(arr_mhs_tambah_jadwal.length == 0){
    validation = false;
    error_message += "<p>Pilih minimal 1 mahasiswa</p>";
  }

  if(validation == false){
    Swal.fire({
      title: "Error",
      html: error_message,
      icon: "error",
      showConfirmButton: false,
      timer: 2000
    })
  } else {
    $.ajax({
      type: "POST",
      url: "/seminar/jadwal_seminar/tambah",
      data: {
        arr_mhs: arr_mhs_tambah_jadwal,
        tgl_seminar: input_tgl_seminar,
        waktu_seminar: input_waktu_seminar,
        ruang: input_ruang,
      },
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function (response) {
        console.log(response);
        Swal.fire({
          title: "Success",
          text: "Jadwal Seminar mahasiswa Berhasil Ditambahkan",
          icon: "success",
          showConfirmButton: false,
          timer: 2000
        })
        update_tabel_jadwal();
        $('#modal-tambah-jadwal').modal('hide');
        view = null;
      },
      error: function (response) {
        Swal.fire({
          title: "Error",
          text: "Jadwal Seminar mahasiswa Gagal Ditambahkan",
          icon: "error",
          showConfirmButton: false,
          timer: 2000
        })
        console.log('Error:', response);
      },
    });
  }
});

$(document).on('click', '#btn-import-jadwal', function(){
  $("#file").val("");
  $("#file").removeClass("is-invalid");
  $("#file-err").html("");
});

$(document).on('click', '#btn-submit-import', function(){
  $(this).prop("disabled", true);
  $(this).html(`<span class="spinner-border spinner-border-sm" aria-hidden="true"></span> Mengimport...`);

  let file_input = $('#form-import')[0];

  let file = new FormData(file_input);
  console.log(file_input);

  $.ajax({
    url: "/seminar/jadwal_seminar/import",
    type: 'POST',
    data: file,
    processData: false,
    contentType: false,
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function (response) {
      $("#modal-import-jadwal").modal("hide");
      // console.log(response.failures);
      if(response.error_row.length == 0){
        Swal.fire({
          title: "Success",
          text: "Semua Data Jadwal Seminar Mahasiswa Berhasil Diimport",
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
          html: "Berhasil melakukan import. Namun terdapat beberapa baris data yang tidak dapat diimport, yaitu :" + error,
          icon: "warning",
        });
      }

      update_tabel_jadwal();
      view = null;
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
    },
    complete: function () {
      // Mengaktifkan kembali tombol import dan menyembunyikan ikon loading spinner setelah permintaan selesai
      $("#btn-submit-import").prop("disabled", false);
      $("#btn-submit-import").html("Import");
      $("#message").addClass("d-none");
    }
  });

});

$(document).on('click', '.btn-delete-jadwal', function(){
  let nim = $(this).attr('data-nim');

  Swal.fire({
    title: 'Apakah Anda Yakin?',
    text: "Data Jadwal Seminar Mahasiswa dengan NIM " + nim + " akan dihapus",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#d33',
    cancelButtonColor: '#6c757d',
    confirmButtonText: 'Hapus',
    cancelButtonText: 'Batal',
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: "DELETE",
        url: "/seminar/jadwal_seminar/" + nim + "/delete",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
          console.log(response);
          Swal.fire({
            title: "Success",
            text: "Jadwal Seminar mahasiswa dengan nim " + nim + " Berhasil Dihapus",
            icon: "success",
            showConfirmButton: false,
            timer: 2000
          })
          update_tabel_jadwal();
          view = null;
        },
        error: function (response) {
          Swal.fire({
            title: "Error",
            text: "Jadwal Seminar mahasiswa dengan nim " + nim + " Gagal Dihapus",
            icon: "error",
            showConfirmButton: false,
            timer: 2000
          })
          console.log('Error:', response);
        },
      });
    }
  });
});