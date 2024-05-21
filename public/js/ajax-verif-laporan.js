let data_mhs;

function update_tabel_laporan() {
  $.ajax({
    type: 'GET',
    url: '/pkl/verifikasi_laporan/update_tabel_laporan',
    success: function(response) {
      $('#tabel-laporan').html(response.view);
      let tabel = simpleDatatable();
      tabel.order([3, 'asc']).draw();
    },
    error: function(response) {
      console.log('Error:', response);
    }
  });
}

$(document).on('click', '.btn-detail-laporan', function() {
  $("#data-dospem").html('<p class="placeholder-glow m-0"><span class="placeholder col-10" style="border-radius: 5px;"></span></p>');

  data_mhs = JSON.parse($(this).attr('data-mhs'));

  $("#data-nama").html(data_mhs.nama);
  $("#data-nim").html(data_mhs.nim);
  $("#data-instansi").html(data_mhs.instansi);
  $("#data-judul-pkl").html(data_mhs.judul);
  $("#data-tgl-laporan").html(data_mhs.tgl_laporan);
  $("#data-dospem").html(data_mhs.nama_dospem);
  $("#data-tgl-seminar").html(data_mhs.tgl_seminar);
  if(data_mhs.no_wa == null){
    $("#link-wa").attr("href", "#");
    $("#btn-wa").attr("disabled", "true");
  } else {
    $("#btn-wa").removeAttr("disabled");
    $("#link-wa").attr("href", "https://wa.me/" + data_mhs.no_wa);
  }

  let link = data_mhs.link_berkas;
  if (link == null) {
    link = '';
  }
  if (!link.startsWith('http://') || !link.startsWith('https://') || !link.startsWith('//')) {
    link = 'https://' + link;
  }
  $("#data-link-laporan").attr("href", link);

  let keyword = data_mhs.keyword1 + '; ' + data_mhs.keyword2 + '; ' + data_mhs.keyword3;

  if(data_mhs.keyword4 != null){
    keyword += '; ' + data_mhs.keyword4;
  }
  if(data_mhs.keyword5 != null){
    keyword += '; ' + data_mhs.keyword5;
  }
  
  $("#data-kata-kunci").html(keyword);

  $("#data-abstrak").off("click", "#readToggle");

  $("#data-abstrak").addClass("collapsed");
  var $dataAbstrak = $("#data-abstrak");
  var maxLength = 200;

  var originalText = data_mhs.abstrak;
  var truncatedText = originalText.substring(0, maxLength);

  // Menambahkan teks yang akan ditampilkan dan tombol "read more"
  $dataAbstrak.html(truncatedText + '<span id="readToggle" style="cursor: pointer; color: blue;"> Read more...</span>');

  // Menambahkan event listener untuk menangani klik pada tombol "read more" atau "read less"
  $dataAbstrak.on("click", "#readToggle", function() {
    if ($dataAbstrak.hasClass("collapsed")) {
      // Menampilkan seluruh teks abstrak dan tombol "read less"
      $dataAbstrak.html(originalText + '<span id="readToggle" style="cursor: pointer; color: blue;"> Read less</span>');
      $dataAbstrak.removeClass("collapsed");
    } else {
      // Menampilkan teks yang dipotong dan tombol "read more"
      $dataAbstrak.html(truncatedText + '<span id="readToggle" style="cursor: pointer; color: blue;"> Read more...</span>');
      $dataAbstrak.addClass("collapsed");
    }
  });
});

$(document).on('click', '.btn-terima', function() {
  Swal.fire({
    title: 'Apakah anda yakin menerima laporan PKL mahasiswa ini?',
    text: "laporan PKL mahasiswa yang sudah diterima tidak dapat dibatalkan lagi",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#007bff',
    cancelButtonColor: '#6c757d',
    confirmButtonText: 'Terima',
    cancelButtonText: 'Batal',
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: '/pkl/verifikasi_laporan/'+ data_mhs.nim +'/terima',
        type: 'POST',
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        success: function (response) {
          $("#modal-detail-laporan").modal('hide');
          Swal.fire({
            title: 'Berhasil!',
            text: 'Berhasil menerima laporan mahasiswa dengan nim ' + data_mhs.nim,
            icon: 'success',
          });
          update_tabel_laporan();
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
    title: 'Apakah anda yakin menolak laporan mahasiswa ini?',
    text: "laporan mahasiswa yang sudah ditolak tidak dapat dibatalkan lagi",
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
        url: '/pkl/verifikasi_laporan/' + data_mhs.nim + '/tolak',
        type: 'POST',
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        data: { alasan_menolak: alasan_menolak },
        success: function(response) {
          $("#modal-detail-laporan").modal('hide');
          Swal.fire({
            title: 'Berhasil!',
            text: 'Berhasil menolak laporan mahasiswa dengan nim ' + data_mhs.nim,
            icon: 'success',
          });
          update_tabel_laporan();
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
