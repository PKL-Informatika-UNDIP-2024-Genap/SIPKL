$(document).ready(function() {
  let table_modal;
  let nip_dospem;
  let map_data_pkl = new Map();
  let arr_nim_delete_mhs = [];
  let arr_nim_add_mhs = [];

  function update_tabel_dospem() {
    $.ajax({
      type: 'GET',
      url: '/dospem/assign_mhs_bimbingan/update_tabel_dospem',
      success: function(response) {
        $('#tabel-dospem').html(response.view);
        simpleDatatable();
      },
      error: function(response) {
        console.log('Error:', response);
      }
    });
  }

  $(document).on("click", ".btn-assign-mhs", function(e){
    arr_nim_delete_mhs = [];
    arr_nim_add_mhs = [];
    let nama = $(this).data('nama');
    let nip = $(this).data('nip');
    nip_dospem = nip;

    if($("#btn-edit").hasClass("edit")){
      $("#btn-edit").html("Edit Mhs Bimbingan");
      $("#btn-edit").removeClass("edit");
      $('#btn-cancel').addClass('d-none');
    }

    $("#data-nama").html(": " + nama);
    $("#data-nip").html(": " + nip);

    $('#tabel-modal').html('<div class="d-flex align-items-center"><div class="spinner-border spinner-border-lg me-2" role="status" aria-hidden="true"></div><div class="fs-5">Mengambil Data Mahasiswa...</div></div>');

    $.ajax({
      type: "GET",
      url: "/dospem/assign_mhs_bimbingan/" + nip + "/get_data_mhs",
      success: function (response) {
        $('#tabel-modal').html(response.view);
        if (table_modal) {
          table_modal.destroy();
        }
        table_modal = simpleDatatable2();
      }
    });
  });

  $(document).on('click', 'td.details-control', function (e) {
    let tr = $(this).closest('tr');
    let row = table_modal.row(tr);
    let instansi_pkl;
    let judul_pkl;
 
    if (row.child.isShown()) {
      row.child.hide();
      tr.removeClass('shown');
    }
    else {
      if($(this).hasClass("clicked")){
        row.child(
          '<dl>' +
          '<dt>Instansi PKL:</dt>' +
          '<dd>' + map_data_pkl.get(tr.data("nim"))[0] +'</dd>' +
          '</dl>'+
          '<dl>' +
          '<dt>Judul PKL:</dt>' +
          '<dd>' + map_data_pkl.get(tr.data("nim"))[1] +'</dd>' +
          '</dl>'
        ).show();
      }else{
        row.child('<span class="spinner-border spinner-border-sm" aria-hidden="true"></span> Loading...').show();
        $.ajax({
          type: "GET",
          url: "/dospem/assign_mhs_bimbingan/"+tr.data('nim')+"/get_data_pkl",
          success: function (response) {
            instansi_pkl = response.instansi_pkl;
            judul_pkl = response.judul_pkl;
          },
          error: function (response) {
            console.error('Error:', response);
            Swal.fire({
              title: 'Error!',
              text: 'Terjadi kesalahan saat mengambil data.',
              icon: 'error',
            });
          },
          complete: function () {
            row.child(
              '<dl>' +
              '<dt>Instansi PKL:</dt>' +
              '<dd>' + instansi_pkl +'</dd>' +
              '</dl>'+
              '<dl>' +
              '<dt>Judul PKL:</dt>' +
              '<dd>' + judul_pkl +'</dd>' +
              '</dl>'
            ).show();

            map_data_pkl.set(tr.data("nim"), [instansi_pkl, judul_pkl]);
          }
        });
        $(this).addClass("clicked");
      }

      tr.addClass('shown');
    }
  });


  $(document).on('click', '#btn-edit', function (e) {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    checkboxes.forEach((checkbox) => {
      checkbox.removeAttribute("disabled");
    });

    if(!$(this).hasClass("edit")){
      $(this).html("Simpan Perubahan");
      $('#btn-cancel').removeClass('d-none');
      checkboxes.forEach((checkbox) => {
        checkbox.removeAttribute("disabled");
      });

      arr_nim_delete_mhs = [];
      arr_nim_add_mhs = [];

    }else{
      $(this).html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Loading...");
      if(arr_nim_add_mhs.length == 0 && arr_nim_delete_mhs.length == 0){
        $("#btn-edit").html("Edit Mhs Bimbingan");
          $('#btn-cancel').addClass('d-none');
          checkboxes.forEach((checkbox) => {
            checkbox.setAttribute("disabled", "disabled");
          });

      }else{
        $.ajax({
          type: "POST",
          url: "/dospem/assign_mhs_bimbingan/" + nip_dospem + "/update_mhs_bimbingan",
          data: {
            arr_nim_add_mhs: arr_nim_add_mhs,
            arr_nim_delete_mhs: arr_nim_delete_mhs
          },
          dataType: "json",
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function (response) {
            Swal.fire({
              title: "Success",
              text: "Data Mahasiswa Bimbingan Berhasil Diupdate",
              icon: "success",
              showConfirmButton: false,
              timer: 1500
            });
            update_tabel_dospem();
          },
          error: function (response) {
            console.error('Error:', response);
            Swal.fire({
              title: 'Error!',
              text: 'Terjadi kesalahan saat mengubah data.',
              icon: 'error',
              confirmButtonText: 'OK'
            }).then((result) => {
              if (result.isConfirmed) {
                location.reload();
              }
            });
          },
          complete: function (response) {
            arr_nim_add_mhs.forEach(function (nim) {
              let checkbox = $('.form-check-input[data-nim="' + nim + '"]');
              checkbox.addClass("db-checked");
            });
          
            arr_nim_delete_mhs.forEach(function (nim) {
              let checkbox = $('.form-check-input[data-nim="' + nim + '"]');
              checkbox.removeClass("db-checked");
            });

            // Bersihkan array arr_nim_add_mhs dan arr_nim_delete_mhs
            arr_nim_add_mhs = [];
            arr_nim_delete_mhs = [];
            $("#btn-edit").html("Edit Mhs Bimbingan");
            $('#btn-cancel').addClass('d-none');
            checkboxes.forEach((checkbox) => {
              checkbox.setAttribute("disabled", "disabled");
            });
          }
        });
      }
    }
    
    $(this).toggleClass('edit');
  });


  $(document).on('click', '.form-check-input', function (e) {
    let nim = $(this).data('nim');
    if($(this).prop("checked") == true){
      if($(this).hasClass("db-checked")){
        arr_nim_delete_mhs.splice(arr_nim_delete_mhs.indexOf(nim), 1);
      }else{
        arr_nim_add_mhs.push(nim);
      }

    }else{
      if($(this).hasClass("db-checked")){
        arr_nim_delete_mhs.push(nim);
      }else{
        arr_nim_add_mhs.splice(arr_nim_add_mhs.indexOf(nim), 1);
      }
    }
  });

  $(document).on('click', '#btn-cancel', function (e) {
    $('#btn-cancel').addClass('d-none');
    $('#btn-edit').html("Edit Mhs Bimbingan");
    $('#btn-edit').removeClass('edit');
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    checkboxes.forEach((checkbox) => {
      checkbox.setAttribute("disabled", "disabled");
    });

    arr_nim_add_mhs.forEach(function (nim) {
      let checkbox = $('.form-check-input[data-nim="' + nim + '"]');
      checkbox.prop("checked", false);
      // checkbox.removeClass("db-checked");
    });
  
    // Check semua checkbox yang ada di array arr_nim_delete_mhs
    arr_nim_delete_mhs.forEach(function (nim) {
      let checkbox = $('.form-check-input[data-nim="' + nim + '"]');
      checkbox.prop("checked", true);
      // checkbox.addClass("db-checked");
    });
  
    // Bersihkan array arr_nim_add_mhs dan arr_nim_delete_mhs
    arr_nim_add_mhs = [];
    arr_nim_delete_mhs = [];
  });
});