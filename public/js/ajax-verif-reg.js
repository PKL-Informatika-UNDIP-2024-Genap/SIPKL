let data_mhs;

function update_tabel_registrasi() {
  $.ajax({
    type: 'GET',
    url: '/pkl/verifikasi_registrasi/update_tabel_registrasi',
    success: function(response) {
      $('#tabel-reg').html(response.view);
      let tabel = simpleDatatable();
      tabel.order([3, 'asc']).draw();
    },
    error: function(response) {
      console.log('Error:', response);
    }
  });
}

$(document).on('click', '.btn-detail-reg', function() {
  $("#data-dospem").html('<p class="placeholder-glow m-0"><span class="placeholder col-10" style="border-radius: 5px;"></span></p>');

  data_mhs = JSON.parse($(this).attr('data-mhs'));
  // console.log(data_mhs);
  $("#data-nama").html(data_mhs.nama);
  $("#data-nim").html(data_mhs.nim);
  $("#data-instansi").html(data_mhs.instansi);
  $("#data-judul-pkl").html(data_mhs.judul);
  $("#myImage").attr('src','/preview/'+data_mhs.scan_irs);

  if(data_mhs.id_dospem == null){
    $("#data-dospem").html("-");
  }else{
    $.ajax({
      url: '/mhs/kelola_mhs/'+ data_mhs.id_dospem +'/get_data_dospem',
      type: 'GET',
      success: function (response) {
        dospem = response.nama_dospem;
        $("#data-dospem").html(dospem);
      },
      error: function (error) {
        console.error('Error:', error);
        Swal.fire({
          title: 'Error!',
          text: 'Terjadi kesalahan saat mengambil data.',
          icon: 'error',
        });
      },
      complete: function () {
        $(".spinner").addClass("d-none");
        $(".content-modal").removeClass("d-none");
      },
    });
  }
});

$(document).on('click', '.btn-terima', function() {
  Swal.fire({
    title: 'Apakah anda yakin menerima registrasi mahasiswa ini?',
    text: "Registrasi mahasiswa yang sudah diterima tidak dapat dibatalkan lagi",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#007bff',
    cancelButtonColor: '#6c757d',
    confirmButtonText: 'Terima',
    cancelButtonText: 'Batal',
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: '/pkl/verifikasi_registrasi/'+ data_mhs.nim +'/terima',
        type: 'POST',
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        success: function (response) {
          $("#modal-detail-reg").modal('hide');
          Swal.fire({
            title: 'Berhasil!',
            text: 'Berhasil menerima registrasi mahasiswa dengan nim ' + data_mhs.nim,
            icon: 'success',
          });
          update_tabel_registrasi();
        },
        error: function (error) {
          console.error('Error:', error);
          Swal.fire({
            title: 'Error!',
            text: error.responseJSON.message,
            icon: 'error',
          });
        },
      });
    }
  });
});

$(document).on('click', '.btn-tolak', function() {
  Swal.fire({
    title: 'Apakah anda yakin menolak registrasi mahasiswa ini?',
    text: "Registrasi mahasiswa yang sudah ditolak tidak dapat dibatalkan lagi",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#dc3545',
    cancelButtonColor: '#6c757d',
    confirmButtonText: 'Tolak',
    cancelButtonText: 'Batal',
    input: 'text',
    inputPlaceholder: 'Tuliskan alasan menolak...',
    inputValidator: (value) => {
      if (!value) {
        return 'Anda harus memberikan alasan untuk menolak.';
      }
    }
  }).then((result) => {
    if (result.isConfirmed) {
      var alasan_menolak = Swal.getInput().value;

      $.ajax({
        url: '/pkl/verifikasi_registrasi/' + data_mhs.nim + '/tolak',
        type: 'POST',
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        data: { alasan_menolak: alasan_menolak },
        success: function(response) {
          $("#modal-detail-reg").modal('hide');
          Swal.fire({
            title: 'Berhasil!',
            text: 'Berhasil menolak registrasi mahasiswa dengan nim ' + data_mhs.nim,
            icon: 'success',
          });
          update_tabel_registrasi();
        },
        error: function(error) {
          console.error('Error:', error);
          Swal.fire({
            title: 'Error!',
            text: 'Terjadi kesalahan.',
            icon: 'error',
          });
        },
      });
    }
  });
});
