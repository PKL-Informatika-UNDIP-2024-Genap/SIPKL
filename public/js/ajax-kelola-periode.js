// $(document).ready(function() {
  let old_date_mulai;
  let old_date_selesai;
  let prev_date_mulai;
  let prev_date_selesai;
  let old_id_periode;

  function update_tabel_periode() {
    $.ajax({
      type: 'GET',
      url: '/pkl/kelola_periode/update_tabel_periode',
      success: function(response) {
        $('#tabel-periode').html(response.view);
        let tabel = simpleDatatable();
        tabel.order([1, 'desc']).draw();
        $('.btn-add').attr('data-periode', response.latest_periode);

        $('.btn-edit-periode').attr('data-latest-periode', response.latest_periode);

      },
      error: function(response) {
        console.log('Error:', response);
      }
    });
  }

  $(document).on('click', '.btn-add', function() {
    let periodeString = $('.btn-add').attr('data-periode');
    if(periodeString != ""){
      let periode;
      if (typeof periodeString === 'string') {
        periode = JSON.parse(periodeString);
      } else if (typeof periodeString === 'object') {
        periode = periodeString;
      }
      // console.log(periode);
      let id_periode = periode.id_periode
      old_date_mulai = new Date(periode.tgl_mulai);
      old_date_selesai = new Date(periode.tgl_selesai);
      let tahun = id_periode.substring(0,4);
      let tahun2 = id_periode.substring(5,9);
      let semester = id_periode.substring(10);

      if (semester == 'Ganjil') {
        semester = 'Genap';
      }else {
        semester = 'Ganjil';
        tahun = parseInt(tahun2);
        tahun2 = tahun + 1;
      }
      id_periode = tahun + '/' + tahun2 + ' ' + semester;

      $('#id-periode').val(id_periode);
    }

    $('#id-periode-err').html('');
    $('#id-periode').removeClass('is-invalid');
    $('#tgl-mulai').val('');
    $('#tgl-mulai-err').html('');
    $('#tgl-mulai').removeClass('is-invalid');
    $('#tgl-selesai').val('');
    $('#tgl-selesai-err').html('');
    $('#tgl-selesai').removeClass('is-invalid');
  });

  $(document).on('click', '#submit', function() {
    $(this).prop("disabled", true);
    $(this).html(`<span class="spinner-border spinner-border-sm" aria-hidden="true"></span> Loading...`);

    let tgl_mulai = $('#tgl-mulai').val();
    let tgl_selesai = $('#tgl-selesai').val();
    let id_periode = $('#id-periode').val();
    let validation = true;
    let date_mulai = new Date(tgl_mulai);
    let date_selesai = new Date(tgl_selesai);
    let regex = /^(\d{4}\/\d{4})\s(Ganjil|Genap)$/;

    if (tgl_mulai == '') {
      validation = false;
      $('#tgl-mulai').addClass('is-invalid');
      $('#tgl-mulai-err').html('Tanggal mulai tidak boleh kosong.');
    }else if(old_date_mulai != undefined && date_mulai <= old_date_mulai){
      validation = false;
      $('#tgl-mulai').addClass('is-invalid');
      $('#tgl-mulai-err').html('Tanggal mulai tidak boleh lebih kecil dari/sama dengan tanggal mulai periode sebelumnya.');
    }else{
      $('#tgl-mulai').removeClass('is-invalid');
      $('#tgl-mulai-err').html('');
    }

    if (tgl_selesai == '') {
      validation = false;
      $('#tgl-selesai').addClass('is-invalid');
      $('#tgl-selesai-err').html('Tanggal selesai tidak boleh kosong.');
    }else if(date_mulai > date_selesai){
      validation = false;
      $('#tgl-selesai').addClass('is-invalid');
      $('#tgl-selesai-err').html('Tanggal selesai tidak boleh lebih kecil dari tanggal mulai.');
    }else if(old_date_selesai != undefined && date_selesai <= old_date_selesai){
      validation = false;
      $('#tgl-selesai').addClass('is-invalid');
      $('#tgl-selesai-err').html('Tanggal selesai tidak boleh lebih kecil dari/sama dengan tanggal selesai periode sebelumnya.');
    }else{
      $('#tgl-selesai').removeClass('is-invalid');
      $('#tgl-selesai-err').html('');
    }

    if (id_periode == '') {
      validation = false;
      $('#id-periode').addClass('is-invalid');
      $('#id-periode-err').html('Periode tidak boleh kosong.');
    }else if(!regex.test(id_periode)){
      validation = false;
      $('#id-periode').addClass('is-invalid');
      $('#id-periode-err').html('Format periode salah. Contoh benar: 2023/2024 Ganjil');
    }
    else{
      $('#id-periode').removeClass('is-invalid');
      $('#id-periode-err').html('');
    }

    if(validation){
      $.ajax({
        type: "POST",
        url: "/pkl/kelola_periode/tambah",
        data: {
          'tgl_mulai': tgl_mulai,
          'tgl_selesai': tgl_selesai,
          'id_periode': id_periode
        },
        dataType: "json",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
          $('#modal-add-periode').modal('hide');
          update_tabel_periode();
          Swal.fire({
            title: 'Berhasil!',
            text: 'Periode PKL berhasil ditambahkan.',
            icon: 'success',
            showConfirmButton: false,
            timer: 1500
          })
        },
        error: function (response) {
          var errorResponse = $.parseJSON(response.responseText);
          if (errorResponse.errors && errorResponse.errors.id_periode) {
            $("#id-periode").addClass("is-invalid");
            $("#id-periode-err").html(errorResponse.errors.id_periode);
          }else{
            $("#id-periode").removeClass("is-invalid");
            $("#id-periode-err").html("");

            Swal.fire({
              title: 'Error!',
              text: 'Terjadi kesalahan saat menambahkan periode PKL.',
              icon: 'error',
            });
          }
        },
        complete: function () {
          $('#submit').prop("disabled", false);
          $('#submit').html('Submit');
        }
      });
    }

  });

  $(document).on('click', '.btn-delete-periode', function() {
    let id_periode = $(this).data('id-periode');
    Swal.fire({
      title: 'Apakah Anda yakin?',
      text: "Periode PKL "+id_periode+" akan dihapus.",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#6c757d',
      confirmButtonText: 'Hapus',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          type: "DELETE",
          url: "/pkl/kelola_periode/hapus",
          data: {
            'id_periode': id_periode
          },
          dataType: "json",
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function (response) {
            update_tabel_periode();
            Swal.fire({
              title: 'Berhasil!',
              text: 'Periode PKL berhasil dihapus.',
              icon: 'success',
              showConfirmButton: false,
              timer: 1500
            })
          },
          error: function (response) {
            console.error('Error:', response);
            Swal.fire({
              title: 'Error!',
              text: 'Terjadi kesalahan saat menghapus periode PKL (Cek apakah periode PKL sudah digunakan)',
              icon: 'error',
            });
          }
        });
      }
    });
  });


  $(document).on('click', '.btn-edit-periode', function() {
    let periode_string = $(this).attr('data-periode');
    let periode = JSON.parse(periode_string);
    let id_periode = periode.id_periode;
    let tgl_mulai = periode.tgl_mulai;
    let tgl_selesai = periode.tgl_selesai;
    let date_mulai = new Date(tgl_mulai);
    let date_selesai = new Date(tgl_selesai);
    old_id_periode = id_periode;

    let prev_periode_string = $(this).attr('data-prev-periode');
    // let prev_id_periode = prev_periode.id_periode;
    if(prev_periode_string != ''){
      let prev_periode;
      if (typeof prev_periode_string === 'string') {
        prev_periode = JSON.parse(prev_periode_string);
      } else if (typeof prev_periode_string === 'object') {
        prev_periode = prev_periode_string;
      }
      let prev_tgl_mulai = prev_periode.tgl_mulai;
      let prev_tgl_selesai = prev_periode.tgl_selesai;
      prev_date_mulai = new Date(prev_tgl_mulai);
      prev_date_selesai = new Date(prev_tgl_selesai);
    }

    $('#id-periode-edit').val(id_periode);
    $('#id-periode-edit-err').html('');
    $('#id-periode-edit').removeClass('is-invalid');
    $('#tgl-mulai-edit').val(tgl_mulai);
    $('#tgl-mulai-edit-err').html('');
    $('#tgl-mulai-edit').removeClass('is-invalid');
    $('#tgl-selesai-edit').val(tgl_selesai);
    $('#tgl-selesai-edit-err').html('');
    $('#tgl-selesai-edit').removeClass('is-invalid');
    $('.btn-update').attr('data-id-periode', id_periode);

  });


  $(document).on('click', '#update', function() {
    let id_periode = $('#id-periode-edit').val();
    let tgl_mulai = $('#tgl-mulai-edit').val();
    let tgl_selesai = $('#tgl-selesai-edit').val();
    let date_mulai = new Date(tgl_mulai);
    let date_selesai = new Date(tgl_selesai);

    let validation = true;
    // var current_date = new Date();
    let regex = /^(\d{4}\/\d{4})\s(Ganjil|Genap)$/;

    if (tgl_mulai == '') {
      validation = false;
      $('#tgl-mulai-edit').addClass('is-invalid');
      $('#tgl-mulai-edit-err').html('Tanggal mulai tidak boleh kosong.');
    }else if(prev_date_mulai != undefined && date_mulai <= prev_date_mulai){
      validation = false;
      $('#tgl-mulai-edit').addClass('is-invalid');
      $('#tgl-mulai-edit-err').html('Tanggal mulai tidak boleh lebih kecil dari/sama dengan tanggal mulai periode sebelumnya.');
    }else{
      $('#tgl-mulai-edit').removeClass('is-invalid');
      $('#tgl-mulai-edit-err').html('');
    }

    if (tgl_selesai == '') {
      validation = false;
      $('#tgl-selesai-edit').addClass('is-invalid');
      $('#tgl-selesai-edit-err').html('Tanggal selesai tidak boleh kosong.');
    }else if(date_mulai > date_selesai){
      validation = false;
      $('#tgl-selesai-edit').addClass('is-invalid');
      $('#tgl-selesai-edit-err').html('Tanggal selesai tidak boleh lebih kecil dari tanggal mulai.');
    }else if(prev_date_selesai != undefined && date_selesai <= prev_date_selesai){
      validation = false;
      $('#tgl-selesai-edit').addClass('is-invalid');
      $('#tgl-selesai-edit-err').html('Tanggal selesai tidak boleh lebih kecil dari/sama dengan tanggal selesai periode sebelumnya.');
    }else{
      $('#tgl-selesai-edit').removeClass('is-invalid');
      $('#tgl-selesai-edit-err').html('');
    }

    if (id_periode == '') {
      validation = false;
      $('#id-periode-edit').addClass('is-invalid');
      $('#id-periode-edit-err').html('Periode tidak boleh kosong.');
    }else if(!regex.test(id_periode)){
      validation = false;
      $('#id-periode-edit').addClass('is-invalid');
      $('#id-periode-edit-err').html('Format periode salah. Contoh benar: 2023/2024 Ganjil');
    }else{
      $('#id-periode-edit').removeClass('is-invalid');
      $('#id-periode-edit-err').html('');
    }

    if(validation){
      $.ajax({
        type: "PUT",
        url: "/pkl/kelola_periode/update",
        data: {
          'tgl_mulai': tgl_mulai,
          'tgl_selesai': tgl_selesai,
          'id_periode': id_periode,
          'old_id_periode': old_id_periode
        },
        dataType: "json",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
          console.log(response.message);
          $('#modal-edit-periode').modal('hide');
          update_tabel_periode();
          Swal.fire({
            title: 'Berhasil!',
            text: 'Periode PKL '+ old_id_periode +' berhasil diupdate.',
            icon: 'success',
            showConfirmButton: false,
            timer: 1500
          })
        },
        error: function (response) {
          var errorResponse = $.parseJSON(response.responseText);
          if (errorResponse.errors && errorResponse.errors.id_periode) {
            $("#id-periode").addClass("is-invalid");
            $("#id-periode-err").html(errorResponse.errors.id_periode);
          }else{
            $("#id-periode").removeClass("is-invalid");
            $("#id-periode-err").html("");

            Swal.fire({
              title: 'Error!',
              text: 'Terjadi kesalahan saat menambahkan periode PKL.',
              icon: 'error',
            });
          }
          
        }
      });
    }
  });


// });