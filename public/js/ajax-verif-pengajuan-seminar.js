let data_pengajuan;

function formatDate(dateString) {
  const date = new Date(dateString);
  const options = {
    day: "numeric",
    month: "long",
    year: "numeric"
  };
  return date.toLocaleDateString("id-ID", options);
}

function update_tabel_pengajuan() {
  $.ajax({
    type: 'GET',
    url: '/seminar/verifikasi_pengajuan/update_tabel_pengajuan',
    success: function(response) {
      $('#tabel-pengajuan').html(response.view);
      let tabel = simpleDatatable();
      tabel.order([3, 'asc']).draw();
    },
    error: function(response) {
      console.log('Error:', response);
    }
  });
}

$(document).on('click', '.btn-detail-pengajuan', function() {
  data_pengajuan = JSON.parse($(this).attr('data-pengajuan'));

  $("#data-nama").html(data_pengajuan.nama_mhs);
  $("#data-nim").html(data_pengajuan.nim);
  $("#data-tgl-pengajuan").html(formatDate(data_pengajuan.created_at));
  $("#data-dospem").html(data_pengajuan.nama_dospem || "-");
  $("#data-waktu-seminar").html(data_pengajuan.waktu_seminar || "-");
  $("#data-tgl-seminar").html(formatDate(data_pengajuan.tgl_seminar) || "-");
  $("#data-ruang").html(data_pengajuan.ruang || "-");
  $("#data-scan-layak-seminar").attr('src', '/preview/' + data_pengajuan.scan_layak_seminar);
  $("#data-scan-peminjaman-ruang").attr('src', '/preview/' + data_pengajuan.scan_peminjaman_ruang);
});

$(document).on('click', '.btn-terima', function() {
  Swal.fire({
    title: 'Apakah anda yakin menerima pengajuan seminar PKL mahasiswa ini?',
    text: "Pengajuan Seminar PKL mahasiswa yang sudah diterima tidak dapat dibatalkan lagi",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#007bff',
    cancelButtonColor: '#6c757d',
    confirmButtonText: 'Terima',
    cancelButtonText: 'Batal',
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: '/seminar/verifikasi_pengajuan/'+ data_pengajuan.nim +'/terima',
        type: 'POST',
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        success: function (response) {
          $("#modal-detail-pengajuan").modal('hide');
          Swal.fire({
            title: 'Berhasil!',
            text: 'Berhasil menerima pengajuan seminar PKL mahasiswa dengan nim ' + data_pengajuan.nim,
            icon: 'success',
          });
          update_tabel_pengajuan();
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
    title: 'Apakah anda yakin menolak pengajuan seminar PKL mahasiswa ini?',
    text: "Pengajuan seminar PKL mahasiswa yang sudah ditolak tidak dapat dibatalkan lagi",
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
        url: '/seminar/verifikasi_pengajuan/' + data_pengajuan.nim + '/tolak',
        type: 'POST',
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        data: { alasan_menolak: alasan_menolak },
        success: function(response) {
          $("#modal-detail-pengajuan").modal('hide');
          Swal.fire({
            title: 'Berhasil!',
            text: 'Berhasil menolak pengajuan mahasiswa dengan nim ' + data_pengajuan.nim,
            icon: 'success',
          });
          update_tabel_pengajuan();
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
